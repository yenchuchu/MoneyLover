<?php
$role = AuthComponent::user('role');
$active = AuthComponent::user('active');
if ($active == 1) {
    if ($role == 1) {
            echo $this->element('menu_admin');
        } else {
            echo $this->element('menu_user');
        } 
 
} else {  ?>
    <span></span>   
 <?php  }?>

<!-- About Section -->
<section id="upload-avatar" class=" content-section text-center">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3" id="change-password-col-6">  
            <h1> Upload avatar </h1> 
			<form action="/MoneyLover/Users/UploadImage/<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <?php  	echo $this->Form->create('User');
				echo $this->Form->input('id'); ?>
           	 	<span id="note-upload-avatar">Only JPG, JPEG, PNG, GIF files are allowed!</span> <br>
           	 	<p>Select image to upload: </p>
			    <input type="file" name="fileToUpload" id="fileToUpload" >
                            <input type="hidden" name="backUrl" value="<?php echo $backUrl; ?>"/>
			    <input type="submit" value="Upload Image" name="submit" id="save-upload-avatar">
			</form>
        </div> 
        <!-- /.col-lg-6 -->
    </div> 
    <!-- /.row -->
</section>