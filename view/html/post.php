<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $result["title"]; ?> - Recipes</title>
    <?php require_once("view/html/include.php"); ?>
</head>
<body>
    <?php 
    require_once("view/html/header.php");
    ?>

    <main class="main-post">
        <div class="recipe-post">
            <?php if ($result != false) { ?>
            <h3>
                <?= $result["title"] ?>
            </h3>
            <p>Score: <?= number_format($voteDAO->countVotes($result["id"]), 2); ?>/5</p>
            <div style="margin-bottom: 20px;">
            <?= (isset($_SESSION["voteerror"]) ? "<p style='color:red;'> " . $_SESSION["voteerror"] . "</p>" : "") ?>    
        
            <?php 
            if (isset($_SESSION["user"])) {
                $v = $voteDAO->getVote($_SESSION["user"]["id"], $result["id"]);
                if ($v == false) {
                    ?>
                    <form action="<?= getFullServerPath() . "/vote" ?>" method="POST">
                        <input type="hidden" value="<?= $result["id"]; ?>" name="recipy_id">
                        <label for="vote">Vote:</label> 
                        <input name="vote" type="number" min="1" max="5">
                        <button type="submit">Vote</button>
                    </form>
                    <?php
                } else { ?>
                    <p>
                        Your vote: <?= $v["vote"] ?>
                    </p>
                <?php
                }
            }
            ?>
            </div>
            <img src="<?= $result["img"]; ?>" height="250px" />
            <p>
                <?= $result["body"]; ?>
            </p>
            <p>
                Posted on <?= $result["create_time"] ?> 
                by <?php 
                    $u = $userDAO->getUser($result["user_id"]);
                    echo($u["username"]);  
                ?>
            </p>
            <?php } ?>
        </div>
        <?php 
        
        if (isset($_SESSION["user"])) { ?>
        <div class="post-comment-div">
        <?= (isset($_SESSION["commenterror"]) ? "<p style='color:red;'> " . $_SESSION["commenterror"] . "</p>" : "") ?>    
            <form action="<?= getFullServerPath() . "/comments" ?>" method="POST">
                <input type="hidden" name="post_id" value="<?= $result["id"] ?>">
                <p><label for="body">Post a new comment:</label></p>
                <textarea class="comment-textarea" name="body"></textarea>
                <p><button class="comment-button" type="submit">Submit</button></p>
            </form>
        </div>
        <?php
        }

        ?>
        <div class="comments-section">
            <hr>
            <h3>Comments:</h3>
            <hr>
            <?php 
            $comments = $commentDAO->getComments($result["id"]);
            foreach($comments as $comment) {
            ?>
                <div class="comment">
                    <p class="comment-info">
                        <?= $comment["username"] . " | " . $comment["create_time"]; ?>
                    </p>
                    <p class="comment-body">
                        <?= $comment["body"]; ?>
                    </p>
                    <hr>
                </div>
            <?php 
            } 
            ?>
        </div>
    </main>

    <?php 
    
    // Set the expiration date to one week from the current time
    $expirationDate = time() + (7 * 24 * 60 * 60); // 7 days * 24 hours * 60 minutes * 60 seconds

    // Set the cookie value to $result["id"]
    $cookieValue = $result["id"];

    // Set the cookie
    setcookie("post", $cookieValue, $expirationDate);
    
    ?>

    <?php 
    require_once("view/html/footer.php");
    ?>
</body>
</html>