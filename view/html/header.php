<header>
    <div class="logo-div">
        <a href="#"><img class="logo-image" src="view/img/vegetables.png" /></a>
        <a href="#"><p class="logo-text">Cooking Recipies</p></a>
    </div>
    <div>
        <a class="menu-link <?= isset($_SESSION["current_page"]) ? (($_SESSION["current_page"] == "home") ? "" : "inactive") : "inactive" ?>" href="#">Home</a>
        <a class="menu-link <?= isset($_SESSION["current_page"]) ? (($_SESSION["current_page"] == "write") ? "" : "inactive") : "inactive" ?>" href="#">Write Recipy</a>
        <a class="menu-link <?= isset($_SESSION["current_page"]) ? (($_SESSION["current_page"] == "profile") ? "" : "inactive") : "inactive" ?>" href="#">Profile</a>
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