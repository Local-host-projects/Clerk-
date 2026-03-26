<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Clerk — Card Registration</title>

  <style>
    body {
      background: #080808;
      color: #EEECEA;
      font-family: 'Space Mono', monospace;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      background: #111111;
      border: 1px solid #282828;
      padding: 32px;
      width: 100%;
      max-width: 480px;
      border-radius: 8px;
      display: flex;
      flex-direction: column;
      gap: 16px;
    }
    .field-label {
      font-size: 10px;
      color: #AAA;
      text-transform: uppercase;
      margin-bottom: 4px;
    }
    .hosted-field {
      border: 1px solid #363636;
      padding: 12px;
      border-radius: 4px;
      background: #0C0C0C;
      min-height: 40px;
    }
    button {
      background: #00E676;
      color: #000;
      border: none;
      padding: 14px;
      font-weight: bold;
      cursor: pointer;
      text-transform: uppercase;
      font-size: 12px;
    }
    .error {
      color: #FF4C4C;
      font-size: 11px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2 style="margin:0 0 8px 0; font-size:20px;">Register Card</h2>
  <p style="font-size:11px; color:#888; margin:0 0 16px 0;">
    Your card details are securely handled by Interswitch.
  </p>

  <!-- Hosted Fields Input Containers -->
  <div>
    <div class="field-label">Card Number</div>
    <div id="cardNumber-container" class="hosted-field"></div>
  </div>

  <div style="display: flex; gap: 8px;">
    <div style="flex:1;">
      <div class="field-label">Expiry</div>
      <div id="expirationDate-container" class="hosted-field"></div>
    </div>
    <div style="flex:1;">
      <div class="field-label">CVV</div>
      <div id="cvv-container" class="hosted-field"></div>
    </div>
  </div>

  <div>
    <div class="field-label">PIN</div>
    <div id="pin-container" class="hosted-field"></div>
  </div>

  <div id="hosted-error" class="error"></div>

  <button id="submit-card">Submit Card</button>
</div>

<!-- Interswitch Hosted Fields SDK (Test URL shown here; replace for production) -->
<script src="https://hostedfields.qa.interswitchng.com/sdk.js"></script>

<script>
  let instance;
  const errorContainer = document.getElementById("hosted-error");

  const config = {
    fields: {
        cardNumber: {
            selector: '#cardNumber-container',
            placeholder: '****  ****  ****  ****',
            styles: {}
        },
        expirationDate: {
            selector: '#expirationDate-container',
            placeholder: 'MM / YY',
            styles: {}
        },
        cvv: {
            selector: '#cvv-container',
            placeholder: '***',
            styles: {}
        },
        pin: {
            selector: '#pin-container',
            placeholder: '* * * *',
            styles: {}
        },
        otp: {
            selector: '#otp-container',
            placeholder: '* * * * * *',
            styles: {}
        }
    },
    cardinal: {
        containerSelector: '.cardinal-container',
        activeClass: 'show'
    },
    paymentParameters: {
        amount: 0,
        currencyCode: "566",
        dateOfPayment: Date.now(),
        payableCode: "Default_Payable_MX26070",
        merchantCustomerName: "Aethercode",
        merchantCode: 'MX276068',
        transactionReference: "CLRK:" + Date.now(),
    }
};

  isw.hostedFields.create(config, function(createError, hostedFieldsInstance) {
    if (createError) {
      errorContainer.textContent = createError.message || "Unable to setup fields";
      return;
    }
    instance = hostedFieldsInstance;
  });

  document.getElementById("submit-card").addEventListener("click", function() {
    if (!instance) {
      errorContainer.textContent = "Hosted fields not ready";
      return;
    }

    instance.submit(function(err, payload) {
      if (err) {
        errorContainer.textContent = err.message || "Submission failed";
        return;
      }

      // payload.body.token & payload.body.tokenExpiryDate will be returned here
    //   fetch("", {
    //     method: "POST",
    //     headers: {
    //       "Content-Type": "application/json",
    //       "X-CSRF-TOKEN": "{{ csrf_token() }}"
    //     },
    //     body: JSON.stringify({
    //       token: payload.body.token,
    //       tokenExpiry: payload.body.tokenExpiryDate
    //     })
    //   })
    //   .then(res => res.json())
    //   .then(data => {
    //     window.location = data.redirect ?? window.location.href;
    //   })
    //   .catch(e => {
    //     errorContainer.textContent = "Network error";
    //   });
    });
  });
</script>

</body>
</html>