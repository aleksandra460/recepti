<?php 

class userController {
    public function getProfile() {
        if (!isset($_SESSION["user"])) {
            require_once("view/html/login.php");
            exit();
        } else {
            $recipyDAO = new RecipyDao();
            $posts = $recipyDAO->getRecipesByUserId($_SESSION["user"]["id"]);
            require_once("view/html/profile.php");
        }
    }

    public function login($username, $password) {
        $userDAO = new UserDao();
        $result = $userDAO->getUserByUsernamePassword($username, $password);
        if (!$result) {
            $_SESSION["loginerror"] = "Username or password is invalid";
            require_once("view/html/login.php");
        } else {
            $_SESSION["user"] = $result;
            header("Location: " . getFullServerPath());
            exit();
        }
    }
}

?>