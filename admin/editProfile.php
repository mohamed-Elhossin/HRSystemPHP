<?php
// APP
include '../App/config.php';
include '../App/functions.php';
// Shared
include '../shared/head.php';
include '../shared/nav.php';

$adminID = $_SESSION['admin']['id'];

$select = "SELECT * FROM `admins` where id =$adminID";
$s = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($s);

if (isset($_POST['update'])) {
    $name = $_POST['name'];

    $hashPassword = sha1($password);
    $update = "UPDATE  `admins` SET name= '$name'  where id = $adminID";
    $i = mysqli_query($conn, $update);

    path('admin/profile.php');
}

auth(2, 3);


?>

<h1 class="text-center "> update admin : <?= $adminID ?> </h1>




<div class="container col-md-6">
    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="from-group">
                    <input type="text" value="<?= $row['name'] ?>" placeholder="admin Name" class="form-control" name="name">
                </div>
          
                <button name="update" class="btn btn-warning">
                    Update Data
                </button>
            </form>
        </div>
    </div>
</div>
<?php include '../shared/script.php'; ?>