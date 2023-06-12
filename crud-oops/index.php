<?php

//include database file
include('database.php');

//create object for query class
$obj = new query();

//Where condition array
$conditionArr = array('name'=>'Sandeep Kumar');

//Like condition array
$likeArr = array('name'=>'s', 'email'=>'s');

//call function to fetch all users data
$users = $obj->fetchData('*', 'crud_oops',$conditionArr, $likeArr);

?>

<div class="text-center">
    <a href="manage-users.php?id=<?php echo $user['id'] ?>">Add User</a>
</div>

<table id="tblUser">
    <thead>
        <th>Fullname</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php if (!empty($users)) { ?>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['mobile']; ?></td>
                    <td><a href="manage-users.php?id=<?php echo $user['id'] ?>"><i class="fa fa-fw fa-edit"></i></a> | <a href="#" onclick="deleteUser('<?php echo $user['id'] ?>' , '<?php echo $user['name'] ?>')" ><i class="fa fa-fw fa-trash"></i></a></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>

<!-- Script for apply data-table -->
<script>
    jQuery(document).ready(function($) {
        $('#tblUser').DataTable();
    });
</script>

<!-- add js file for delete confirmation -->
<script type="text/javascript" src="./js/confirm-delete.js" defer></script>







<?php
//For testing purpose

// // echo "hello";
// include('database.php');
// $obj = new query();

// //Fetch Data
// $fetchFieldArr = array();
// $getData = $obj->fetchData('name,email','crud_oops','','');
// print_r($getData);

// // //Insert Data
// // $insertFieldsArr = array('name'=>'Nick Nripendra', 'email'=>'nick.nripendra@gmail.com','mobile'=>'1221122112');
// // $enterData = $obj->insertData('crud_oops',$insertFieldsArr);

// // //Delete Data
// // $deleteFieldsArr = array('name'=>'Nick Nripendra', 'mobile'=>'1221122112');
// // $enterData = $obj->deleteData('crud_oops',$deleteFieldsArr);

// //Update Data
// $updateFieldsArr = array('name'=>'Nick Nripendra', 'email'=>'nick.nripendra@gmail.com', 'mobile'=>'1221122112');
// $changedData = $obj->updateData('crud_oops',$updateFieldsArr,'id',2);

?>
