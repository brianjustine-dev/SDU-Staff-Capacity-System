<?php
session_start();
include("db.php");

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$fullname = $_SESSION['user'];
$role = $_SESSION['role']; // roles: staff, office_head, admin
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            background-color: #f8f8f8;
        }
        h2 { 
            color: #800000; 
        }
        .nav { 
            margin-bottom: 20px; 
            padding: 10px;
            background: #eee;
            border-radius: 6px;
        }
        .nav a { 
            margin-right: 15px; 
            text-decoration: none; 
            color: #800000; 
            font-weight: bold; 
        }
        .nav a:hover { 
            text-decoration: underline; 
        }
        p { 
            font-size: 14px;
            color: #333;
        }
    </style>
</head>
<body>

<h2>Welcome, <?= htmlspecialchars($fullname) ?> (<?= ucfirst($role) ?>)</h2>

<div class="nav">
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="logout.php">🚪 Logout</a>

    <?php if ($role == 'staff') { ?>
        <a href="profile.php">👤 My Profile</a>
        <a href="trainings.php">📘 My Trainings</a>
        <a href="activities.php">📌 My Activities</a>
    <?php } ?>

    <?php if ($role == 'office_head') { ?>
        <a href="users.php">👥 Manage My Staff</a>
        <a href="trainings.php">📘 Staff Trainings</a>
        <a href="activities.php">📌 Staff Activities</a>
    <?php } ?>

    <?php if ($role == 'admin') { ?>
        <a href="users.php">👥 Manage Users</a>
        <a href="trainings.php">📘 Manage Trainings</a>
        <a href="activities.php">📌 Manage Activities</a>
        <a href="reports.php">📊 Reports</a>
    <?php } ?>
</div>

<p>✅ Use the menu above to navigate the system.</p>

</body>
</html>
