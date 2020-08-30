<?php
    include ('./config.php');

$username = "";
$email    = "";
$errors = array();


if (isset($_POST['reg_user'])) {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];


    if (empty($name)) {
        array_push($errors, "Please insert your name");
    }
    if (empty($username)) {
        array_push($errors, "Please insert your username");
    }
    if (empty($email)) {
        array_push($errors, "Insert Email!");
    }
    if (empty($password_1)) {
        array_push($errors, "Insert password");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "Passwords don't match");
    }


    $query = "SELECT * FROM users WHERE userName='$username' 
								OR email='$email' LIMIT 1";



    //$statement = $pdo->prepare($query);
   // $statement->execute();
    $user =  $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);

    if ($user) {
        if ($user['userName'] === $username) {
            array_push($errors, "Username already exists");
        }
        if ($user['email'] === $email) {
            array_push($errors, "Email already exists");
        }
    }

    if (count($errors) == 0) {
        $password = md5($password_1);
        $queryI = "INSERT INTO users (name, userName, email, password) 
					  VALUES(:name, :username, :email, :password)";


        $statement = $pdo->prepare($queryI);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);

        if($statement->execute()) {
            header("location: login.php");
           // echo 'Inserted';
        } else {
            echo 'Could not insert';
        }
    }
}