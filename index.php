<?php
error_reporting(0);
include("includes/connection.php");
session_start();
$user_id = $_SESSION["id"];
$user_query = "SELECT * FROM crud_assignment WHERE id = '$user_id';";
$user = mysqli_query($conn, $user_query);
$user_details = mysqli_fetch_assoc($user);

// error variables 
$nameErr = $emailErr = $usernameErr = $passwordErr = $imageErr = $ageErr = $genderErr = $cityErr = $newPassErr = $currPassErr = $cfmPassErr = "";

$username = $user_details["username"];
$email = $user_details["email"];
$name = $user_details["name"];
$image = $user_details["image"];
$age = $user_details["age"];
$gender = $user_details["gender"];
$city = $user_details["city"];
$changed = $user_details["change_at"];

// trim function 
function input_field($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!doctype html>
<html lang="en">

<!-- head -->
<?php include("includes/components/head.php"); ?>

<body class="body">
    <?php
    if (empty($user_id)) {
        include("includes/components/navbar.php");
    ?>
        <div class="page_section my-5">
            <div class="page">
                <?php
                switch ($_GET["p"]) {
                    case "dashboard":
                        include("includes/dashboard.php");
                        break;
                    case "login":
                        include("includes/login.php");
                        break;
                    case "register":
                        include("includes/register.php");
                        break;
                    default:
                        include("includes/login.php");
                }
                ?>
            </div>
        </div>
    <?php
    } else {
    ?>
        <section class="">
            <section class="vertical-nav bg-dark text-light shadow p-0" id="sidebar">
                <div class="text-center py-5 mt-4" id="sidebar">
                    <img src="<?php echo "uploads/$image"; ?>" width="125px" height="125px" class=" my-3 rounded-circle img-thumbnail shadow-sm" alt="">
                    <p class="text-success lead font-weight-bold text-lowercase"><?php echo $username; ?></p>
                    <div class="my-4">
                        <table class="mx-auto text-left" cellpadding="10">
                            <tr>
                                <td><i class="bi bi-person-circle"></i></td>
                                <td><a class="text-white" href="?p=edt_pro">Edit Profile</a></td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-key-fill"></i></td>
                                <td><a class="text-white" href="?p=chg_pass">Change Password</a></td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-image-fill"></i></td>
                                <td><a class="text-white" href="?p=chg_dp">Change Picture</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </section>
            <section class="page_content" id="content">
                <!-- navbar -->
                <?php include("includes/components/navbar.php"); ?>
                <div class="page_section">
                    <div class="page">
                        <?php
                        switch ($_GET["p"]) {
                            case "dashboard":
                                include("includes/dashboard.php");
                                break;
                            case "login":
                                include("includes/login.php");
                                break;
                            case "chg_pass":
                                include("includes/chg_pass.php");
                                break;
                            case "chg_dp":
                                include("includes/chg_dp.php");
                                break;
                            case "edt_pro":
                                include("includes/edt_pro.php");
                                break;
                            default:
                                include("includes/dashboard.php");
                        }
                        ?>
                    </div>
                </div>
            </section>
        <?php
    }
        ?>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(() => {

                $(() => {
                    window.setTimeout(() => {
                        $("#alert").fadeOut(1000);
                    }, 2000);
                });

                $("#sidebarCollapse").on("click", () => {
                    $("#sidebar, #content").toggleClass("active");
                });

                $("#agreeBtn").on('click', function() {
                    $("#agree").prop("checked", true);
                });

                $("#status").change(function() {
                    $("#hidden-status").val($("#status").val());
                });

            });
        </script>

</body>

</html>