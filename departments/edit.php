<?php
// APP
include '../App/config.php';
include '../App/functions.php';
// Shared
include '../shared/head.php';
include '../shared/nav.php';


if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $select = "SELECT * FROM `departments` where id =$id ";
    $s = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($s);
    if (isset($_POST['update'])) {
        $name = $_POST['name'];

        $update = "UPDATE  `departments` SET name= '$name' where id = $id";
        $i = mysqli_query($conn, $update);
        // testMessage($i, "Update");
        path('departments/list.php');

    }
} else {
    path('departments/list.php');
}

auth(2,3);
?>

<h1 class="text-center "> update Departments : <?= $_GET['edit'] ?> </h1>




<div class="container col-md-6">
    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="from-group">
                    <input type="text" value="<?= $row['name'] ?>" placeholder="Department Name" class="form-control" name="name">
                </div>
                <button name="update" class="btn btn-warning">
                    Update Data
                </button>
            </form>
        </div>
    </div>
</div>
<?php include '../shared/script.php'; ?>