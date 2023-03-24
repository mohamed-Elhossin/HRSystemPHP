<?php
// APP
include '../App/config.php';
include '../App/functions.php';
// Shared
include '../shared/head.php';
include '../shared/nav.php';
$errorLogin = null;
if (isset($_POST['login'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $hashPassword = sha1($password);
    $select = "SELECT * FROM admins where name ='$name' and password = '$hashPassword'";
    $s  =  mysqli_query($conn, $select);
    $NumRows = mysqli_num_rows($s);
    $row = mysqli_fetch_assoc($s);
    if ($NumRows == 1) {
        $_SESSION['admin'] = [
            "name" => $name,
            "rule" => $row['rule'],
            "id" => $row['id'],
        ];
        path('index.php');
    } else {
        $errorLogin = "Wrong Password OR UeserName";
    }
}



?>

<h1 class="text-center "> Login page </h1>

<div class="container col-md-6">
    <?php if ($errorLogin != null) :  ?>
        <div class="alert alert-danger">
            <?= $errorLogin ?>
        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="from-group">
                    <input type="text" placeholder=" Admin Name" class="form-control" name="name">
                </div>
                <div class="from-group">
                    <input type="password" placeholder=" Admin Password" class="form-control" name="password">
                </div>
                <button name="login" class="btn btn-info">
                    Login
                </button>
            </form>
        </div>
    </div>
</div>
<?php include '../shared/script.php'; ?>