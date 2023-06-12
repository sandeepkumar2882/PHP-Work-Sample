<?php
include('database.php');
$obj=new query();

$name='';
$email='';
$mobile='';
$id='';

if(isset($_GET['id']) && $_GET['id']!=''){
	$id=$obj->get_safe_str($_GET['id']);
	$conditionArr=array('id'=>$id);
	$result=$obj->fetchData('*','crud_oops',$conditionArr);
	$name=$result['0']['name'];
	$email=$result['0']['email'];
	$mobile=$result['0']['mobile'];
}

if(isset($_POST['submit'])){
	$name=$obj->get_safe_str($_POST['name']);
	$email=$obj->get_safe_str($_POST['email']);
	$mobile=$obj->get_safe_str($_POST['mobile']);
	
	$conditionArr=array('name'=>$name,'email'=>$email,'mobile'=>$mobile);
	
	if($id==''){
		$obj->insertData('crud_oops',$conditionArr);
	}else{
		$obj->updateData('crud_oops',$conditionArr,'id',$id);
	}
	
	//header('location:users.php');
	?>
	<script>
	window.location.href='fetch.php';
	</script>
	<?php
}
?>
<!doctype html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Manage User - PHP Object Oriented Programming CRUD</title>
	  <style>
		.container{margin-top:100px;}
	  </style>
   </head>
   <body>
      
      <div class="container">
         <div class="card">
            <div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Add User</strong> <a href="index.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-globe"></i> Browse Users</a></div>
            <div class="card-body">
               <div class="col-sm-6">
                  <h5 class="card-title">Fields with <span class="text-danger">*</span> are mandatory!</h5>
                  <form method="post">
                     <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" required value="<?php echo $name?>">
                     </div>
                     <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required value="<?php echo $email?>">
                     </div>
                     <div class="form-group">
                        <label>Mobile <span class="text-danger">*</span></label>
                        <input type="tel" class="tel form-control" name="mobile" id="mobile"  placeholder="Enter mobile" required value="<?php echo $mobile?>">
                     </div>
                     <div class="form-group">
                        <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Manage User</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>