<?php
	echo 'Confirm Delete?';
	
	echo form_open('controller/deleteSuccess');
	echo form_hidden('title', $quiz_title);
	echo form_hidden('username', $username);
	echo form_hidden('password', $password);
	echo form_submit('', 'Continue');
	echo form_close();
	
	echo form_open('controller/viewUserQuizzes');
	echo form_hidden('title', $quiz_title);
	echo form_hidden('username', $username);
	echo form_hidden('password', $password);
	echo form_submit('', 'Cancel');
	echo form_close();
	
?>
