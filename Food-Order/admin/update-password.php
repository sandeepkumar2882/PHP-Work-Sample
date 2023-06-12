<?php include('./partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1><br>

        <?php //Get the id
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>

        <div class="container login-screen">
            <div class="form-container row p-5">
                <div class="details-wrapper col-md-6 pe-md-5">
                    <div class="login">
                        <h2 class="text-light">Update Password</h2>
                    </div>
                    <div class="eula">
                        <p>To update admin's password, Just fill the form and click on Update Password button</p>
                    </div>
                </div>
                <div class="form-wrapper col-md-6">
                    <?php //session message
                    if (isset($_SESSION['user-not-found'])) //Checking Whether the Session is set or not
                    {
                        echo $_SESSION['user-not-found']; //Display Session Message
                        unset($_SESSION['user-not-found']); //Remove Session Message
                    } ?>
                    <form action="" method="POST" class="form form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" name="current_password">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <button type="submit" name="submit" class="btn btn-primary submit-btn custom-btn" id="submit"><span>Click!</span><span>Update Password</span></button>
                        <div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

//Check whether submit button is clicked or not
if (isset($_POST['submit'])) {
    
    //Get data from form
    $id = $_POST['id'];
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $ConfirmPassword = $_POST['confirm_password'];

    //Check whether the user with current ID and current password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id";

    //Execute the query
    $result = $connection->query($sql);

    if ($result == true) {
        //Check whether data is available or not
        $count = $result->num_rows;

        if ($count == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($currentPassword, $row['password'])) {

                //Check whether the new password and confirm password match or not
                if ($newPassword == $ConfirmPassword) {
                    //query for password update
                    $sql = "UPDATE tbl_admin SET password='$ConfirmPassword' WHERE id=$id";

                    //execute the query
                    $result = $connection->query($sql);

                    //Check query
                    if ($result == true) {
                        //change password if all above is true
                        $_SESSION['update'] = '<div class="success">' . $row['full_name'] . ' Password Updated Successfully </div>';
                        header('Location:' . SITEURL . '/admin/manage-admin.php');
                    } else {
                        $_SESSION['user-not-found'] = '<div class="error">Password Update Failed, Try Again! </div>';
                        header('Location:' . SITEURL . '/admin/update-password.php?id=' . $id);
                    }
                } else {
                    $_SESSION['user-not-found'] = '<div class="error">Password Not Matched! </div>';
                    header('Location:' . SITEURL . '/admin/update-password.php?id=' . $id);
                }
            } else {
                $_SESSION['user-not-found'] = "<div class='error'> Wrong Current Password, Try Again! </div>";
                header('Location:' . SITEURL . '/admin/update-password.php?id=' . $id);
            }
        } else {
            $_SESSION['user-not-found'] = "<div class='error'> User Not Found </div>";
            header('Location:' . SITEURL . '/admin/manage-admin.php');
        }
    }
}

?>

<?php include('./partials/footer.php'); ?>