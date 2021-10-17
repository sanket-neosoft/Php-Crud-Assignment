<?php
$date = date_create($changed);
$date_format = date_format($date, "d-M at H:i");
?>
<div class="container padding-10">
    <h3 class="text-muted mb-3">User Details:</h3>
    <div class="mb-3 shadow">
        <div class="row no-gutters p-3">
            <div class="col-md-5 px-4 my-auto">
                <img src="<?php echo "uploads/$image"; ?>" class="img-thumbnail" alt="...">
            </div>
            <div class="col-md-7 px-4">
                <div class="lead">
                    <h5 class="card-title text-success"><?php echo $username; ?></h5>
                    <table>
                        <tr>
                            <td>Name: </td>
                            <td><?php echo $name; ?></td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td><?php echo $email; ?></td>
                        </tr>
                        <tr>
                            <td>Age: </td>
                            <td><?php echo $age; ?></td>
                        </tr>
                        <tr>
                            <td>Gender:&nbsp;&nbsp;</td>
                            <td><?php echo $gender; ?></td>
                        </tr>
                        <tr>
                            <td>City: </td>
                            <td><?php echo $city; ?></td>
                        </tr>
                    </table>
                    <p><small class="text-muted">changed_at: <?php echo $date_format; ?></small></p>
                    <div class="row">
                        <div class="col">
                            <a href="?p=chg_dp" class="btn btn-success btn-block">Change picture</a>
                        </div>
                        <div class="col">
                        <a href="?p=edt_pro" class="btn btn-success btn-block">Edit profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>