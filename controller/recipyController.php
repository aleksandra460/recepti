<?php 

class recipyController {
    public function getRecipies($page, $limit, $offset) {
        $recipyDAO = new RecipyDAO();
        $voteDAO = new VoteDAO();

        $results = $recipyDAO->getRecipies($limit, $offset);
        $count = $recipyDAO->getCount();
        $userDAO = new UserDAO();
        $commentDAO = new CommentDAO();
        require_once("view/html/home.php");
    }

    public function getRecipe($id) {
        $recipyDAO = new RecipyDAO();
        $userDAO = new UserDAO();
        $voteDAO = new VoteDAO();
        $commentDAO = new CommentDAO();
        $result = $recipyDAO->getRecipy($id);
        require_once("view/html/post.php");
    }

    public function createComment($user_id, $recipy_id, $body) {
        $commentDAO = new CommentDAO();
        try {
            $result = $commentDAO->createComment($user_id, $recipy_id, $body);
        } catch (Exception $e) {
            $_SESSION["commenterror"] = "Unable to post comment.";
            echo($e->getMessage());
        }

        if ($result > 0) {
            unset($_SESSION["commenterror"]);
        }

        $this->getRecipe($recipy_id);
    }

    public function createVote($user_id, $recipy_id, $vote) {
        $voteDAO = new VoteDAO();
        $result = $voteDAO->createVote($user_id, $recipy_id, $vote);

        if ($result < 1) {
            $_SESSION["voteerror"] = "Failed to create vote";
        }

        $this->getRecipe($recipy_id);
    }

    public function createRecipy($user_id, $title, $img, $body) {
        $recipyDAO = new RecipyDAO();

        $result = $recipyDAO->createRecipy($user_id, $title, $img, $body);
        if ($result["count"] < 1) {
            $_SESSION["writeerror"] = "Unable to create recipe";
            require_once("view/html/write-recipe.php");
            exit();
        }

        header("Location: " . getFullServerPath() . "/recipes?id=" . $result["lastInsertId"]);
        exit();
    }
}

?>