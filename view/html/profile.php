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

    <main class="profile-main">
        <?php
            if (!$surveyDAO->getSurvey($_SESSION["user"]["id"])) {
                ?>
                <h3> User survey: Do you like the website? </h3>
                <a class="survey-button yes" href="<?= getFullServerPath() . "/survey?answer=1" ?>">Yes</a>
                <a class="survey-button no" href="<?= getFullServerPath() . "/survey?answer=0" ?>">No</a>
                <?php
            } else {
                echo("<h3>Thank you for participating in the user survey.</h3>");
            }
        ?>
        <div class="profile-table-div">
            <?php 
            $u = $_SESSION["user"];
            ?>
            <table class="profile-table">
                <tbody>
                    <tr>
                        <td>Username: </td>
                        <td><?= $u["username"] ?></td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td><?= $u["email"] ?></td>
                    </tr>
                    <tr>
                        <td>Profile created: </td>
                        <td><?= $u["create_time"] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <div>
            <h3>My recipes</h3>
            <ul>
                <?php
                
                foreach ($posts as $post) {
                    ?>
                    <li>
                        <a href="<?= getFullServerPath() . "/recipes?id=" . $post["id"] ?>"><?= $post["title"] ?></a>
                    </li>
                    <?php
                }

                ?>
            </ul>
        </div>
    </main>

    <?php 
    require_once("view/html/footer.php");
    ?>
</body>
</html>