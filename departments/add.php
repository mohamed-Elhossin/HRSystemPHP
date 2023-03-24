<?php
// APP
include '../App/config.php';
include '../App/functions.php';
// Shared
include '../shared/head.php';
include '../shared/nav.php';


if (isset($_POST['send'])) {
    $name = $_POST['name'];

    $insert = "INSERT INTO `departments` VALUES(NULL , '$name')";
    $i = mysqli_query($conn,$insert);
    testMessage($i , "Insert");
}

auth(2,3);
?>

<h1 class="text-center "> Add Departments </h1>




<div class="container col-md-6">
    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="from-group">
                    <input type="text" placeholder="Department Name" class="form-control" name="name">
                </div>
                <button name="send" class="btn btn-info">
                    Send Data
                </button>
            </form>
        </div>
    </div>
</div>
<?php include '../shared/script.php'; ?>