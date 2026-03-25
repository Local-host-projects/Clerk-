# Clerk

> Cash payment infrastructure for digital commerce in Nigeria.

Clerk bridges the gap between Nigeria's cash economy and digital commerce. Customers generate an Order ID at checkout, pay cash at any registered agent, and merchants receive real-time settlement confirmation via webhook — no card, no bank account, no internet required on the buyer's side.

---

## The Problem

70 million Nigerians cannot buy anything online. Not because they can't afford it. Because every checkout assumes a card or bank account that most Nigerians don't have. Card penetration sits below 15%. The cash economy and the digital economy have never had a bridge.

Clerk is that bridge.

---

## How It Works

```
Merchant creates order → Order ID generated
        ↓
Customer finds nearest agent (heatmap)
        ↓
Customer pays cash at agent with Order ID
        ↓
Agent confirms payment → Interswitch settlement fires
        ↓
Merchant receives ORDER_PAID webhook → order fulfilled
```

No buyer registration. No card. No internet required on the buyer's side.

---

## Features

### Core
- **Order ID** — shareable payment reference. Text it, write it, say it aloud. Works without any app or account on the buyer's side
- **Agent heatmap** — live search of registered Clerk agents nearby. Customers find their nearest payment point in seconds
- **Real-time webhooks** — four event types fire instantly on order state changes
- **Interswitch settlement** — built on Interswitch's agent network and payment rails

### Commerce Types
- **Physical goods** — standard order → agent payment → merchant fulfillment
- **Digital goods** — order → agent payment → unlock code delivered by email or download link
- **Subscriptions** — recurring Order ID generation on any cadence. No card required for ongoing subscriptions

### Micropayments
- Float wallet enables transactions from ₦30 upward — viable for music, film, articles, software, and any digital content below viable card transaction thresholds

### Agent Network
- Any registered financial agent becomes a Clerk commerce node
- Agent interface — single-screen order lookup and payment confirmation
- Geographic reach determined by agent density, not internet infrastructure or smartphone penetration

---

## API Reference

### Orders

```http
POST /orders
```
Create a new order and generate an Order ID.

**Request**
```json
{
  "merchant_id": "string",
  "amount": 15000,
  "currency": "NGN",
  "description": "string",
  "expires_in": 86400,
  "webhook_url": "https://yoursite.com/webhooks/clerk"
}
```

**Response**
```json
{
  "order_id": "CLK-2026-4A7F",
  "amount": 15000,
  "currency": "NGN",
  "status": "pending",
  "expires_at": "2026-03-24T13:00:00Z",
  "created_at": "2026-03-23T13:00:00Z"
}
```

---

```http
GET /orders/{id}
```
Retrieve order details by Order ID. Used by agent interface for lookup.

**Response**
```json
{
  "order_id": "CLK-2026-4A7F",
  "amount": 15000,
  "currency": "NGN",
  "description": "string",
  "status": "pending | paid | expired",
  "merchant_name": "string",
  "expires_at": "2026-03-24T13:00:00Z"
}
```

---

```http
POST /orders/{id}/confirm
```
Agent confirms cash received. Triggers Interswitch settlement.

**Request**
```json
{
  "agent_id": "string",
  "amount_received": 15000
}
```

**Response**
```json
{
  "order_id": "CLK-2026-4A7F",
  "status": "paid",
  "settled_at": "2026-03-23T13:45:00Z"
}
```

---

### Products (Digital Goods)

```http
POST /products
```
Create a digital product with an unlock code.

**Request**
```json
{
  "merchant_id": "string",
  "name": "string",
  "price": 500,
  "currency": "NGN",
  "unlock_type": "code | download | email",
  "unlock_value": "string"
}
```

---

```http
GET /products/{id}
```
Retrieve product details.

---

### Agents

```http
GET /agents/nearby
```
Find registered Clerk agents by location for the heatmap.

**Query params:** `lat`, `lng`, `radius_km`

