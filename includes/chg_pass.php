<?php
if (isset($_POST["chgPass"])) {
    $currPass = input_field($_POST["currPass"]);
    $newPass = input_field($_POST["newPass"]);
    $cfmPass = input_field($_POST["cfmPass"]);

    if (empty($currPass)) {
        $currPassErr = "Please Enter current password.";
    }


    if (empty($newPass)) {
        $newPassErr = "Please Enter new password";
    } else if (!preg_match("/^[a-zA-Z0-9]{3,16}+$/", $newPass)) {
        $newPassErr = "Length of password should be between 4, 16 characters.";
    }

    if (empty($cfmPass)) {
        $cfmPass = "Please Enter password again";
    } else if (!preg_match("/^[a-zA-Z0-9]{3,16}+$/", $cfmPass)) {
        $cfmPassErr = "Length of password should be between 4, 16 characters.";
    } else if ($cfmPass !== $newPass) {
        $cfmPassErr = "Password doesn't Match.";
    }

    if ($currPassErr === "" && $newPassErr === "" && $cfmPassErr === "") {
        $password_query = "SELECT `password` FROM `crud_assignment` WHERE `id` = '$user_id';";
        $result = mysqli_query($conn, $password_query);
        $database_password = mysqli_fetch_assoc($result)["password"];
        if ($database_password === $currPass) {
            $password_update_query = "UPDATE `crud_assignment` SET `password` = '$cfmPass' WHERE `crud_assignment`.`id` = $user_id;";
            mysqli_query($conn, $password_update_query);
            $successMsg = "<div id='alert' class= 'alert alert-success w-50 text-center position-absolute end-0 start-50'><strong>** Password Updated Successfully. **</strong></div>";

        } else {
            $currPassErr = "Please Enter correct Password.";
        }
    }
}
?>
<div class="container px-5" style="padding-top: 10%;">
    <form class="form p-4 bg-white border rounded shadow" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="text-center">
                <h4 class="py-3 text-success">Change Password</h4>
                <hr>
            </div>
            <div class="form-group">
                <label for="name">Enter Current Password</label>
                <input type="password" class="form-control" id="currPass" name="currPass" placeholder="Enter Password" value="<?php echo $currPass; ?>">
                <small id="err" class="form-text text-danger"><?php echo $currPassErr; ?></small>
            </div>
            <div class="form-group">
                <label for="name">Enter New Password</label>
                <input type="password" class="form-control" id="newPass" name="newPass" placeholder="Enter Password" value="<?php echo $newPass; ?>">
                <small id="err" class="form-text text-danger"><?php echo $newPassErr; ?></small>
            </div>
            <div class="form-group">
                <label for="name">Confirm Password</label>
                <input type="password" class="form-control" id="cfmPass" name="cfmPass" placeholder="Enter Password" value="<?php echo $cfmPass; ?>">
                <small id="err" class="form-text text-danger"><?php echo $cfmPassErr; ?></small>
            </div>
            <div class="row">
                <div class="col-md">
                </div>
                <div class="col-md">
                    <button type="submit" class="btn btn-success btn-block" name="chgPass">Confirm</button>
                </div>
            </div>
        </div>
    </form>
    <?php echo $successMsg; ?>
</div>