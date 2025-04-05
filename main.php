<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/main.css">
    <title>Home | Hanami Hospital</title>
</head>
<body>
    <header>
        <div class="heroCont">
            <h1>Hanami Hospital</h1>
            <p>Hanami Hospital is a simple and reliable online system for booking medical appointments. Fast, secure, and easy to use.</p>
            <button id="reservation-btn">Reserve Now</button>
        </div>
    </header>

    <script>
        document.getElementById('reservation-btn').addEventListener('click', function() {
            window.location.href = 'PaymentPage.html';
        })
    </script>
</body>
</html>