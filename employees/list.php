<?php
// APP
include '../App/config.php';
include '../App/functions.php';
// Shared
include '../shared/head.php';
include '../shared/nav.php';


$select = "SELECT * FROM `employeeswithdepartments`";
$s = mysqli_query($conn, $select);



// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $selectOne = "SELECT * FROM employees where id = $id  order by id asc ";
    $sOne = mysqli_query($conn, $selectOne);
    $row = mysqli_fetch_assoc($sOne);
    $image_name = $row['image'];
    unlink("./upload/$image_name");

    $delete = "DELETE FROM  `employees` where id = $id";
    $d = mysqli_query($conn, $delete);

    path('employees/list.php');
}


auth(2);
?>

<h1 class="text-center "> List employees </h1>




<div class="container col-md-6">
    <div class="card">
        <div class="card-body">
            <table class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Salary</th>
                    <th>Department ID</th>
                    <th>image</th>
                    <th colspan="2">Action</th>
                </tr>
                <?php foreach ($s as $data) : ?>
                    <tr>
                        <th> <?= $data['id'] ?> </th>
                        <th> <?= $data['empName'] ?> </th>
                        <th> <?= $data['salary'] ?> </th>
                        <th> <?= $data['depName'] ?> </th>
                        <th><img width="50" src="./upload/<?= $data['image'] ?>" alt=""> </th>
                        <th>
                            <a class="btn btn-danger" href="/hr/employees/list.php?delete=<?= $data['id'] ?>">Remove </a>
                        </th>
                        <th>
                            <a class="btn btn-warning" href="/hr/employees/edit.php?edit=<?= $data['id'] ?>">Edit </a>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?php include '../shared/script.php'; ?>