



<?php include('dashboardHeader.php'); ?>


<?php

$server = "127.0.0.1";
$dbname = "blogSite";
$user = "hasan";
$pass = "user200097";
global $pdo;
$pdo = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);

try {
    $pdo = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Throwable $t) {
    echo 'Cannot Connect to Database';
    die;
}




$postcount = $pdo->query('select count(*) from post')->fetchColumn();



?>


<title>Admin | Dashboard</title>
</head>
<body>
<div class="header">
    <div class="logo">
        <a href="<?php echo BASE_URL .'dashboard.php' ?>">
            <h1>Welcome to - Admin</h1>
        </a>
    </div>

</div>
<div class="container dashboard">
    <h1>Welcome</h1>
    <div class="stats">
        <a href="users.php" class="first">
            <span>43</span> <br>
            <span>Newly registered users</span>
        </a>
        <a href="managePosts.php">
            <span><?php echo $postcount?></span> <br>
            <span>Published posts</span>
        </a>
        <a>
            <span>43</span> <br>
            <span>Published comments</span>
        </a>
    </div>
    <br><br><br>
    <div class="buttons">
        <a href="users.php">Add Users</a>
        <a href="managePosts.php">Add Posts</a>
    </div>
</div>
</body>
</html>
