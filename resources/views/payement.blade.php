<!-- @foreach ($orders as $order)
<p>{{ $order }}</p>
@endforeach

{{ $user->id }}

<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    <button>PAY</button>
</form> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/payement.css">
    <link rel="shortcut icon" href="../img/icon.png">
    <title>Page de Paiement</title>
</head>

<body>
    <div class="payment-container">
        <h2>Formulaire de Paiement</h2>
        <form action="{{ route('orders.store') }}" method="post">
            <label for="card-number">Numéro de carte :</label>
            <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9012 3456" required>

            <label for="card-holder">Titulaire de la carte :</label>
            <input type="text" id="card-holder" name="card-holder" placeholder="John Doe" required>

            <div class="flex-container">
                <div>
                    <label for="expiry-date">Date d'expiration :</label>
                    <input type="text" id="expiry-date" name="expiry-date" placeholder="MM/YY" required>
                </div>
                <div>
                    <label for="cvv">CVV :</label>
                    <input type="text" id="cvv" name="cvv" placeholder="123" required>
                </div>
            </div>
            @csrf
            <button>PAY</button>
        </form>
    </div>
</body>

</html>