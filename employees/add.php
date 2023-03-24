<?php
// APP
include '../App/config.php';
include '../App/functions.php';
// Shared
include '../shared/head.php';
include '../shared/nav.php';

/**
 * Filter Validation
 * Boolean Result
 */

// List All Departments
$select = "SELECT * FROM `departments` ";
$Departments = mysqli_query($conn, $select);



$errors = [];
if (isset($_POST['send'])) {
    $name = filterValidation($_POST['name']);
    $salary = filterValidation($_POST['salary']);
    $departmentID = filterValidation($_POST['departmentID']);


    // Image Code

    $image_size = $_FILES['image']['size'];
    $image_type = $_FILES['image']['type'];

    $image_name = rand(0, 1000) . rand(0, 1000) . $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $location = "upload/" . $image_name;

    if (fileSizeValidation($_FILES['image']['name'], $_FILES['image']['size'], 3)) {
        $errors[] = "Your File bigger Than 3 miga";
    }
    if (fileTypeValidation($image_type, "image/jpeg", "image/png", "image/jpg")) {
        $errors[] = "Your File Out Side Types";
    }

    if (stringValidation($name, 2)) {
        $errors[] = "Please Enter Employee Name and length > 3 ";
    }
    if (numberValidation($salary)) {
        $errors[] = "Please Enter Valida Salary";
    }



    if (empty($errors)) {
        move_uploaded_file($tmp_name, $location);
        $insert = "INSERT INTO `employees` VALUES(NULL , '$name' ,$salary,'$image_name',$departmentID , Default)";
        $i = mysqli_query($conn, $insert);
        testMessage($i, "Insert");
    }
}


auth(2);
?>

<h1 class="text-center "> Add Employees </h1>




<div class="container col-md-6">
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?> </li>
                    <hr>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="from-group">
                    <input type="text" placeholder="Employee Name" class="form-control" name="name">
                </div>


                <div class="row" id="cost">
                    <div class="col-md-3">
                        <div class="from-group">
                            <input type="text" placeholder="Gross Salary" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="from-group">
                            <input type="text" placeholder="Tax Salary" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="from-group">
                            <input type="text" placeholder="Bouns Salary" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="from-group">
                            <input type="text" readonly placeholder="Net Salary" class="form-control" name="salary">
                        </div>
                    </div>
                </div>


                <div class="from-group">
                    <input type="file" class="form-control" name="image">
                </div>


                <div class="from-group">
                    <label for=""> Departments</label>
                    <select type="text" class="form-control" name="departmentID">
                        <?php foreach ($Departments as $data) : ?>
                            <option value="<?= $data['id'] ?>"> <?= $data['name'] ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button name="send" class="btn btn-info">
                    Send Data
                </button>
            </form>
        </div>
    </div>
</div>
<?php include '../shared/script.php'; ?>