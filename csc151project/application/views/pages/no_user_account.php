	<?php 
		echo form_open('controller/login', array('class' => 'login'))."\n";	//redirects you to the user's profile
		$username_attr = array(
			'name' => 'username',
			'maxlength' => '20',
			'placeholder' => 'Username',
			'class' => 'username'
		);
	
		$login_attr = array(
			'name' => 'signin',
			'value' => 'Sign in',
			'class' => 'login'
		);
	
		$password_attr = array(
			'name' => 'password',
			'maxlength' => '10',
			'class' => 'password',
			'placeholder' => 'Password'
		);
		
		echo form_input($username_attr)."\n";
		echo form_password($password_attr)."\n";
		echo form_submit($login_attr)."\n";
		echo '<p>New User?'.anchor('controller/index/sign_up', ' Sign Up')."</p>\n";
		echo form_close()."\n";
	?>
	
	<p class = "welcome">
		Sorry, no user matched
		</p>
		
		<p class = "sub">
		Please log in again, and check your inputs. Thank You!
	</p>