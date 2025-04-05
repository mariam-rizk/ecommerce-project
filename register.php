<?php require_once ('inc/header.php'); 
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
?>

<div class="container mt-4 mb-4">
<h2>Register</h2>
<form action="handelers/register_handeler.php" method="POST">
    <div class="mb-3">
    <label for="name" class="form-label">Name:
        <input type="text" id="name" name="name" class="form-control">
    </label>
    </div>

    <div class="mb-3">
    <label for="email" class="form-label">Email:
        <input type="text" id="email" name="email" class="form-control">
    </label>
    </div>

    <div class="mb-3">
    <label for="password" class="form-label">Password:
        <input type="text" id="password" name="password" class="form-control">
    </label>
    </div>

    <div class="mb-3">
    <label for="confirm_password" class="form-label">Confirm Password:
        <input type="text" id="confirm_password" name="confirm_password" class="form-control">
    </label>
    </div>

    <div class="mb-3">
    <label for="remember_me">
        <input type="checkbox" id="remember_me" name="remember_me"> Remember Me
    </label>
    </div>

    <button type="submit" class="btn btn-outline-dark">Register</button>
</form>
</div>

<?php require_once ('inc/footer.php'); ?>

    