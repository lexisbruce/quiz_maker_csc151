<h4>Quiz Title: <?php echo $quiz_title; ?></h4>

<table class = "quizlist">	
	<th class = "quizlist">Question</th>
	<th class = "quizlist">Correct Answer</th>
	<th colspan = 3 class = "quizlist">Action</th>
	
	<?php
		foreach($userQuizQuestion->result() as $question){
			echo '<tr>';
				echo '<td class = "quizlist">'.$question->question_given;
				echo '<td class = "quizlist">'.$question->cor_choice_letter;
				
					echo form_open('controller/deleteQuestion');
						echo form_hidden('username', $username);
						echo form_hidden('password', $password);
						echo form_hidden('title', $quiz_title);
						echo form_hidden('id', $id);
						echo form_hidden('question_number', $question->question_number);
				echo '<td class = "quizlist">'.form_submit('', 'Delete Question');
					echo form_close();
					
					echo form_open('controller/editQuestion');
					echo form_hidden('username', $username);
					echo form_hidden('password', $password);
					echo form_hidden('title', $quiz_title);
					echo form_hidden('id', $id);	
					echo form_hidden('question_given', $question->question_given);					
				echo '<td class = "quizlist">'.form_submit('', 'Edit Question');
					echo form_close();
					
					echo form_open('controller/viewChoices');
					echo form_hidden('username', $username);
					echo form_hidden('password', $password);
					echo form_hidden('id', $id);
					echo form_hidden('title', $quiz_title);
					echo form_hidden('question_number', $question->question_number);
					echo form_hidden('question_given', $question->question_given);
			echo '<td class = "quizlist">'.form_submit('', 'View Choices');
					echo form_close();
			echo '</tr>';
		}
	?>
	
</table>