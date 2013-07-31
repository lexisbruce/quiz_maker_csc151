
<p class = "sub">
Please fill up the following information
</p>
<?php
	echo form_open('controller/createQuizSuccess');
	echo validation_errors();
	echo form_hidden('owner', $username);
	echo form_hidden('password', $password);
	
	$title_attr = array(
		'name' => 'title',
		'maxlength' => '20',
		'class' => 'create'
	);
	
	$categories = array(
		'---------------------' => '---------------------',
		'Mathematics' => 'Mathematics',
		'English' => 'English',
		'Computer' => 'Computer',
		'History' => 'History',
		'Science' => 'Science'
	);
	
	$createButtonAttr = array(
		'class' => 'submitButton'
	);
	
	echo 'Title: '.form_input($title_attr)."<br>\n";
	echo br(1);
	echo 'Category: '.form_dropdown('category', $categories)."<br>\n";
	
	echo '<p>';
	echo form_submit($createButtonAttr, 'Create');
	
	echo form_close();
?>

