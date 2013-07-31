<?php
	echo 'Confirm Delete?';
	
	echo form_open('controller/deleteQuizSuccess');
	echo form_hidden('title', $quiz_title);
	echo form_hidden('username', $username);
	echo form_hidden('password', $password);
	echo form_hidden('id', $id);
	echo form_hidden('question_number', $question_number);
	echo form_submit('', 'Continue');
	echo form_close();
	
	echo form_open('controller/accessQuestion');
	echo form_hidden('title', $quiz_title);
	echo form_hidden('username', $username);
	echo form_hidden('password', $password);
	echo form_hidden('id', $id);
	echo form_submit('', 'Cancel');
	echo form_close();
	
?>