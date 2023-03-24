<?php
// APP
include '../App/config.php';
include '../App/functions.php';
// Shared
include '../shared/head.php';
include '../shared/nav.php';

$adminID = $_SESSION['admin']['id'];

$select = "SELECT * FROM `adminalldata` where id =$adminID";
$s = mysqli_query($conn, $select);

$row = mysqli_fetch_assoc($s);


if (isset($_POST['sendImgae'])) {
    // Image Code
    if (empty($_FILES['image']['name'])) {
        $image = $row['image'];
        $image_name = $image;
    } else {
        $image_name = rand(0, 1000) . rand(0, 1000) . $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $location = "upload/" . $image_name;
        move_uploaded_file($tmp_name, $location);
        $oldImage = $row['image'];
        if ($oldImage != "fake.jpg") {
            unlink("./upload/$oldImage");
        }
    }

    $update = "UPDATE admins SET image ='$image_name' where id =$adminID ";
    $u = mysqli_query($conn, $update);
    path("admin/profile.php");
}

auth(2, 3);
?>

<h1 class="text-center ">Your Profile : <?= $row['name'] ?> </h1>

<div class="container col-md-3">
    <div class="card">
        <img src="./upload/<?= $row['image'] ?>" class="img-top" alt="">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Upload New Image
        </button>
        <div class="card-body">
            <h4> Name : <?= $row['name']  ?> </h4>
            <hr>
            <h4> Rule : <?= $row['descriptoin']  ?> </h4>
        </div>
        <a href="/hr/admin/editProfile.php" class="btn btn-warning"> Edit Your Data </a>
    </div>
</div>
<?php include '../shared/script.php'; ?>





<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="from-group">
                        <input type="file" class="form-control" name="image">
                    </div>
                    <button name="sendImgae" class="btn btn-danger"> Upload </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>