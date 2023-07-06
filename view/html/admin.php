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
        <h3>User satisfaction survey results</h3>
        <ul>
            <?php 
            $survey_results = $surveyDAO->getVoteCount();
            ?>
            <li>Yes: <?= $survey_results["yes"] ?></li>
            <li>No: <?= $survey_results["no"] ?></li>
        </ul>
        <h3>
            User List:
        </h3>
        <ul>
            <?php 
            $users = $userDAO->getAllUsers();
            foreach ($users as $user) {
            ?>
            <li>
                <p><?= $user["username"] ?> - 
                <?php 
                if ($user["is_banned"] == 0) {
                    ?>
                    <a href="<?= getFullServerPath() . "/ban?ban=1&id=" . $user["id"]?>">Ban
                    </a>
                    <?php
                } else {
                    ?>
                    <a href="<?= getFullServerPath() . "/ban?ban=0&id=" . $user["id"]?>">Unban
                    </a>
                    <?php
                }
                ?>
                - 
                <?php 
                if ($user["is_admin"] == 0) {
                    ?>
                    <a href="<?= getFullServerPath() . "/make-admin?id=" . $user["id"]?>">Make Admin
                    </a>
                    <?php
                }
                ?>
                </p>
            </li>
            <?php 
            } 
            ?>
        </ul>
    </main>

    <?php 
    require_once("view/html/footer.php");
    ?>
</body>
</html>