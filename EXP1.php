<?php
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if (empty($name))
        $errors['name'] = "Name is required";
    elseif (!preg_match("/^[a-zA-Z ]{3,}$/", $name))
        $errors['name'] = "Enter a valid name";

    if (empty($email))
        $errors['email'] = "Email is required";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors['email'] = "Invalid email";

    if (!preg_match("/^[0-9]{10}$/", $mobile))
        $errors['mobile'] = "Enter 10 digit mobile number";

    if (strlen($password) < 8)
        $errors['password'] = "Minimum 8 characters required";

    if ($password != $confirm)
        $errors['confirm'] = "Passwords do not match";

    if (empty($errors))
        $success = "Registration Successful!";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Registration Form</title>
<style>
.error {
    color: red;
    font-size: 14px;
}
</style>
</head>
<body>

<h2>Registration Form</h2>

<form method="POST">

Name:<br>
<input type="text" name="name" required>
<div class="error"><?php echo $errors['name'] ?? ''; ?></div>
<br>

Email:<br>
<input type="text" name="email" required>
<div class="error"><?php echo $errors['email'] ?? ''; ?></div>
<br>

Mobile Number:<br>
<input type="text" name="mobile" required>
<div class="error"><?php echo $errors['mobile'] ?? ''; ?></div>
<br>

Password:<br>
<input type="password" name="password" required>
<div class="error"><?php echo $errors['password'] ?? ''; ?></div>
<br>

Confirm Password:<br>
<input type="password" name="confirm" required>
<div class="error"><?php echo $errors['confirm'] ?? ''; ?></div>
<br>

<input type="submit" value="Register">

</form>

<?php
if ($success) {
    echo "<p style='color:green'>$success</p>";
}
?>

</body>
</html>
