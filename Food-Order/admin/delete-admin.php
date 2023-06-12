<?php 

    //Include constants file
    include('../config/constants.php');

    //Get the id of admin to be deleted
    $id = $_GET['id'];

    //First Get data with id for Display deleted user's Full Name inside the message
    $fullName = '';
    $getData = "SELECT full_name FROM tbl_admin WHERE id=$id";
    $rowData = $connection->query($getData);
    if($rowData == true){
        $row = $rowData->fetch_array();
        $fullName = $row['full_name'];
    }else{
        echo "full name is not loaded";
    }
    

    //Create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the Query
    $result = $connection->query($sql);

    //Check whether the query executed or not
    if($result == true){
        //Query executed successfully and admin deleted
        $_SESSION['delete'] = '<div class="success">'.$fullName.' Deleted Successfully </div>';
        header('Location:' . SITEURL . '/admin/manage-admin.php');
    }
    else{
        $_SESSION['delete'] = '<div class="error">'.$fullName.' Not Deleted, Try Again! </div>';
        header('Location:' . SITEURL . '/admin/manage-admin.php');
    }


    //Redirect to the manage admin page with message(Success or Failed)

?>