**Response**
```json
{
  "agents": [
    {
      "agent_id": "string",
      "name": "string",
      "address": "string",
      "distance_km": 0.4,
      "lat": 6.5244,
      "lng": 3.3792
    }
  ]
}
```

---

### Float (Phase 2)

```http
POST /float/deposit
```
Merchant submits informal change left by customer into the float pool.

```http
GET /float/{face_id}
```
Retrieve aggregated float balance for a customer via facial recognition ID.

---

## Webhooks

Clerk sends signed POST requests to your `webhook_url` on these events.

| Event | Trigger |
|-------|---------|
| `ORDER_CREATED` | New order generated with Order ID |
| `ORDER_PAID` | Agent confirms cash, Interswitch settlement completes |
| `ORDER_EXPIRED` | Order ID passes expiry window without payment |
| `PRODUCT_DELIVERED` | Digital unlock code sent to customer |

### Webhook Payload

```json
{
  "event": "ORDER_PAID",
  "order_id": "CLK-2026-4A7F",
  "amount": 15000,
  "currency": "NGN",
  "agent_id": "string",
  "timestamp": "2026-03-23T13:45:00Z",
  "signature": "sha256=..."
}
```

### Verifying Signatures

Every webhook is signed with your merchant secret. Verify before processing.

```php
$payload = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_CLERK_SIGNATURE'];
$expected = 'sha256=' . hash_hmac('sha256', $payload, $your_merchant_secret);

if (!hash_equals($expected, $signature)) {
    http_response_code(401);
    exit;
}
```

---

## Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 11, PHP 8.3 |
| Database | MySQL |
| Queue | Redis |
| Payments | Interswitch Payment Gateway |
| Notifications | Laravel Mail |
| Auth | Laravel Sanctum |

---

## Project Structure

```
clerk/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── OrderController.php
│   │   │   ├── ProductController.php
│   │   │   ├── AgentController.php
│   │   │   └── WebhookController.php
│   │   └── Middleware/
│   │       └── VerifyWebhookSignature.php
│   ├── Models/
│   │   ├── Order.php
│   │   ├── Product.php
│   │   ├── Agent.php
│   │   └── Merchant.php
│   ├── Services/
│   │   ├── InterswitchService.php
│   │   ├── OrderService.php
│   │   └── WebhookDispatcher.php
│   └── Jobs/
│       ├── ProcessInterswitchSettlement.php
│       └── DispatchMerchantWebhook.php
├── routes/
│   └── api.php
├── database/
│   └── migrations/
└── tests/
```

---

## Setup

```bash
git clone https://github.com/aethercode/clerk.git
cd clerk

composer install
cp .env.example .env
php artisan key:generate

# Configure your .env
# DB_*, INTERSWITCH_CLIENT_ID, INTERSWITCH_SECRET_KEY, INTERSWITCH_BASE_URL

php artisan migrate
php artisan serve
```

### Environment Variables

```env
INTERSWITCH_CLIENT_ID=your_client_id
INTERSWITCH_SECRET_KEY=your_secret_key
INTERSWITCH_BASE_URL=https://sandbox.interswitchng.com
INTERSWITCH_MERCHANT_CODE=your_merchant_code

CLERK_WEBHOOK_SECRET=your_webhook_signing_secret
ORDER_EXPIRY_HOURS=24
```

---

## Demo Loop

The full transaction loop in 90 seconds:

1. Merchant creates order on dashboard → `CLK-2026-4A7F` generated
2. Customer finds nearest agent via heatmap
3. Agent looks up `CLK-2026-4A7F` → confirms ₦15,000 cash received
4. Interswitch settlement fires → `ORDER_PAID` webhook received
5. Merchant dashboard updates in real time
6. *(Digital goods)* Customer receives unlock code by email

---

## Built By

**Aethercode** — Lagos, Nigeria

Built for the Enyata × Interswitch Buildathon 2026. Demo Day April 11, 2026 at Interswitch HQ.

---

## License

MIT
