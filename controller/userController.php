<?php 

class userController {
    public function getProfile() {
        if (!isset($_SESSION["user"])) {
            require_once("view/html/login.php");
            exit();
        } else {
            $recipyDAO = new RecipyDao();
            $surveyDAO = new SurveyDAO();
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
            exit();
        } else {
            if ($result["is_banned"] == 1) {
                $_SESSION["loginerror"] = "This account has been banned";
                require_once("view/html/login.php");
                exit();
            }
            $_SESSION["user"] = $result;
            header("Location: " . getFullServerPath());
            exit();
        }
    }

    public function answerSurvey($user_id, $answer) {
        $surveyDAO = new SurveyDAO();

        $result = $surveyDAO->createSurvey($user_id, $answer);
        $this->getProfile();
    }

    public function getAdminPanel() {
        $surveyDAO = new SurveyDAO();
        $userDAO = new UserDAO();

        require_once("view/html/admin.php");
    }

    public function banUser($id, $ban) {
        $userDAO = new UserDAO();
        $userDAO->banUser($id, $ban);

        $this->getAdminPanel();
    }

    public function makeAdmin($id) {
        $userDAO = new UserDAO();
        $userDAO->makeAdmin($id);

        $this->getAdminPanel();
    }

    public function createUser($username, $email, $password, $confirm_password) {
        if ($username == "" || $email == "" || $password == "" || $confirm_password == "") {
            $_SESSION["registererror"] = "All fields are required";
            require_once("view/html/login.php");
            exit();
        }

        if ($password != $confirm_password) {
            $_SESSION["registererror"] = "Passwords do not match";
            require_once("view/html/login.php");
            exit();
        }
        
        $userDAO = new UserDAO();
        $user = [];
        $user["email"] = $email;
        $user["username"] = $username;
        $user["password"] = hash("SHA256", $password);
        $result = $userDAO->createUser($user);

        if ($result["rowCount"] > 0) {
            $_SESSION["user"] = $userDAO->getUser($result["lastInsertId"]);
            header("Location: " . getFullServerPath());
            exit();
        } 

        $_SESSION["registererror"] = "Unable to create account";
        require_once("view/html/login.php");
    }
}

?>