<?php
// APP
include '../App/config.php';
include '../App/functions.php';
// Shared
include '../shared/head.php';
include '../shared/nav.php';



// List All Departments
$select = "SELECT * FROM `departments`";
$Departments = mysqli_query($conn, $select);


if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $select = "SELECT * FROM `employeeswithdepartments` where id =$id";
    $s = mysqli_query($conn, $select);

    $row = mysqli_fetch_assoc($s);
    if (isset($_POST['send'])) {
        $name = $_POST['name'];
        $salary = $_POST['salary'];
        $departmentID = $_POST['departmentID'];


        if (empty($_FILES['image']['name'])) {
            $image_name = $row['image'];
        } else {
            $oldImage = $row['image'];
            unlink("./upload/$oldImage");
            // Image Code
            $image_name = rand(0, 1000) . rand(0, 1000) . $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $location = "upload/" . $image_name;
            move_uploaded_file($tmp_name, $location);
        }



        $insert = "UPDATE `employees` SET name  = '$name' , salary = $salary,image= '$image_name',  departmentID = $departmentID where id= $id";
        $i = mysqli_query($conn, $insert);
        // testMessage($i, "Updated");
        path('/employees/list.php');
    }
}



auth(2);
?>

<h1 class="text-center "> Edit Employees </h1>




<div class="container col-md-6">
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="from-group">
                    <input type="text" required placeholder="Employee Name" value="<?= $row['empName'] ?>" class="form-control" name="name">
                </div>

           
                <div class="row" id="cost">
                    <div class="col-md-3">
                        <div class="from-group">
                            <input type="text" required placeholder="Gross Salary" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="from-group">
                            <input type="text" required placeholder="Tax Salary" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="from-group">
                            <input type="text" required placeholder="Bouns Salary" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="from-group">
                            <input type="text" value="<?= $row['salary'] ?>" readonly placeholder="Net Salary" class="form-control" name="salary">
                        </div>
                    </div>
                </div>

                <div class="from-group">
                    <span> Edit Image : <img width="50" src="./upload/<?= $row['image'] ?>" alt=""></span>
                    <input type="file" class="form-control" name="image">
                </div>

                <div class="from-group">
                    <label for=""> Departments</label>
                    <select type="text" class="form-control" name="departmentID">
                        <option value="<?= $row['depI'] ?>" selected> <?= $row['depName'] ?> </option>
                        <?php foreach ($Departments as $data) : ?>
                            <option value="<?= $data['id'] ?>"> <?= $data['name'] ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button name="send" class="btn btn-info">
                    Update Data
                </button>
            </form>
        </div>
    </div>
</div>
<?php include '../shared/script.php'; ?>