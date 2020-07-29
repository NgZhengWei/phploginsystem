<?php require "components/header.php";?>

<main>
    

    <div class="container">
    <?php
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] == 'emptyfield') {
            echo '<div class="alert alert-primary">
                    <p>Please fill up all fields!</p>
                </div>';
        }else if ($_GET['msg'] == 'nosuchuser') {
            echo '<div class="alert alert-primary">
                    <p>User does not exist</p>
                </div>';
        }else if ($_GET['msg'] == 'invalidpassword') {
            echo '<div class="alert alert-primary">
                    <p>Invalid password</p>
                </div>';
        }
    }
    ?>

        <?php
        if (isset($_SESSION['username'])){
            echo "<h1>Welcome {$_SESSION['username']}, you are logged in!</h1>";
        } else {
            echo "<h1>You are logged out!</h1>";
        }
        ?>
    </div>
</main>

<?php require "components/footer.php";?>

