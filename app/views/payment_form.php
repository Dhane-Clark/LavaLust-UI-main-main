<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #0070ba; /* PayPal blue */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #005f8a; /* Darker blue on hover */
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Make a Payment</h2>
        <form action="<?= site_url('/paymentProcess') ?>" method="POST">
            <label for="amount">Amount:</label>
            <input type="text" name="amount" required placeholder="Enter amount">

            <label for="currency">Currency:</label>
            <input type="text" name="currency" value="PHP" required placeholder="Enter currency (e.g., PHP)">

            <input type="submit" value="Pay Now">
        </form>
        <div class="footer">
            <p>Secure payment processing powered by PayPal</p>
        </div>
    </div>

</body>
</html>