<?php

if (isset($_POST['submit-signup'])){
    $username = htmlspecialchars(strtolower($_POST['username']));
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['re-password']);

    if (!checkEmptyFields($username, $email, $password, $password2)) {
        header("Location: ../signup.php?msg=emptyfield&username=".$username."&email=".$email);
        exit();
    }

    if (!checkUsername($username) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?msg=invalidusernameemail&username=".$username."&email=".$email);
        exit();
    }

    if (!checkUsername($username)) {
        header("Location: ../signup.php?msg=invalidusername&username=".$username."&email=".$email);
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?msg=invalidemail&username=".$username."&email=".$email);
        exit();
    }

    if (!($password === $password2)) {
        header("Location: ../signup.php?msg=passdiffer&username=".$username."&email=".$email);
        exit();
    }

    require "dbh.inc.php";

    $hashpass = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT username FROM users WHERE username=?";
    $stmt = $conn->prepare($sql); //create new query
    $stmt->bind_param("s", $username); //binding username to query
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows() > 0) {
        header("Location: ../signup.php?msg=usernametaken&username=".$username."&email=".$email);
        $stmt->free_result();
        $stmt->close();
        exit();
    } else {
        $stmt->free_result();
        $stmt->close();
        $stmt = $conn->prepare("SELECT username FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows() > 0) {
            header("Location: ../signup.php?msg=emailtaken&username=".$username."&email=".$email);
            $stmt->free_result();
            $stmt->close();
            exit();
        }
        $stmt->free_result();
        $stmt->close();
    }

    $stmt = $conn->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
    $stmt->bind_param("sss", $username, $email, $hashpass);
    $stmt->execute();
    $conn->close();
    header("Location: ../signup.php?msg=accountcreated&username=".$username."&email=".$email);
    exit();
    
}else {
    header("Location: ../signup.php");
}

function checkEmptyFields($username, $email, $pass1, $pass2) {
    if (empty($username) || empty($email) || empty($pass1) || empty($pass2)) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function checkUsername($username) {
    if (preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        return TRUE;
    } else {
        return FALSE;
    }
}