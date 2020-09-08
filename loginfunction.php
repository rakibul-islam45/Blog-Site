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
    if($email == 'admin@gmail.com' && $password == 'admin'){
        header('Location: adminLogin.php');
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
            header('location: userprofile.php');
        }else {
            array_push($errors, "Wrong email/password combination");
        }
    }
}

?>


<?php if (count($errors) > 0) : ?>

  <?php  echo '<script type="text/javascript">alert("Error: ' . implode(" , ", $errors) . '");
                       window.location.href="login.php";
                        </script>'; ?>
<!--    </div>-->
<?php endif ?>