<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write a Recipe - Recipes</title>
    <?php require_once("view/html/include.php"); ?>
</head>
<body>
    <?php 
    require_once("view/html/header.php");
    ?>

    <main class="main-recipes">
        <div>
            <?= (isset($_SESSION["writeerror"]) ? "<p style='color:red;'> " . $_SESSION["writeerror"] . "</p>" : "") ?>
                
            <form class="write-form" action="<?= getFullServerPath() . "/write" ?>" method="POST">
                <h3>Create a new recipe:</h3>
                <label for="title">Title:</label>
                <input type="text" name="title">
                <label for="img">Image link:</label>
                <input type="url" name="img">
                <label for="body">Recipe:</label>
                <textarea class="comment-textarea" name="body"></textarea>
                <button class="comment-button" type="submit">Create Recipe</button>
            </form>
        </div>
    </main>

    <?php 
    require_once("view/html/footer.php");
    ?>
</body>
</html>