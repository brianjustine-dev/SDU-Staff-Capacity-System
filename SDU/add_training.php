<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$error = "";

if (isset($_POST['save'])) {
    $training_name = trim($_POST['training_name']);
    $training_date = $_POST['training_date'];
    $user_id = $_SESSION['user_id'];

    if (empty($training_name) || empty($training_date)) {
        $error = "Please fill in all required fields.";
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $training_date)) {
        $error = "Invalid date format.";
    } else {
        $stmt = $conn->prepare("INSERT INTO trainings (user_id, training_name, training_date) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $training_name, $training_date);
        $stmt->execute();

        header("Location: trainings.php");
        exit();
    }
}
?>

<h2>Add Training</h2>

<?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST">
    Training Name: <input type="text" name="training_name" required><br><br>
    Training Date: <input type="date" name="training_date" required><br><br>
    <button type="submit" name="save">Save</button>
</form>
<a href="trainings.php">Back</a>
