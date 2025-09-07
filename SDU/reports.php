<?php
session_start();
include("db.php");

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Total staff
$staffCount = mysqli_fetch_assoc(mysqli_query($connection, "SELECT COUNT(*) as total FROM users WHERE role='staff'"))['total'];

// Total trainings
$trainingCount = mysqli_fetch_assoc(mysqli_query($connection, "SELECT COUNT(*) as total FROM trainings"))['total'];

// Total activities
$activityCount = mysqli_fetch_assoc(mysqli_query($connection, "SELECT COUNT(*) as total FROM activities"))['total'];

// Trainings per staff
$trainingsPerStaff = mysqli_query($connection, "
    SELECT u.fullname, COUNT(t.id) as trainings
    FROM users u
    LEFT JOIN trainings t ON u.id = t.staff_id
    WHERE u.role='staff'
    GROUP BY u.id
");

// Activities per staff
$activitiesPerStaff = mysqli_query($connection, "
    SELECT u.fullname, COUNT(a.id) as activities
    FROM users u
    LEFT JOIN activities a ON u.id = a.staff_id
    WHERE u.role='staff'
    GROUP BY u.id
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reports</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { color: #800000; }
        table { border-collapse: collapse; width: 80%; margin-bottom: 30px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: center; }
    </style>
</head>
<body>

<h2>📊 SDU Reports</h2>

<h3>Overall Summary</h3>
<ul>
    <li>Total Staff: <?= $staffCount ?></li>
    <li>Total Trainings Conducted: <?= $trainingCount ?></li>
    <li>Total Activities: <?= $activityCount ?></li>
</ul>

<h3>Trainings per Staff</h3>
<table>
    <tr>
        <th>Staff Name</th>
        <th>No. of Trainings</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($trainingsPerStaff)) { ?>
    <tr>
        <td><?= $row['fullname'] ?></td>
        <td><?= $row['trainings'] ?></td>
    </tr>
    <?php } ?>
</table>

<h3>Activities per Staff</h3>
<table>
    <tr>
        <th>Staff Name</th>
        <th>No. of Activities</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($activitiesPerStaff)) { ?>
    <tr>
        <td><?= $row['fullname'] ?></td>
        <td><?= $row['activities'] ?></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
