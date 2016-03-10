<form action="/MoneyLover/Users/UploadImage/<?php echo $id; ?>" method="post" enctype="multipart/form-data">
	<?php echo $this->Form->create('User');
	echo $this->Form->input('id'); ?>
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
