<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Reservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6f2ff;
            margin: 0;
            padding: 0;
            display: grid;
            place-items: center;
            height: 100vh;
        }

        .reservation-form {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            display: grid;
            gap: 15px;
        }

        .reservation-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007BFF;
        }

        .reservation-form label {
            font-size: 14px;
            color: #555;
        }

        .reservation-form input, .reservation-form select, .reservation-form button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .reservation-form button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        .reservation-form button:hover {
            background-color: #0056b3;
        }

        .back-button {
            background-color: #f44336;
            color: white;
            border: none;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #d32f2f;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="reservation-form">
    <h2>Make an Appointment Reservation</h2>
    <form method="POST" action="<?php echo site_url(url: 'reserve'); ?>">
    <?= flash_alert()?>
        <!-- User Details -->
        <label for="user_id">User ID:</label>
        <input id="user_id" name="user_id" value="<?= $data['id']?>" required placeholder="Enter your user ID" hidden>
        <input value="<?= $data['name']?> " required placeholder="Enter your user ID" disabled>

        <!-- Service Type Selection -->
        <label for="service_type">Service Type:</label>
        <select id="service_type" name="service_type" required>
            <option value="" disabled selected>Select a service</option>
            <!-- Service options can be populated dynamically from the database -->
            <option value="1">Service 1</option>
            <option value="2">Service 2</option>
            <option value="3">Service 3</option>
        </select>

        <!-- Appointment Details -->
        <label for="appointment_date">Appointment Date:</label>
        <input type="date" id="appointment_date" name="appointment_date" required>

        <label for="appointment_time">Appointment Time:</label>
        <input type="time" id="appointment_time" name="appointment_time" required>

        <label for="duration">Duration (minutes):</label>
        <input type="number" id="duration" name="duration" required placeholder="Enter duration in minutes">

        <button type="submit">Submit Appointment</button>
    </form>

    <!-- Back Button -->
    <button class="back-button" onclick="window.history.back()">Back</button>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
