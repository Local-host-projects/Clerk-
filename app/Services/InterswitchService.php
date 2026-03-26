<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class InterswitchService
{
    private string $baseUrl;
    private string $clientId;
    private string $clientSecret;
    private string $merchantCode;
    private string $payableCode;
    private string $publicKeyPath; // path to Interswitch's RSA public key

    public function __construct()
    {
        $this->baseUrl      = config('interswitch.base_url');      // https://qa.interswitchng.com (sandbox)
        $this->clientId     = config('interswitch.client_id');
        $this->clientSecret = config('interswitch.client_secret');
        $this->merchantCode = config('interswitch.merchant_code');
        $this->payableCode  = config('interswitch.payable_code');
        $this->publicKeyPath = config('interswitch.public_key_path');
    }

    // ─────────────────────────────────────────────────────────────
    // STEP A: Get OAuth2 Bearer Token
    // ─────────────────────────────────────────────────────────────
    public function getAccessToken(): string
    {
        $response = Http::withBasicAuth($this->clientId, $this->clientSecret)
            ->asForm()
            ->post("{$this->baseUrl}/passport/oauth/token", [
                'grant_type' => 'client_credentials',
            ]);

        if ($response->failed()) {
            Log::error('Interswitch token error', $response->json());
            throw new Exception('Failed to get Interswitch access token');
        }

        return $response->json('access_token');
    }

    // ─────────────────────────────────────────────────────────────
    // STEP B: Build AuthData (3DES + RSA encryption)
    //
    // AuthData format: RSA_encrypt(3DES_key) + 3DES_encrypt(card_blob)
    // Card blob: "<pan>:<expiry>:<cvv>:<pin>" (pin optional for card-not-present)
    // ─────────────────────────────────────────────────────────────
    public function buildAuthData(
        string $pan,
        string $expiryDate,   // MMYY format e.g. "1226"
        string $cvv,
        string $pin = ''      // leave blank for card-not-present
    ): string {
        // 1. Generate a random 3DES key (16 bytes for 128-bit)
        $tripleDesKey = random_bytes(16);

        // 2. Build the card payload string
        $cardBlob = "{$pan}:{$expiryDate}:{$cvv}";
        if ($pin) {
            $cardBlob .= ":{$pin}";
        }

        // 3. Encrypt card blob with 3DES (CBC mode, zero-padded IV)
        $iv = str_repeat("\0", 8);
        $encryptedCard = openssl_encrypt(
            $this->pkcs5Pad($cardBlob, 8),
            'des-ede3-cbc',
            $tripleDesKey,
            OPENSSL_RAW_DATA | OPENSSL_NO_PADDING,
            $iv
        );

        // 4. Encrypt 3DES key with Interswitch's RSA public key
        $publicKey = openssl_pkey_get_public(file_get_contents($this->publicKeyPath));
        openssl_public_encrypt($tripleDesKey, $encryptedKey, $publicKey, OPENSSL_PKCS1_PADDING);

        // 5. Concatenate: base64(encrypted_key) + base64(encrypted_card)
        // Interswitch expects: base64url of (RSA encrypted key || 3DES encrypted data)
        $authData = base64_encode($encryptedKey . $encryptedCard);

        return $authData;
    }

    private function pkcs5Pad(string $text, int $blocksize): string
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    // ─────────────────────────────────────────────────────────────
    // STEP C: Tokenize Card → returns ['token' => ..., 'tokenExpiryDate' => ...]
    // ─────────────────────────────────────────────────────────────
    public function tokenizeCard(
        string $accessToken,
        string $authData,
        string $transactionRef,
        int    $amount,       // in kobo (NGN) e.g. 10000 = ₦100
        string $customerId
    ): array {
        $response = Http::withToken($accessToken)
            ->post("{$this->baseUrl}/api/v2/purchases/validations/recurrents", [
                'customerId'     => $customerId,
                'amount'         => $amount,
                'currency'       => 'NGN',
                'transactionRef' => $transactionRef,
                'authData'       => $authData,
                'merchantCode'   => $this->merchantCode,
                'payableCode'    => $this->payableCode,
            ]);

        $body = $response->json();

        if ($response->failed() || !isset($body['token'])) {
            Log::error('Interswitch tokenize error', $body ?? []);
            throw new Exception($body['message'] ?? 'Card tokenization failed');
        }

        return [
            'token'            => $body['token'],
            'tokenExpiryDate'  => $body['tokenExpiryDate'],
            'panLast4'         => $body['panLast4Digits'] ?? null,
            'responseCode'     => $body['responseCode'],
        ];
    }

    // ─────────────────────────────────────────────────────────────
    // STEP D: Charge using stored token (recurring)
    // ─────────────────────────────────────────────────────────────
    public function chargeWithToken(
        string $accessToken,
        string $token,
        string $tokenExpiryDate,
        int    $amount,
        string $customerId,
        string $transferRef
    ): array {
        $response = Http::withToken($accessToken)
            ->post("{$this->baseUrl}/api/v2/purchases/recurrents", [
                'customerId'      => $customerId,
                'amount'          => $amount,
                'currency'        => 'NGN',
                'token'           => $token,
                'tokenExpiryDate' => $tokenExpiryDate,
                'transferRef'     => $transferRef,
                'merchantCode'    => $this->merchantCode,
                'payableCode'     => $this->payableCode,
            ]);

        $body = $response->json();

        if ($response->failed()) {
            Log::error('Interswitch recurring charge error', $body ?? []);
            throw new Exception($body['message'] ?? 'Recurring charge failed');
        }

        return $body; // responseCode "00" = success
    }
}