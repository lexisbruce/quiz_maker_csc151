<!DOCTYPE html>


<html>
<head>
	<title>
		<?php
			$display = explode('_', $title);
			for($i = 0; $i < count($display); $i++)
				echo ucfirst($display[$i]).' ';	//capitalize first letters
			echo "\n";
		?>
	</title>
	<style>
		/* Background Picture */
		body{
			font-size: 100%;
			background-image: url(/csc151project/image/default.jpg);
			background-size: 100%;
			background-repeat: no-repeat fixed 100% 100$;
		}
		
		/*	Form Boxes	*/
		form.login{
			width: 260px;
			height: 110px;
			background: white;
			border-radius: 3px;
			box-shadow: 0 0 10px rgba(0,0,0, .4); 
			text-align: left;
			padding: 1px 10px 0px;
			margin: 150px 40px 100px 730px;
			font-size: 13px;
			font-family: Georgia, "Times New Roman", Serif;
		}
		
		form.signup{
			width: 260px;
			height: 260px;
			background: white;
			border-radius: 3px;
			box-shadow: 0 0 10px rgba(0,0,0, .4); 
			text-align: left;
			padding: 1px 10px
			font-size: 13px;
			font-family: Georgia, "Times New Roman", Serif;
			margin-top: 0px;
			margin-left: 200px;
		}
		
		/*	All form inputs except the password(the password in the login */
		form input{
			width: 240px;
			height: 25px;
			border: 1px solid #008B8B;
			border-radius: 2px;
			background: white;
			margin-top: 7px;
			margin-left: 5px;
		}
		
		form input:focus{
			box-shadow: 0 0 10px rgba(0,0,0, .4); 
		}
		
		
		/*	Password input(the password in the login */
		form input.password{
			width: 150px;
			height: 25px;
			border: 1px solid #008B8B;
			border-radius: 2px;
			background: white;
			margin-top: 10px;
		}
		
		form input.password:focus{
			box-shadow: 0 0 10px rgba(0,0,0, .4); 
		}
		
		/* Login login button on the quiz_app page*/
		form input.login{
			width: 85px;
			height: 30px;
			border-radius: 3px;
			background: #6495ED;
			color: white;
		}
		
		form input.login:hover{
			background: #7FFFD4;
		}
		
		/* Signup inputs on the sign_up page */
		form input.signup{
			width: 240px;
			height: 25px;
			border: 1px #F0FFFF
			border-radius: 10px;
			background: white;
			margin-top: 5px;
			margin-left: 10px;
			text-align: center;
			font-family: Georgia, Serif;
		}
		
		/* Fonts */
		font{
			font-size: 16px;
			color: #FFFACD
			font-weight: 700;
			text-align: justify;
		}
		
		font.signup{
			font-size: 16px;
			color: #708090;
			text-align: center;
			margin: 5px 100px;
		}
		
		p.welcome{
			color: #FFFFFF;
			font-size:20px;
			font-weight: 900;
			text-align: justify;
			margin: -210px 0px 0px 200px;
		}
		p.sub{
			font-size:20px;
			color: #FFFACD;
			font-weight: 700;
			text-align: justify;
			margin-top: 0px;
			margin-left: 200px;
		}
		
		p.congratulations{
			font-size: 18px;
			color: #FFFACD;
			font-weight: 500;
			text-align: justify;
			margin: 0px 200px;
		}
		
		/* Links */
		a:link{
			text-decoration: none;
			color: #006400;
			font-weight: 600;
		}
		a:visited{
			color: #006400;
			font-weight: 600;
		}
		a:hover{
			text-decoration: underline;
			color: #00FF00;
		}
		a:activate{
			color:#FF00FF;
		}
		
		.error{
			color: red;
		}
	</style>
<body>

<?php $this->form_validation->set_error_delimiters('<div class="error">', '</div>'); ?>