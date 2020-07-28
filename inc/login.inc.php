<?php

if (isset($_POST['submit-login'])){
    $username = htmlspecialchars(strtolower($_POST['username']));
    $password = htmlspecialchars($_POST['password']);

    if (!checkEmptyFields($username, $password)) {
        header("Location: ../index.php?msg=emptyfield&username=".$username);
        exit();
    }

    if (!checkUserExist($username)) {
        header("Location: ../index.php?msg=nosuchuser&username=".$username);
        exit();
    }

    if (checkPassword($username, $password) === TRUE){
        header("Location: ../index.php?msg=welcome&username=".$username);;
        exit();
    } else {
        header("Location: ../index.php?msg=invalidpassword&username=".$username);
        exit();
    }
}

function checkEmptyFields($username, $password) { //returns true if none empty
    if (empty($username) || empty($password)){
        return FALSE;
    } else {
        return TRUE;
    }
}

function checkUserExist($username) { //True if exist
    require "dbh.inc.php";

    $stmt = $conn->prepare("SELECT username FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows() == 0) {
        $stmt->free_result();
        $stmt->close();
        return FALSE;
    }else {
        $stmt->free_result();
        $stmt->close();
        return TRUE;
    }
}

function checkPassword($username, $password) { //true if pass is correct
    require "dbh.inc.php";

    $stmt = $conn->prepare("SELECT password FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $arr = $result->fetch_assoc();

    if (password_verify($password, $arr['password']) === TRUE) {
        $stmt->free_result();
        $stmt->close();
        return TRUE;
    }else {
        $stmt->free_result();
        $stmt->close();
        return FALSE;
    }
}