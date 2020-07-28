<?php require "components/header.php";?>

<main>
    <div class="container">
        <form class="form-control" action="inc/signup.inc.php" method="POST">
            <h1>Sign Up Form</h1>
            <input name="username" type="text" placeholder="Username">
            <input name="email" type="email" placeholder="Email">
            <input name="password" type="password" placeholder="Password">
            <input name="re-password" type="password" placeholder="Repeat Password">
            <input name="submit-signup" type="submit" value="Create account">
        </form>
    </div>
</main>

<?php require "components/footer.php";?>
