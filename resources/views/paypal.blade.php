<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPal Payment</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .paypal-button-wrapper {
            max-width: 500px; /* Ajusta este valor según sea necesario */
            width: 100%;
            padding: 20px; /* Opcional: para añadir un poco de espacio alrededor */
        }
    </style>
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.client_id') }}"></script>
</head>
<body>
    <div class="container">
        <div class="paypal-button-wrapper">
            <div id="paypal-button-container"></div>
        </div>
    </div>

    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return fetch('{{ route('paypal.createOrder') }}', {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    return orderData.result.id;
                });
            },
            onApprove: function(data, actions) {
                return fetch('{{ route('paypal.captureOrder', '') }}/' + data.orderID, {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    alert('Transaction completed by ' + orderData.result.payer.name.given_name);
                });
            },
            onCancel: function(data) {
                alert('Payment was cancelled');
            },
            onError: function(err) {
                console.error(err);
                alert('An error occurred during the transaction');
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>
