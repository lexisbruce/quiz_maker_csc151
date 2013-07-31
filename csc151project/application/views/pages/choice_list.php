<h4>
Quiz Title: <?php echo $quiz_title; ?><br>
Question: <?php echo $question_given; ?> <br>
</h4>

<table class = "quizlist">	
	<th class = "quizlist">Option</th>
	<th class = "quizlist">Letter</th>
	
	<?php
		echo form_open('controller/editChoice');
		echo form_hidden('username', $username);
		echo form_hidden('password', $password);
		echo form_hidden('question_number', $question_number);
		echo form_hidden('title', $quiz_title);
		echo form_hidden('question_given', $question_given);
		foreach($questionChoices->result() as $choice){
			echo '<tr>';
				echo '<td class = "quizlist">'.$choice->option_given;
				echo '<td class = "quizlist">'.$choice->letter;
					
					echo form_hidden('option_given', $choice->option_given);
					echo form_hidden('letter', $choice->letter);
			echo '</tr>';
		}
		echo form_submit('', 'Edit');
		echo form_close();
	?>
</table>