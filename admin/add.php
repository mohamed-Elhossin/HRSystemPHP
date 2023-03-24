<?php
// APP
include '../App/config.php';
include '../App/functions.php';
// Shared
include '../shared/head.php';
include '../shared/nav.php';

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $password =  $_POST['password'];
    $hashPassword = sha1($password);
    $rule = $_POST['rule'];
    $insert = "INSERT INTO admins values (null , '$name','$hashPassword' , Default, $rule )";
    $i = mysqli_query($conn, $insert);
    path('admin/list.php');
}

$selectRules = "SELECT * FROM `rules`";
$rules = mysqli_query($conn, $selectRules);

auth();

?>

<h1 class="text-center "> Add Admins </h1>

<div class="container col-md-6">
    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="from-group">
                    <input type="text" placeholder=" Admin Name" class="form-control" name="name">
                </div>
                <div class="from-group">
                    <input type="password" placeholder=" Admin Password" class="form-control" name="password">
                </div>
                <div class="from-group">

                    <select name="rule" id="" class="form-control">
                        <?php foreach ($rules as $data) : ?>
                            <option value="<?= $data['id'] ?>"><?= $data['descriptoin'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button name="send" class="btn btn-info">
                    Send
                </button>
            </form>
        </div>
    </div>
</div>
<?php include '../shared/script.php'; ?>