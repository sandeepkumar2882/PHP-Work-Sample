<?php include('partials/menu.php'); ?>
<link rel="stylesheet" href="../css/form.css">

<div class="page">
    <div class="container">
        <div class="left">
            <div class="login">Food Category</div>
            <div class="eula">Kindly add category with the help of this form...</div>
        </div>
        <div class="right">
                <!-- <svg viewBox="0 0 320 300">
                <defs>
                    <linearGradient inkscape:collect="always" id="linearGradient" x1="13" y1="193.49992" x2="307" y2="193.49992" gradientUnits="userSpaceOnUse">
                        <stop style="stop-color:#ff00ff;" offset="0" id="stop876" />
                        <stop style="stop-color:#ff0000;" offset="1" id="stop878" />
                    </linearGradient>
                </defs>
                <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
            </svg> -->
            <?php
            if (isset($_SESSION['insert'])) //Checking Whether the Session is set or not
            {
                echo $_SESSION['insert']; //Display Session Message
                unset($_SESSION['insert']); //Remove Session Message
            }
            ?>
            <form action="" method="POST" class="form">
                <label for="title">Title</label>
                <input type="text" name="title" id="title">
                <label for="featured">Featured</label>
                <input type="radio" class="radio-button" name="featured" id="featured" value="Yes">Yes
                <input type="radio" class="radio-button" name="featured" id="featured" value="No">No
                <label for="active">Active</label>
                <input type="radio" class="radio-button" name="active" id="active" value="Yes">Yes
                <input type="radio" class="radio-button" name="active" id="active" value="No">No
                <input type="submit" name="submit" id="submit" value="Add Category">
            </form>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php

//When you don't handle the errors you will get 500 internal server errors and you will not know what's wrong. Always handle errors.

//Check the submit button is clicked or not
if (isset($_POST['submit'])) {

    //Get data from Form
    $fullName = $_POST['full_name'];
    $userName = $_POST['user_name'];
    $password = PASSWORD_HASH($_POST['password'], PASSWORD_DEFAULT); //Password Encryption with MD5

    //SQL Query to insert data in tbl_admin table
    $sql = "INSERT INTO tbl_admin (full_name,user_name,password) values ( '$fullName','$userName','$password')";

    // Execute the query
    $result = $connection->query($sql);

    //Check the query
    if ($result == true) {
        $_SESSION['insert'] = '<div class="success">' . $fullName . ' Added as Admin Successfully </div>';
        header('Location:' . SITEURL . '/admin/manage-admin.php');
    } else {
        $_SESSION['insert'] = '<div class="error">' . $fullName . ' Failed to Add, Try Again! </div>';
        header('Location:' . SITEURL . '/admin/add-admin.php');
    }
}
?>