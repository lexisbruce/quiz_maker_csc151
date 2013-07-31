<table class = "quizlist">
	<th class = "quizlist">Title</th>
	<th class = "quizlist">Category</th>
	<th class = "quizlist" colspan = 5>Actions</th>
<?php
	foreach($userQuizzes->result() as $quizzes){
		echo '<tr>';
			echo '<td class = "quizlist">'.$quizzes->title;;
			echo '<td class = "quizlist">'.$quizzes->category_name;
				
				//actions to the quiz
				
				echo form_open('controller/editQuiz');
				echo form_hidden('username', $username);
				echo form_hidden('password', $password);
				echo form_hidden('title', $quizzes->title);
			echo '<td class = "quizlist">'.form_submit('', 'Edit Quiz');
				echo form_close();

				echo form_open('controller/deleteQuiz');
				echo form_hidden('username', $username);
				echo form_hidden('password', $password);
				echo form_hidden('title', $quizzes->title);
			echo '<td class = "quizlist">'.form_submit('', 'Delete Quiz');
				echo form_close();
				
				echo form_open('controller/addQuestion');
				echo form_hidden('username', $username);
				echo form_hidden('password', $password);
				echo form_hidden('id', $quizzes->quiz_id);
				echo form_hidden('title', $quizzes->title);
			echo '<td class = "quizlist">'.form_submit('', 'Add Question');
				echo form_close();
				
				echo form_open('controller/accessQuestion');
				echo form_hidden('username', $username);
				echo form_hidden('password', $password);
				echo form_hidden('id', $quizzes->quiz_id);
				echo form_hidden('title', $quizzes->title);
			echo '<td class = "quizlist">'.form_submit('', 'View/Edit/Delete Question');
				echo form_close();
				
			
		echo '</tr>';
	}
?>

</table>