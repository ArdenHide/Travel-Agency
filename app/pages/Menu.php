<nav id="navbar" class="mb-1 navbar navbar-expand-lg navbar-light mdb-color d-flex align-items-center p-0">
    <a href="index.php?page=home" class="navbar-brand h-100 p-0 mx-2">
        <p class="navbar-brand__text flex-center">AH</p>
    </a>
    <button class="navbar-toggler order-2" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <i class="hamburger fas fa-bars warning-ic" style="font-size: 2rem;"></i>
    </button>
    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class=" <?php echo ($page == 1) ? 'nav-item font-italic warning-color py-2' : "nav-item py-2" ?> ">
                <a class="nav-link text-white px-4" href="index.php?page=1">Туры</a>
            </li>
            <?php
            if (isset($_SESSION['radmin'])) {
                if ($page == 2)
                    $class = 'nav-item font-italic warning-color py-2';
                else
                    $class = 'nav-item py-2';
                echo '<li class="' . $class . '"><a class="nav-link text-white px-4" href="index.php?page=2">Админ панель</a></li>';

                if ($page == 3)
                    $class = 'nav-item font-italic warning-color py-2';
                else
                    $class = 'nav-item py-2';
                echo '<li class="' . $class . '"><a class="nav-link text-white px-4" href="index.php?page=3">Администраторы</a></li>';
            }
            ?>
        </ul>
        <?php include_once("pages/login.php"); ?>
    </div>
</nav>