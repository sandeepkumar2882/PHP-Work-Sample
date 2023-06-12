<?php

    //include database file
    include('database.php');

    //create object for query class
    $obj = new query();

    //delete user
    if(isset($_GET['type']) && $_GET['type']=='delete'){
        $id=$obj->get_safe_str($_GET['id']);
        $conditionArr=array('id'=>$id);
        $obj->deleteData('crud_oops',$conditionArr);
        header('Location:http://food-order.test/crud-oops/index.php');
    }

?>
