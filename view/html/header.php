<header>
    <div class="logo-div">
        <a href="<?= getFullServerPath() . "/"; ?>"><img class="logo-image" src="view/img/vegetables.png" /></a>
        <a href="<?= getFullServerPath() . "/"; ?>"><p class="logo-text">Cooking Recipes</p></a>
    </div>
    <div class="menu-links-div">
        <a class="menu-link <?= isset($_SESSION["current_page"]) ? (($_SESSION["current_page"] == "home") ? "" : "inactive") : "inactive" ?>" href="<?= getFullServerPath() ?>">Home</a><span class="menu-separator">&nbsp;|&nbsp;</span>
        <a class="menu-link <?= isset($_SESSION["current_page"]) ? (($_SESSION["current_page"] == "write") ? "" : "inactive") : "inactive" ?>" href="<?= getFullServerPath() . "/write" ?>">Write a Recipe</a><span class="menu-separator">&nbsp;|&nbsp;</span>
        <a class="menu-link <?= isset($_SESSION["current_page"]) ? (($_SESSION["current_page"] == "profile") ? "" : "inactive") : "inactive" ?>" href="<?= getFullServerPath() . "/profile" ?>"><?= (isset($_SESSION["user"])) ? "Profile" : "Log in / Register"; ?></a><span class="menu-separator">&nbsp;|&nbsp;</span>
        <a class="menu-link <?= isset($_SESSION["current_page"]) ? (($_SESSION["current_page"] == "about-us") ? "" : "inactive") : "inactive" ?>" href="<?= getFullServerPath() . "/about-us" ?>">About Us</a>
        <?php 
        if (isset($_SESSION["user"]) && $_SESSION["user"]["is_admin"] == 1) {
            ?>
            <span class="menu-separator">&nbsp;|&nbsp;</span>
            <a class="menu-link <?= isset($_SESSION["current_page"]) ? (($_SESSION["current_page"] == "admin") ? "" : "inactive") : "inactive" ?>" href="<?= getFullServerPath() . "/admin" ?>">Admin</a>
            <?php
        }
        ?>
        <?php 
        if (isset($_SESSION["user"])) {
            ?>
            <span class="menu-separator">&nbsp;|&nbsp;</span>
            <a class="menu-link inactive" href="<?= getFullServerPath() . "/logout" ?>">Log out</a>
            <?php
        }
        ?>
    </div>
</header>
<hr>