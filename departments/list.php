<?php
// APP
include '../App/config.php';
include '../App/functions.php';
// Shared
include '../shared/head.php';
include '../shared/nav.php';


$select = "SELECT * FROM `departments` ";
$s = mysqli_query($conn, $select);



// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = "DELETE FROM  `departments` where id = $id";
    $d = mysqli_query($conn, $delete);
    path('departments/list.php');
}
auth(2,3);
?>

<h1 class="text-center "> List Departments </h1>




<div class="container col-md-6">
    <div class="card">
        <div class="card-body">
            <table class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th colspan="2">Action</th>
                </tr>
                <?php foreach ($s as $data) : ?>
                    <tr>
                        <th> <?= $data['id'] ?> </th>
                        <th> <?= $data['name'] ?> </th>
                  
                        <th>
                            <a class="btn btn-danger" href="/hr/departments/list.php?delete=<?= $data['id'] ?>">Remove </a>
                        </th>
                        <th>
                            <a class="btn btn-warning" href="/hr/departments/edit.php?edit=<?= $data['id'] ?>">Edit </a>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?php include '../shared/script.php'; ?>