<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        a.add-appointment {
            display: inline-block;
            margin-bottom: 20px;
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
        }
        a.add-appointment:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 14px;
        }
        table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        a.action-link {
            text-decoration: none;
            color: #28a745;
            font-weight: bold;
        }
        a.action-link:hover {
            text-decoration: underline;
        }
        .status-select {
            padding: 5px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #ccc;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
    <form method="POST" action="<?php echo site_url(url: 'deleteAppoiontment'); ?>">

        <h1>Admin - Manage Appointments</h1>

        <!-- Button to add a new appointment -->

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Service Type</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?php echo $appointment['id']; ?></td>
                        <td><?php echo $appointment['user_id']; ?></td>
                        <td><?php echo $appointment['service_type']; ?></td>
                        <td><?php echo $appointment['appointment_date']; ?></td>
                        <td><?php echo $appointment['appointment_time']; ?></td>
                        <td><?php echo $appointment['duration']; ?> minutes</td>
                        <td>
                            <!-- Status dropdown to update appointment status -->
                            <select class="status-select">
                                <option value="Pending" <?php echo $appointment['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="Confirmed" <?php echo $appointment['status'] == 'Confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                <option value="Completed" <?php echo $appointment['status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                                <option value="Cancelled" <?php echo $appointment['status'] == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                            </select>
                        </td>
                        <td>
                            <a class="action-link" href="<?php echo site_url('deleteAppoiontment'); ?>" >Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
                </form>

    </div>
</body>
</html>
