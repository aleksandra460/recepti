<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register - Recipes</title>
    <?php require_once("view/html/include.php"); ?>
</head>
<body>
    <?php 
    require_once("view/html/header.php");
    ?>

    <main class="login-forms-container">
        <div>
            <form class="login-form" action="<?= getFullServerPath() . "/login" ?>" method="POST">
                <h3>Login</h3>
                <?= (isset($_SESSION["loginerror"]) ? "<p style='color:red;'> " . $_SESSION["loginerror"] . "</p>" : "") ?>
                <label for="username">Username:</label>
                <input type="text" name="username" />
                <label for="password">Password:</label>
                <input type="password" name="password" />
                <button type="submit">Log in</button>
            </form>
        </div>
        <hr>
        <div>
            <form class="login-form" action="<?= getFullServerPath() . "/register" ?>" method="POST">
                <h3>Register</h3>
                <?= (isset($_SESSION["registererror"]) ? "<p style='color:red;'> " . $_SESSION["registererror"] . "</p>" : "") ?>
                <label for="username">Username:</label>
                <input type="text" name="username" />
                <label for="email">Email:</label>
                <input type="email" name="email" />
                <label for="password">Password:</label>
                <input type="password" name="password" />
                <label for="password">Confirm password:</label>
                <input type="password" name="confirm_password" />
                <button type="submit">Register</button>
            </form>
        </div>
    </main>

    <?php 
    require_once("view/html/footer.php");
    ?>
</body>
</html>