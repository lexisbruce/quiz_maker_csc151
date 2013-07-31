<h4>Quiz Title: <?php echo $quiz_title; ?></h4>
<br>

<form action="<?php echo site_url().'/controller/addChoice' ?>" method="post">
<?php
	foreach($quizQuestion->result() as $question){
		echo '<h4>Question: '.$question->question_given.'</h4>';
		echo form_hidden('question_number', $question->question_number);
		echo form_hidden('question_id', $question->quiz_id);
	}
?>

<input type="hidden" name="username" value="<?php echo $username ?>">
<input type="hidden" name="password" value="<?php echo $password ?>">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="question" value="<?php echo $question_given ?>">
<!-- ============================== Fieldset 1 end ============================== -->
		<!-- ============================== Fieldset 2 ============================== -->
		<fieldset>
			<legend>CHOICES</legend>
				<label for="choice_one" class="float"><strong>Choice a:</strong></label><br />
				<input class="inp-text" name="choice_a" class="choiceoption" type="text" size="30" /><br />
				
				<label for="choice_two" class="float"><strong>Choice b:</strong></label><br />
				<input class="inp-text" name="choice_b" class="choiceoption" type="text" size="30" /><br />
				
				<label for="choice_three" class="float"><strong>Choice c:</strong></label><br />
				<input class="inp-text" name="choice_c" class="choiceoption" type="text" size="30" /><br />
				
				<label for="choice_four" class="float"><strong>Choice d:</strong></label><br />
				<input class="inp-text" name="choice_d" class="choiceoption" type="text" size="30" /><br />

		</fieldset>
		<!-- ============================== Fieldset  2 end ============================== -->
		<!-- ============================== Fieldset  3 ============================== -->
		<fieldset>
			<legend>LETTER OF CORRECT ANSWER</legend>
				<label for="correct_answer" class="float"><strong>Answer</strong></label><br />
				<select name = "choice_answer">
					<option value = "-">-</option>
					<option value = "a">a</option>
					<option value = "b">b</option>
					<option value = "c">c</option>
					<option value = "d">d</option>
				</select>
				<br />
		</fieldset>
		<!-- ============================== Fieldset  3 end ============================== -->
<input type="submit" value="Add"></input>
</form>