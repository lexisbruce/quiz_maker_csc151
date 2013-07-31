
	
	<h4>Quiz Title: <?php echo $quiz_title; ?></h4>
	
	<br>
	<form action="<?php echo site_url().'/controller/addQuestionSuccessful' ?>" method="post">
	
	<input type="hidden" name="username" value="<?php echo $username ?>">
	<input type="hidden" name="password" value="<?php echo $password ?>">
	<input type="hidden" name="id" value="<?php echo $id ?>">
	<input type="hidden" name="title" value="<?php echo $quiz_title ?>">
	
	<!-- ============================== Fieldset 1 ============================== -->
		<fieldset>
			<legend>QUESTION</legend>
			<textarea name="question" class="question" cols="100" rows="5" title="question"></textarea><br />
			
		</fieldset>
		

	<input type="submit" value="Add"></input>
	</form>