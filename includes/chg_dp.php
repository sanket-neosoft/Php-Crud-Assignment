<?php

if (isset($_POST["chgDp"])) {
    $img_tmp = $_FILES["image"]["tmp_name"];
    $img_name = $_FILES["image"]["name"];
    $ext = pathinfo($img_name, PATHINFO_EXTENSION);
    $fn =  $img_name . rand() . "-" . time() . "." . $ext;

    if (!empty($img_name)) {
        if ($ext === "png" || $ext === "jpg" || $ext === "jpeg") {
            if (move_uploaded_file($img_tmp, "uploads/$fn")) {
                mysqli_query($conn, "UPDATE `crud_assignment` SET `image` = '$fn' WHERE `crud_assignment`.`id` = '$user_id';");
                header("location: ?p=dashboard");
                exit();
            } else {
                $imageErr = "Not able to upload image.";
            }
        } else {
            $imageErr = "Please select png, jpg or jpeg file.";
        }
    } else {
        $imageErr = "Please select png, jpg or jpeg file.";
    }
}
?>
<div class="container px-5" style="padding-top: 10%;">
    <form class="form p-4 bg-white border rounded shadow" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="text-center">
                <h4 class="py-3 text-success">Change Profile Picture</h4>
                <hr>
            </div>
            <div class="form-group">
                <label for="name">Select Image</label>
                <input type="file" class="form-control" name="image">
                <small id="err" class="form-text text-danger"><?php echo $imageErr; ?></small>
            </div>
            <div class="row">
                <div class="col-md">
                </div>
                <div class="col-md">
                    <button type="submit" class="btn btn-success btn-block" name="chgDp">Confirm</button>
                </div>
            </div>
        </div>
    </form>
    <?php echo $successMsg; ?>
</div>