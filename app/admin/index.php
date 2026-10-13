<?php
require '../../config/config.php';

requireRole('admin');

$section = $_GET['section'] ?? 'activity-logs';

$action = $_GET['action'] ?? '';

if ($section === 'activity-logs'){
        // Activity Logs Query
        $stmt = $pdo->query("
        SELECT * 
        FROM activity_logs
        ORDER BY activity_log_created_at DESC
    ");
}

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
</head>
<body>
        <h1>Welcome, Admin!</h1>

        <a href="../../auth/signout.php" class="btn btn-danger">
            Sign Out
        </a>
        <hr>

    <nav>
        <a href="index.php?section=activity-logs">Activity Logs |</a>
    </nav>

    <?php if ($section === 'activity-logs'): ?>

        <h4>Activity Logs</h4>

        <table id="activityTable" border="1" cellpadding="5" cellspacing="0">

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
                        <td>
                            <?= htmlspecialchars($activity['activity_log_id']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($activity['user_id']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($activity['user_email']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($activity['activity_log_action']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($activity['activity_log_status']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($activity['activity_log_ip_address']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($activity['activity_log_user_agent']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($activity['activity_log_created_at']) ?>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>
</body>
</html>