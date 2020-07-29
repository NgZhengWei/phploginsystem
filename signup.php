<?php require "components/header.php";?>

<main>
    <div class="container">
    <?php
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] == 'emptyfield') {
            echo '<div class="alert alert-primary my-1">
                    <p>Please fill up all fields!</p>
                </div>';
        }else if ($_GET['msg'] == 'usernametaken') {
            echo '<div class="alert alert-primary my-1">
                    <p>Username has been taken.</p>
                </div>';
        }else if ($_GET['msg'] == 'passdiffer') {
            echo '<div class="alert alert-primary my-1">
                    <p>Passwords don\'t match</p>
                </div>';
        }
    }
    ?>

        <form class="form-control" action="inc/signup.inc.php" method="POST">
            <h1>Sign Up Form</h1>
            <input name="username" type="text" placeholder="Username" value="<?php if (isset($_GET['username'])){echo $_GET['username'];} ?>">
            <input name="email" type="email" placeholder="Email" value="<?php if (isset($_GET['email'])){echo $_GET['email'];} ?>">
            <input name="password" type="password" placeholder="Password">
            <input name="re-password" type="password" placeholder="Repeat Password">
            <input name="submit-signup" type="submit" value="Create account">
        </form>
    </div>
</main>

<?php require "components/footer.php";?>
