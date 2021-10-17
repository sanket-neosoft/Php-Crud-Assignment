<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light shadow">
    <?php
    if (!empty($user_id)) {
    ?>
        <!-- Toggle button -->
        <button id="sidebarCollapse" type="button" class="btn btn-sm btn-outline-success mr-3"><i class="bi bi-list"></i></button>
    <?php
    }
    ?>

    <!-- logo -->
    <a href="?p=dashboard" class="ml-2"><img src="https://uilogos.co/img/logomark/earth.png" width="40px" class="img-fluid" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php
        if (empty($user)) {
        ?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-3">
                    <a href="?p=register" class="nav-link">Register</a>
                </li>
                <li class="nav-item mx-3">
                    <a href="?p=login" class="btn btn-success my-2 my-sm-0">Login</a>
                </li>
            </ul>
        <?php
        } else {
        ?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-3">
                    <a class="nav-link">Welcome: <?php echo $username; ?></a>
                </li>
                <li class="nav-item ml-3">
                    <a class="btn btn-success my-2 my-sm-0" href="logout.php">Log out</a>
                </li>
            </ul>
        <?php
        }
        ?>

    </div>
</nav>