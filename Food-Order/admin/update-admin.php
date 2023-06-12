<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <?php
        if (isset($_SESSION['update'])) //Checking Whether the Session is set or not
        {
            echo $_SESSION['update']; //Display Session Message
            unset($_SESSION['update']); //Remove Session Message
        }

        //Get the id of admin to be deleted
        $id = $_GET['id'];

        //Query to get all admins
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        // Execute the query
        $result = $connection->query($sql);

        //Check the query
        if ($result == true) {
            $count = mysqli_num_rows($result);

            //Check the number of rows
            if ($count == 1) {
                //We have data in db
                while ($rows = mysqli_fetch_assoc($result)) {
                    //Using while loop to get all the data from db
                    //while loop will run as long as we have data in db

                    //Get indivisual data
                    $fullName = $rows['full_name'];
                    $userName = $rows['user_name'];
                }
            }
        } else {
            //Redirected to manage admin page
            header('Location:' . SITEURL . '/admin/manage-admin.php');
        }
        ?>

        <div class="container login-screen">
            <div class="form-container row p-5">
                <div class="details-wrapper col-md-6 pe-md-5">
                    <div class="login">
                        <h2 class="text-light">Add Admin</h2>
                    </div>
                    <div class="eula">
                        <p>To add another admin, Just fill the form and click on Update Details button</p>
                    </div>
                </div>
                <div class="form-wrapper col-md-6">
                    <form action="" method="POST" class="form form-group">
                        <label for="full_name">Full Name</label>
                        <input input type="text" name="full_name" value="<?php echo $fullName; ?>">
                        <label for="email">Username | Email</label>
                        <input type="text" name="user_name" value="<?php echo $userName; ?>">
                        <!-- <input type="submit" name="submit" class="btn btn-primary submit-btn" id="submit" value="Login"> -->
                        <button type="submit" name="submit" class="btn btn-primary submit-btn custom-btn" id="submit"><span>Click!</span><span>Update Details</span></button>
                        <div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php

//When you don't handle the errors you will get 500 internal server errors and you will not know what's wrong. Always handle errors.

//Check the submit button is clicked or not
if (isset($_POST['submit'])) {

    //Get data from Form to update
    echo $id;
    echo $fullName = $_POST['full_name'];
    echo $userName = $_POST['user_name'];

    //SQL Query to insert data in tbl_admin table
    $sql = "UPDATE tbl_admin SET full_name='$fullName', user_name='$userName' WHERE id=$id";

    // Execute the query
    $result = $connection->query($sql);

    //Check the query
    if ($result == true) {
        $_SESSION['update'] = '<div class="success">' . $fullName . ' Admin Updated Successfully </div>';
        header('Location:' . SITEURL . '/admin/manage-admin.php');
    } else {
        $_SESSION['update'] = '<div class="error">' . $fullName . ' Update Failed, Try Again! </div>';
        header('Location:' . SITEURL . '/admin/update-admin.php');
    }
}
?>