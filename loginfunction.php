<?php
session_start();
include ('config.php');

//$email    = "";
//$password = "";
$errors = array();
//var_dump($_REQUEST['login_user']);
if (isset($_POST['login_user'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $user =  $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
        $username = $user[0]['userName'];
        $userId = $user[0]['id'];
        if ($user ) {
            $_SESSION['username'] = $username;
            $_SESSION['userid'] = $userId;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        }else {
            array_push($errors, "Wrong email/password combination");
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