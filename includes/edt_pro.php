<?php

if (isset($_POST["sub"])) {

    $name = input_field($_POST["name"]);
    $username = input_field($_POST["username"]);
    $email = input_field($_POST["email"]);
    $age = input_field($_POST["age"]);
    $gender = input_field($_POST["gender"]);
    $city = input_field($_POST["city"]);


    // name validation 
    if (empty($name)) {
        $nameErr = "Name is required.";
    } else if (!preg_match("/^[a-zA-Z ]{2,32}+$/", $name)) {
        $nameErr = "Only Characters and white spaces are allowed and length should be between 3 to 32 characters.";
    }

    // email validation 
    if (empty($email)) {
        $emailErr = "Email Address is required.";
    } else if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)) {
        $emailErr = "Invalid Email Address.";
    }

    // username validation 
    if (empty($username)) {
        $usernameErr = "Username is required.";
    } else if (!preg_match("/^[a-z0-9_]{2,32}$/", $username)) {
        $usernameErr = "Only Small Characters, Numbers and \"_\" are allowed. and lenght should be between 3 to 32 characters";
    }


    // age validation 
    if (empty($age)) {
        $ageErr = "Please Enter your Age.";
    }

    // gender validation 
    if (empty($gender)) {
        $genderErr = "Please Select your Gender.";
    }


    // captcha validation 
    if (empty($city)) {
        $cityErr = "Please Enter City.";
    }

    if ($nameErr === "" && $emailErr === "" && $usernameErr === "" && $ageErr === "" && $genderErr === "" && $cityErr === "") {
        $edit_query = "UPDATE `crud_assignment` SET `name` = '$name', `username` = '$username', `email` = '$email', `age` = '$age', `gender` = '$gender', `city` = '$city' WHERE `crud_assignment`.`id` = $user_id;";

        if (mysqli_query($conn, $edit_query)) {
            header("location: ?p=dashboard");
            exit();
        }
    }
}

?>
<div class="container px-5" style="padding-top: 10%;">
    <form class="form p-4 bg-white border rounded shadow" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="text-center">
                <h4 class="py-3 text-success">Edit Profile</h4>
                <hr>
            </div>
            <div class="form-group col-md-6 col-sm-12">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo $name; ?>">
                <small id="err" class="form-text text-danger"><?php echo $nameErr; ?></small>
            </div>
            <div class="form-group col-md-6 col-sm-12">
                <label for="email">Email address</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $email; ?>">
                <small id="err" class="form-text text-danger"><?php echo $emailErr; ?></small>
            </div>
            <div class="form-group col-md-6 col-sm-12">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?php echo $username; ?>">
                <small id="err" class="form-text text-danger"><?php echo $usernameErr; ?></small>
            </div>
            <div class="form-group col-md-6 col-sm-12">
                <label for="age">Age</label>
                <input type="number" class="form-control" id="age" name="age" placeholder="Enter age" value="<?php echo $age; ?>">
                <small id="err" class="form-text text-danger"><?php echo $ageErr; ?></small>
            </div>
            <div class="form-group col-md-6 col-sm-12">
                <label for="gender">Gender</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender" value="Male" <?php if ($gender === "Male") {
                                                                                                            echo "checked";
                                                                                                        } ?>>
                    <label class="form-check-label" for="gender">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender" value="Female" <?php if ($gender === "Female") {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                    <label class="form-check-label" for="gender">
                        Female
                    </label>
                </div>
                <small id="err" class="form-text text-danger"><?php echo $genderErr; ?></small>
            </div>
            <div class="form-group col-md-6 col-sm-12">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Enter your city" value="<?php echo $city; ?>">
                <small id="err" class="form-text text-danger"><?php echo $cityErr; ?></small>
            </div>
        </div>
        <div class="row">
            <div class="col-sm mb-2">
            </div>
            <div class="col-sm mb-2">
                <button type="submit" class="btn btn-success btn-block" name="sub">Confirm</button>
            </div>
        </div>
    </form>
</div>