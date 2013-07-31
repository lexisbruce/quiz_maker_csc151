<table class = "quizlist">	
	<th class = "quizlist">Title</th>
	<th class = "quizlist">Owner</th>
	<th class = "quizlist">Category</th>
	<th class = "quizlist">Action</th>
	
	<?php
		foreach($all_quiz->result() as $result){
			echo form_open('controller/answerQuiz');
		
			echo form_hidden('username', $username);
			echo form_hidden('password', $password);
			echo form_hidden('title', $result->title);

			echo '<tr>';
				echo '<td class = "quizlist">'.$result->title;
				echo '<td class = "quizlist">'.$result->owner_username;
				echo '<td class = "quizlist">'.$result->category_name;
				//hidden forms
				echo form_hidden('id', $result->quiz_id);
				echo '<td class = "quizlist">'.form_submit('', 'Answer');
			echo '</tr>';
			
			echo form_close();
		}
	?>
</table>