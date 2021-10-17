<?php
error_reporting(0);

// session login logic
if (!empty($_SESSION["id"])) {
    header("location: ?p=dashboard");
}

// input fields 
$username = input_field($_POST["username"]);
$password = input_field($_POST["password"]);

if (isset($_POST["reg"])) {
    header("location: ?p=register");
    exit();
}

// validation
if (isset($_POST["sub"])) {

    // username validation 
    if (empty($username)) {
        $usernameErr = "Please Enter Username.";
    } 

    // password validation 
    if (empty($password)) {
        $passwordErr = "Please Enter Password.";
    }

    // login logic 
    if ($usernameErr === "" && $passwordErr == "") {
        $check_query = "SELECT * FROM crud_assignment WHERE `email` = '$username' OR `username` = '$username' AND `password` = '$password';";
        $result = mysqli_query($conn, $check_query);
        if (mysqli_num_rows($result)) {
            if (!empty($_POST["remember"])) {
                setcookie("username", $username, time() + (3600 * 24));
                setcookie("password", $password, time() + (3600 * 24));
            }
            $_SESSION["id"] = mysqli_fetch_assoc($result)["id"];
            header("location: ?p=dashboard");
            exit();
        } else {
            $errMsg = "<div id='alert' class= 'alert alert-danger alert-dismissible fade show w-50 text-center position-absolute top-50 start-50'><strong>** Invalid Credentials. **<strong></div>";
        }
    }
}

?>
<div class="container content">
    <div class="row">
        <div class="col-md m-auto login-logo">
            <div class="container text-center">
                <img src="https://uilogos.co/img/logotype/earth.png" class="wel-logo logo img-fluid" alt="">
                <blockquote class="blockquote bq">
                    <p>"Earth is what we all have in common."</p>
                    <footer class="blockquote-footer">Wendell Berry</footer>
                </blockquote>
            </div>
        </div>
        <div class="col-md">
            <form class="form-si p-4 bg-white border rounded shadow" method="POST">
                <div class="text-center">
                    <img src="https://uilogos.co/img/logomark/earth.png" class="mb-4" alt="" width="60px" height="">
                </div>
                <div class="form-group">
                    <label for="username">Username / Email address</label>
                    <input type="text" class="form-control" id="username" name="username" onchange="cook();" placeholder="Enter username or email" value="<?php echo $username; ?>">
                    <small id="err" class="form-text text-danger"><?php echo $usernameErr; ?></small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" value="<?php echo $password; ?>">
                    <small id="err" class="form-text text-danger"><?php echo $passwordErr; ?></small>
                </div>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" id="check" name="remember" value="checked"> Remember me
                    </label>
                </div>
                <div class="row">
                    <div class="col-sm mb-2">
                        <button type="submit" class="btn btn-success btn-block" name="sub">Login</button>
                    </div>
                    <div class="col-sm mb-2">
                        <button type="submit" class="btn btn-dark btn-block" name="reg">New User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php echo $errMsg; ?>
</div>

<script>
    const cook = () => {
        if (document.getElementById("username").value === "<?php echo $_COOKIE["username"]; ?>") {
            document.getElementById("password").value = "<?php echo $_COOKIE["password"]; ?>";
        } else {
            document.getElementById("password").value = "";
        }
    }
</script>