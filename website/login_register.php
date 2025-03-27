<?php
session_start();
require_once 'config.php';

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $age = $_POST['age'];

    // Check if the email already exists in the database
    $checkEmail = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email); // "s" means the email is a string
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        $_SESSION['register_error'] = 'Email is already registered!';
        $_SESSION['active_form'] = 'register';
        header("Location: index.php");
        exit();
    } else {
        // Insert the new user into the database
        $insertUser = $conn->prepare("INSERT INTO users (name, surname, email, password, age) VALUES (?, ?, ?, ?, ?)");
        $insertUser->bind_param("sssss", $name, $surname, $email, $password, $age); // "sssss" means 5 string parameters

        if ($insertUser->execute()) {
            $_SESSION['register_success'] = 'Registration successful! You can now login.';
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['register_error'] = 'Error during registration: ' . $conn->error;
            header("Location: index.php");
            exit();
        }
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the query to check login credentials
    $result = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $result->bind_param("s", $email); // Bind the email
    $result->execute();
    $result->store_result();

    if ($result->num_rows > 0) {
        $result->bind_result($id, $name, $surname, $emailDb, $passwordDb, $age);
        $result->fetch();

        // Verify the password
        if (password_verify($password, $passwordDb)) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $emailDb;
            header("Location: main.php");
            exit();
        } else {
            $_SESSION['login_error'] = 'Incorrect email or password';
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = 'Incorrect email or password';
        header("Location: index.php");
        exit();
    }
}
?>
