<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = mysqli_query($connection, "SELECT * FROM trainings WHERE user_id='$user_id'");
?>

<h2>My Trainings</h2>
<a href="add_training.php">Add Training</a> | 
<a href="dashboard.php">Back to Dashboard</a>
<br><br>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Training Name</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['training_name']; ?></td>
            <td><?php echo $row['training_date']; ?></td>
            <td>
                <a href="edit_training.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                <a href="delete_training.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this training?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
