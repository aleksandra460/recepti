<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Recipes</title>
    <?php require_once("view/html/include.php"); ?>
</head>
<body>
    <?php 
    require_once("view/html/header.php");
    ?>

    <main class="main-recipes">
        <h3> About us </h3>
        <div style="width:100%; overflow-x: auto; text-align: center;">
            <img style="margin: 0 auto;" src="view/img/aleksandra.jpg">
        </div>
        <p> My name is Aleksandra Panović, and I am a fourth year student of Information
            Technologies at the Faculty of Technical Sciences in Čačak.
            <br><br>
            This project was created in order to make sharing cooking recipes easier, and
            for the purposes of Internet Programming class.
            <br><br>
            <iframe style="width:90%; height: 500px;" src="view/seminarski.pdf"></iframe>
    </main>

    <?php 
    require_once("view/html/footer.php");
    ?>
</body>
</html>