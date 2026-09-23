<?php
require '../../config/config.php';

requireRole('admin');

logActivity(
    $pdo,
    $_SESSION['user_id'],
    $_SESSION['user_email'],
    'view_activity_logs',
    'success'
);

// Activity Logs Query#3
$stmt = $pdo->query("
    SELECT * 
    FROM activity_logs
    ORDER BY activity_log_created_at DESC
");

$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
        body {
    background-color: #f5f6fa;
    color: #212529;
}

/* Page heading */
h1 {
    font-size: 40px;
    font-weight: 600;
}

/* Activity logs card */
.card {
    border: none;
    border-radius: 10px;
    overflow: hidden;
}

/* Card header */
.card-header {
    background-color: #212529;
    color: white;
    padding: 15px 20px;
}

/* Table */
.table {
    margin-bottom: 0;
}

.table thead th {
    background-color: #343a40;
    color: white;
    font-size: 14px;
    white-space: nowrap;
    vertical-align: middle;
}

.table tbody td {
    font-size: 16px;
    vertical-align: middle;
}

/* Row hover */
.table-hover tbody tr:hover {
    background-color: #e9f2ff;
}

/* Sign out button */
.btn-danger {
    border-radius: 10px;
}

/* Responsive table */
.table-responsive {
    max-height: 600px;
    overflow: auto;
}

/* Keep table headers visible while scrolling */
.table thead th {
    position: sticky;
    top: 0;
    z-index: 1;
}

</style>
</head>
<body>
    <div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Welcome, Admin!</h1>

        <a href="../../auth/signout.php" class="btn btn-danger">
            Sign Out
        </a>
    </div>

    <div class="card shadow-sm">

        <div class="card-header">
            <h4 class="mb-0">Activity Logs</h4>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Record ID</th>
                            <th>User ID</th>
                            <th>User Email</th>
                            <th>Action</th>
                            <th>Status</th>
                            <th>IP Address</th>
                            <th>User Agent</th>
                            <th>Date & Time</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($activities as $activity): ?>
                            <tr>
                                <td><?= htmlspecialchars($activity['activity_log_id']) ?></td>
                                <td><?= htmlspecialchars($activity['user_id']) ?></td>
                                <td><?= htmlspecialchars($activity['user_email']) ?></td>
                                <td><?= htmlspecialchars($activity['activity_log_action']) ?></td>
                                <td><?= htmlspecialchars($activity['activity_log_status']) ?></td>
                                <td><?= htmlspecialchars($activity['activity_log_ip_address']) ?></td>
                                <td><?= htmlspecialchars($activity['activity_log_user_agent']) ?></td>
                                <td><?= htmlspecialchars($activity['activity_log_created_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>
</body>
</html>