
<h4>Quiz Title: <?php echo $quiz_title; ?></h4>
<table class = "quizlist">	
	<th  class = "quizlist">Question</th>
	<th  class = "quizlist">Correct Answer</th>
	<th  class = "quizlist" colspan = 3>Action</th>
	
	<?php
		
		echo form_open('controller/editQuestionSuccess');
		foreach($userQuizQuestion->result() as $question){
			echo '<tr>';
			echo form_hidden('username', $username);
			echo form_hidden('password', $password);
			echo form_hidden('title', $quiz_title);
			echo form_hidden('id', $id);
			echo form_hidden('question_number', $question->question_number);
			
			$textarea_attr = array(
				'name' => 'new_question',
				'value' => $question->question_given,
			);
			
			$dropdown_options = array(
				'-' => '-',
				'a' => 'a',
				'b' => 'b',
				'c' => 'c',
				'd' => 'd'
			);
			
			echo '<td  class = "quizlist">'.form_textarea($textarea_attr).'<br>';
			echo '<td  class = "quizlist">'.form_dropdown('new_cor_choice', $dropdown_options, $question->cor_choice_letter).'<br>';
			echo '<td  class = "quizlist">'.form_submit('', 'Update');
			
			echo '</tr>';
		}
		echo form_close();
	?>
</table>