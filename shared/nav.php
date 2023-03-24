<?php
session_start();

if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header("location:/hr/admin/login.php");
}

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php  if(isset($_SESSION['admin'])): ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/hr/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/hr/admin/profile.php">Profile</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Departments
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/hr/departments/add.php">Add</a></li>
                        <li><a class="dropdown-item" href="/hr/departments/list.php">List </a></li>
                        <li><a class="dropdown-item" href="/hr/departments/depwitoutemp.php">Empty department </a></li>

                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Employees
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/hr/employees/add.php">Add</a></li>
                        <li><a class="dropdown-item" href="/hr/employees/list.php">List </a></li>
                    </ul>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Admins
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/hr/admin/add.php">Add</a></li>
                        <li><a class="dropdown-item" href="/hr/admin/list.php">List </a></li>

                    </ul>
                </li>

                <?php endif; ?>
            </ul>
            <div class="d-flex" role="search">
            <?php  if(isset($_SESSION['admin'])): ?>

                <form action="">
                    <button class="btn btn-warning" name="logout" type="submit">logOut</button>
                </form>
                <?php else :?>
                <a href="/hr/admin/login.php" class="btn btn-success" type="submit">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>