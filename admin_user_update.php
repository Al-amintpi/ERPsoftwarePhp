<?php require_once 'header.php';
	 

if(isset($_COOKIE['rememberUser'])){
  	$ad_id = $_COOKIE['rememberUser'];
  }
  else{
  	$ad_id = $_SESSION['adminlogin'][0]['ad_id'];
 }
 

if(isset($_POST['edit_profileadmin'])){
	$username = $_POST['username'];
	$mobile = $_POST['mobile'];
	 
	$photo = $_FILES['profilephoto'];
	$photo_name = $_FILES['profilephoto']['name'];
	$tmp_name = $_FILES['profilephoto']['tmp_name'];
	$size = $_FILES['profilephoto']['size'];

	$extension = pathinfo($photo_name, PATHINFO_EXTENSION);

	$position = $_POST['position'];

	if(empty($username)){
		$error = "Username is required";
	}
	 
	else if(empty($photo_name)){
		$error = "Photo is required";
	}
	else if ($extension !='png' and $extension !='PNG' AND $extension !='JPG' AND $extension !='jpg' and $extension !='jpeg' and $extension !='jpeg' and $extension !='gif' and $extension !='GIF') {
		$error = "Please Right file type";
	}
    else{
    	$photo_name = uniqid().".".$extension;
		$upload = move_uploaded_file($tmp_name, 'adminprofilephotos/'.$photo_name);
		if($upload == true){
			$stm = $pdo->prepare("UPDATE adminregister_table SET username=?,profilephoto=?,position=? WHERE ad_id=?");
			$stm->execute(array($username,$photo_name,$position,$ad_id));
			$success = "Admin Update success";
		}
		
    } 
}     

 ?>
<style type="text/css">
	input[type="submit"] {
	-webkit-appearance: none;
	margin-bottom: 20px;
}
</style>
<div class="row">
	<div class="col-md-6 offset-md-3">
		<form method="POST" action="" enctype="multipart/form-data">
			<?php if(isset($error)): ?>
				<div class="alert alert-danger">
					<?php echo $error; ?>
				</div>
			<?php endif; ?>
			<?php if(isset($success)): ?>
				<div class="alert alert-success">
					<?php echo $success; ?>
				</div>
			<?php endif; ?>

		 	<div class="form-group row">
				<label class="col-sm-4 col-form-label"></label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" name="ad_id" id="ad_id" value="<?php echo ($ad_id); ?>">
				</div>
			</div>

		 	<div class="form-group row">
				<label class="col-sm-4 col-form-label">User Name*</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="username" id="username" value="<?php echo admin_details($ad_id,'username'); ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">Mobile*</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo admin_details($ad_id,'mobile'); ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">Email*</label>
				<div class="col-sm-8">
					<input type="email" class="form-control" name="email" id="email" value="<?php echo admin_details($ad_id,'email'); ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">Profile Photo*</label>
				<div class="col-sm-8">
				<input type="file" class="form-control" name="profilephoto" id="profilephoto">
				<label>Choose file</label>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">Position*</label>
				 <div class="col-sm-12 col-md-8">
					<select class="custom-select col-12" name="position" id="gender">
						<option selected=""><?php echo admin_details($ad_id,'position'); ?></option>
						<option value="admin">Admin</option>
						<option value="superadmin">Super Admin</option>
					</select>
				</div>	
			</div>
			<input type="submit" class="btn btn-success" name="edit_profileadmin" value="Update" id="edit_profileadmin_insert">
		</form>
	</div>
</div>

<?php require_once 'footer.php'; ?>				
