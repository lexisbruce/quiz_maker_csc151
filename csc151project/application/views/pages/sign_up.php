<?php echo validation_errors(); ?>

	<p class = "sub">
		Please sign up for free<br>
		And enjoy creating and answering available quizzes<br>
		anywhere and anytime you want.
	</p>
<?php
		$input_attr = array(
			'maxlength' => '20',
			'class' => 'signup'
		);
	
		$login_attr = array(
			'name' => 'signin',
			'value' => 'Sign up!',
			'class' => 'login'
		);
		
	echo form_open('controller/createUser', array('class' => 'signup'))."\n";
	echo '<font class = "signup">Sign Up</font>';
	echo '<hr>';
	
	$input_attr['name'] = 'username';
	$input_attr['placeholder'] = 'Username';
	echo form_input($input_attr)."\n";
	
	$input_attr['name'] = 'password';
	$input_attr['placeholder'] = 'Password';
	echo form_password($input_attr);"\n";
	
	$input_attr['name'] = 'confirm_password';
	$input_attr['placeholder'] = 'Password Confirmation';
	echo form_password($input_attr);"\n";
	
	$input_attr['name'] = 'email_add';
	$input_attr['placeholder'] = 'Email Address';
	echo form_input($input_attr);"\n";
	
	echo "<center>\n";
	echo form_submit($login_attr)."\n";
	echo "</center>\n";
	echo '<p>Have an account already?'.anchor('controller/index', ' Log in')."</p>\n";
	echo form_close();
?>