<h4>User Answered Quizzes</h4>

<table class = "quizlist">
	<th class = "quizlist">Title</th>
	<th class = "quizlist">Owner</th>
	<th class = "quizlist">Score</th>
	<th class = "quizlist">Percentage</th>
	
	<?php
	foreach($user_quiz_statistics->result() as $result){
		echo '<tr>';	
			echo '<td class = "quizlist">'.$result->title;
			echo '<td class = "quizlist">'.$result->owner_username;
			echo '<td class = "quizlist">'.$result->score;
			echo '<td class = "quizlist">'.$result->percentage.'%';
		echo '</tr>';
	}
	?>
</table>