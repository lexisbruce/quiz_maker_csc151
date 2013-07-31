<table class = "quizlist">
	<th class = "quizlist">Title</th>
	<th class = "quizlist">Category</th>
	<th class = "quizlist">Action</th>
	
<?php
	echo form_open('controller/editQuizSuccess');
	echo form_hidden('username', $username);
	echo form_hidden('password', $password);
	
	foreach($userQuizzes->result() as $quizzes){
		echo form_hidden('old_title', $quizzes->title);
		$input_attr = array(
			'name' => 'new_title',
			'value' => $quizzes->title,
			'maxlength' => '20'
		);
		
		$dropdown_options = array(
			'---------------------' => '---------------------',
			'Mathematics' => 'Mathematics',
			'English' => 'English',
			'Computer' => 'Computer',
			'History' => 'History',
			'Science' => 'Science'
		);
		
		echo '<tr>';
			echo '<td class = "quizlist">'.form_input($input_attr);
			echo '<td class = "quizlist">'.form_dropdown('category', $dropdown_options, $quizzes->category_name);
			echo '<td class = "quizlist">'.form_submit('', 'Update');
		echo '</tr>';
	}
?>

</table>