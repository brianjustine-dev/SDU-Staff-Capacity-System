<?php 
include("db.php");
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
} else {
    header("Location: users.php");
    exit();
}
?>

<h2>Edit User</h2>
<form method="POST" action="update.php">
    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
    <label>Full Name:</label>
    <input type="text" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" required><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br>

    <label>Role:</label>
    <select name="role" required>
        <option value="admin" <?= $user['role']=='admin'?'selected':''; ?>>Admin</option>
        <option value="office_head" <?= $user['role']=='office_head'?'selected':''; ?>>Office Head</option>
        <option value="staff" <?= $user['role']=='staff'?'selected':''; ?>>Staff</option>
    </select><br><br>

    <button type="submit">Update</button>
</form>
<a href="users.php">Cancel</a>
