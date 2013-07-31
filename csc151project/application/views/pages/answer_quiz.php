
<?php
	echo form_open('controller/checkQuiz');
	
	echo '<h4>'.$quiz_title.'</h4>';
	
	echo form_hidden('username', $username);
	echo form_hidden('password', $password);
	echo form_hidden('id', $id);
	
	$answer_attr = array(
		'-' => '-',
		'a' => 'a',
		'b' => 'b',
		'c' => 'c',
		'd' => 'd'
	);
	
	echo '<ol type = 1>';
	foreach($questionToAnswer->result() as $question){	
		echo '<li>'.$question->question_given.'</li>';
		
		//query..
		$result = $this->quiz_app->getChoice($question->question_number);
		foreach($result->result() as $choice){
			echo $choice->letter.' '.$choice->option_given.'<br>';
		}
		
		echo form_hidden('question_number[]', $question->question_number);
		echo form_dropdown('answer[]', $answer_attr);
		
		echo '<br>';
	}

	echo form_submit('', 'Submit');
	echo form_close();
?>