<?php


?>
<div style="width: 40%; margin: 20px auto;">
    <form method="post" action="registerfunction.php" >
        <h2>Registration Form</h2>
<!--        --><?php //include(ROOT_PATH . '/includes/errors.php') ?>
        <div>
            <label for="name">
                Name: </label>
            <input type="text" name="name"  placeholder="Name">
        </div>

        <div>
            <label for="username">
                Name: </label>
            <input  type="text" name="username"   placeholder="Username">
        </div>

        <div>
            <label for="email">
                Name: </label>
            <input type="email" name="email"  placeholder="Email">
        </div>

        <div>
            <label for="password">
                Name: </label>
            <input type="password" name="password_1" placeholder="Password">
        </div>

        <div>
            <label for="password">
                Name: </label>
            <input type="password" name="password_2" placeholder="Password confirmation">
        </div>
        <div>
            <button type="submit" class="btn" name="reg_user">Register</button>
        </div>
        <div>
        <p>
            Already a member? <a href="login.php">Sign in</a>
        </p>
        </div>
    </form>
</div>
