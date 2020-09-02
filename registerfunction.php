<?php
    include ('config.php');
$name = "";
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
    $user =  $pdo->query($query)->fetch(PDO::FETCH_ASSOC);

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
            header("location: adminLogin.php");
           // echo 'Inserted';
        } else {
            echo 'Could not insert';
        }
    }
}
?>
    <html lang="en">
    <head>
        <style type = "text/css">
            .message {
                width: 100%;
                margin: 0px auto;
                padding: 10px 0px;
                color: #3c763d;
                background: #dff0d8;
                border: 1px solid #3c763d;
                border-radius: 5px;
                text-align: center;
            }
            .error {
                color: #a94442;
                background: #f2dede;
                border: 1px solid #a94442;
                margin-bottom: 20px;
            }
            .validation_errors p {
                text-align: left;
                margin-left: 10px;
            }
            .logged_in_info {
                text-align: right;
                padding: 10px;
            }
        </style>
    </head>
    </html>

<?php if (count($errors) > 0) : ?>
    <div class="message error validation_errors" >
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>