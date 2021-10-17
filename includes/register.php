<?php
error_reporting(0);

// session login logic
if (!empty($_SESSION["id"])) {
    header("location: ?p=dashboard");
}

// input fields 
$name = input_field($_POST["name"]);
$email = input_field($_POST["email"]);
$username = input_field($_POST["username"]);
$password = input_field($_POST["password"]);
$age = $_POST["age"];
$gender = input_field($_POST["gender"]);
$city = input_field($_POST["city"]);

// image files variables
$img_tmp = $_FILES["image"]["tmp_name"];
$img_name = $_FILES["image"]["name"];

// validation
if (isset($_POST["sub"])) {

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

    // password validation 
    if (empty($password)) {
        $passwordErr = "Password is required.";
    } else if (!preg_match("/^[a-zA-Z0-9]{3,16}+$/", $password)) {
        $passwordErr = "Length of password should be between 4, 16 characters.";
    }

    // age validation 
    if (empty($age)) {
        $ageErr = "Please Enter your Age.";
    }

    // gender validation 
    if (empty($gender)) {
        $genderErr = "Please Select your Gender.";
    }

    // image validation 
    if (empty($img_name)) {
        $imageErr = "Please select png, jpg or jpeg file fdsjflkdsjfolsdjlkfgjlk;.";
    }

    // captcha validation 
    if (empty($city)) {
        $cityErr = "Please Enter City.";
    }

    $ext = pathinfo($img_name, PATHINFO_EXTENSION);
    $fn =  $img_name . rand() . "-" . time() . "." . $ext;

    // creating details.txt file for storing information and uploading img file in email folder
    if ($nameErr === "" && $emailErr === "" && $usernameErr === "" && $passwordErr === ""  && $ageErr === "" && $genderErr === "" && $cityErr === "") {
        if ($ext === "png" || $ext === "jpg" || $ext === "jpeg") {
            $email_query = mysqli_query($conn, "SELECT email FROM crud_assignment WHERE email = '$email';");
            $username_query = mysqli_query($conn, "SELECT username FROM crud_assignment WHERE username = '$username';");
            if (mysqli_num_rows($email_query) || mysqli_num_rows($username_query)) {
                if (mysqli_num_rows($email_query)) {
                    $emailErr = "This email address is already registered. Please use different email address.";
                }
                if (mysqli_num_rows($username_query)) {
                    $usernameErr = "This username is already taken. Please take different username.";
                }
            } else {
                if (move_uploaded_file($img_tmp, "uploads/$fn")) {
                    $insert_query = "INSERT INTO `crud_assignment` (`name`, `email`, `username`, `password`, `age`, `image`, `gender`, `city`) VALUES ('$name', '$email', '$username', '$password', '$age', '$fn', '$gender', '$city');";
                    mysqli_query($conn, $insert_query);
                    header("location: ?p=login");
                } else {
                    $imageErr = "Error in uploading image not uploaded.";
                }
            }
        } else {
            $imageErr = "Please select png, jpg or jpeg file.";
        }
    }
}

if (isset($_POST["already_exist"])) {
    header("Location: ?=login");
    exit();
}

?>
<div class="container py-5">

    <form class="form p-4 my-5 bg-white border rounded shadow" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="text-center">
                <img src="https://uilogos.co/img/logomark/earth.png" class="mb-2" alt="" width="50px" height="">
                <small class="font-weight-ligh font-italic d-block">Earth is what we all have in common.</small>
                <hr>
            </div>
            <h4 class="py-3 text-success">Register</h4>
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
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" value="<?php echo $password; ?>">
                <small id="err" class="form-text text-danger"><?php echo $passwordErr; ?></small>
            </div>
            <div class="form-group col-md-6 col-sm-12">
                <label for="age">Age</label>
                <input type="number" class="form-control" id="age" name="age" placeholder="Enter age" value="<?php echo $age; ?>">
                <small id="err" class="form-text text-danger"><?php echo $ageErr; ?></small>
            </div>
            <div class="form-group col-md-6 col-sm-12">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <small id="err" class="form-text text-danger"><?php echo $imageErr; ?></small>
            </div>
            <div class="form-group col-md-6 col-sm-12">
                <label for="gender">Gender</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender" value="Male">
                    <label class="form-check-label" for="gender">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender" value="Female">
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
                <button type="submit" class="btn btn-success btn-block" name="sub">Register</button>
            </div>
            <div class="col-sm mb-2">
                <button type="submit" class="btn btn-dark btn-block" name="already_exist">Already a user</button>
            </div>
        </div>
    </form>
    <?php echo $msg; ?>
</div>

<!-- Bootstrap js jquery -->
<?php include("includes/script.php"); ?>

<script>
    $(() => {
        window.setTimeout(() => {
            $("#alert").fadeOut(1000);
        }, 2000);
    });
</script>