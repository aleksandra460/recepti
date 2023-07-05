<header>
    <div class="logo-div">
        <a href="<?= getFullServerPath() . "/"; ?>"><img class="logo-image" src="view/img/vegetables.png" /></a>
        <a href="<?= getFullServerPath() . "/"; ?>"><p class="logo-text">Cooking Recipes</p></a>
    </div>
    <div class="menu-links-div">
        <a class="menu-link <?= isset($_SESSION["current_page"]) ? (($_SESSION["current_page"] == "home") ? "" : "inactive") : "inactive" ?>" href="#">Home</a><span class="menu-separator">&nbsp;|&nbsp;</span>
        <a class="menu-link <?= isset($_SESSION["current_page"]) ? (($_SESSION["current_page"] == "write") ? "" : "inactive") : "inactive" ?>" href="#">Write Recipy</a><span class="menu-separator">&nbsp;|&nbsp;</span>
        <a class="menu-link <?= isset($_SESSION["current_page"]) ? (($_SESSION["current_page"] == "profile") ? "" : "inactive") : "inactive" ?>" href="<?= getFullServerPath() . "/profile" ?>"><?= (isset($_SESSION["user"])) ? "Profile" : "Log in / Register"; ?></a>
        <?php 
        if (isset($_SESSION["user"]) && $_SESSION["user"]["is_admin"] == 1) {
            ?>
            <a class="menu-link <?= isset($_SESSION["current_page"]) ? (($_SESSION["current_page"] == "admin") ? "" : "inactive") : "inactive" ?>" href="#">Admin</a>
            <?php
        }
        ?>
    </div>
</header>
<hr>