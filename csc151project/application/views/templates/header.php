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
	/*	Start of CSS statements	*/
	
		/*	body properties */
		body{
			 font-size: 100%;
			 background-image: url(/csc151project/image/download.jpg);
			 background-size: 100%;
			 background-repeat: no-repeat fixed 100% 100%;
			 font-family: Sans-Serif, Verdana;
		}
		
		/* some texts in the page */
		p.sub{
			font-family: Sans-Serif, Verdana;
			color: #32CD32;
			font-weight: 900;
		}
	
		/* a properties */
		a:link{
			font-family: Serif, Georgia;
			color:blue;
			text-decoration: none;
		}
		a:visited{
			font-family: Serif, Georgia;
			color:blue;
			text-decoration: none;
		}
		a:hover{
			font-family: Serif, Georgia;
			color:blue;	
		}
		a:active{
			font-family: Serif, Georgia;
			color:blue;
			text-decoration: none;		
		}
		
		/* table containing links to your home and logout */
		table td.templates{
			background: #F5FFFA;
			width: 130px;
			height: 40px;
			text-align: center;
			vertical-align: center;
			border-radius: 3px;
			box-shadow: 0 0 10px rgba(0,0,0, .4); 
			font-weight: 700;
		}
		td.templates:hover{
			background: #F8F8FF;
			border-radius: 3px;
			box-shadow: 0 0 10px rgba(0,0,0, .4); 
			font-weight: 400;
		}
		
		/* table containing the actions you can do ans is located at the left side */
		table.sidepannel{
			text-align: left;
			vertical-align: center; 
			font-weight: 500;
			padding-left: 6px;
			font-size: 14px;
		}
		
		td.sidepannelnoaction{
			background: #F5FFFA;
			border-radius: 3px;
			box-shadow: 0 0 10px rgba(0,0,0, .4); 
			font-size: 16x;
			font-weight: bold;
			text-align: center;
			vertical-align: center;
		}
		
		td.sidepannel:hover{
			background: #F8F8FF;
			border-radius: 3px;
			box-shadow: 0 0 10px rgba(0,0,0, .4); 
		}
		
		/* table containing the list of user created quizzes */ 
		table.quizlist{
			border: 1px solid black;
			border-collapse: collapse;
			font-family: Serif, Georgia;
			border-radius: 3px;
		}
		
		th.quizlist{
			background: green;
			color: white;
			border: 1px solid black;
			padding: 25px 50px;
			font-size: 20px;
			font-weight: bold;
			font-variant: small-caps;
		}
		
		td.quizlist{
			background: white;
			color: black;
			border: 1px solid black;
			text-align: center;
			vertical-align: center;
			padding: 5px 10px;
			font-size: 16px;
			font-weight: 400;
		}
		
		
		/* division on your table containing username and logout */
		div.templates{
			margin: 20px 0px 0px 900px;
		}
		
		/* division on your table that is located in the left side */
		div.sidepannel{
			margin: 50px 0px 0px 100px;
		}
		
		div.main{
			margin: -70px 0px 0px 380px;
			length: 100%;
			width: 500px;
		}
		
		/* submit buttons properties */
		
		/* this is the button where your username was placed */
		.submit{
			font-family: Serif, Georgia;
			background: #F5FFFA;
			color: blue;
			width: 130px;
			height: 40px;
			text-align: center;
			vertical-align: center;
			border: none;
			border-radius: 3px;
			font-weight: 700;
			font-size: 16px;
		}
		
		.submit:hover{
			background: #F8F8FF;
			border-radius: 3px;
			box-shadow: 0 0 10px rgba(0,0,0, .4); 
			font-weight: 400;
		}
		
		/* this are the buttons where your actions/options are placed */
		.submitsidepannel{
			font-family: Serif, Georgia;
			background:  #F5FFFA;
			height: 20px;
			width: 150px;
			border: none;
			border-radius: 3px;
			text-align: center;
			vertical-align: center;
			box-shadow: 0 0 10px rgba(0,0,0, .4); 
			font-weight: 500;
			padding-left: 6px;
			font-size: 14px;
			color: blue;
		}
		
		.submitsidepannel:hover{
			background: #F8F8FF;
			border-radius: 3px;
			box-shadow: 0 0 10px rgba(0,0,0, .4); 
			font-style: italic;
		}
		
		/* form input and submit for create quiz */
		form input.create{
			font-family: Serif, Georgia;
			font-size: 13px;
			border: 1px solid #708090;
			length: 40px;
			width: 350px;
			border-radius: 2px;
			margin-top: 10px;
		}
		
		form input.create:focus{
			border: 1px solid #FFE4E1;
			border-radius: 2px;
			box-shadow: 0 0 10px rgba(0,0,0, .4); 
		}
		
		/* Create Button in create_quiz */
		form input.submitButton{
			background: #F5FFFA;
			border: none;
			height: 20px;
			width: 70px;
			border-radius: 3px;
			box-shadow: 0 0 10px rgba(0,0,0, .4); 
			color: blue;
			margin: 0px 1100px 0px 0px;
			color: white;
			background: blue;
		}
		
		form input.submitButton:hover{
			border-radius: 3px;
			box-shadow: 0 0 10px rgba(0,0,0, .4); 
			font-style: italic;
		}

		hr{
			width: 81%;
			margin: 87px 70px 0px 95px;
		}

		
	/* End of CSS statements	*/
	</style>
</head>
<body>


<hr>
<div class = "templates">
	<table class = "templates">
		<?php			
			echo form_open("controller/login");
		
			foreach($userData->result() as $data){
				//hidden input attributes
				$username = $data->username;
				$password = $data->password;
				$email_add = $data->email_add;
			}
				
			$submit_attributes = array(
				'name' => '',
				'value' => $data->username,
				'class' => 'submit'
			);
		
			echo form_hidden('username', $username)."\n";	//take username
			echo form_hidden('password', $password)."\n";	//take password
			echo '<td class = "templates">'.form_submit($submit_attributes)."</td>\n";
			echo '<td class = "templates">'.anchor('controller/index', 'Log Out')."</td>\n";
		
			echo form_close();
			
		?>
	</table>
</div>



<div class = "sidepannel">
	<table class = "sidepannel">
		<?php 
			
			
			$submit_attr = array(
				'name' => '',
				'class' => 'submitsidepannel'
			);
			
			$displayQuiz_attr = array(
				'name' => '',
				'class' => 'submitsidepannel',
			);
			
			
			
			echo '<tr>';
				echo '<td class = "sidepannelnoaction">';			
				echo $username."'s Quizzes";
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
			echo form_open('controller/createQuiz'); 
				echo form_hidden('username', $username);	//take username
				echo form_hidden('password', $password); //take password
				echo form_hidden('email_add', $email_add);
				$submit_attr['value'] = 'Create Quiz';
					echo '<td>';
					echo form_submit($submit_attr);
					echo form_close();
					echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo form_open('controller/viewUserQuizzes'); 
				echo form_hidden('username', $username);	//take username
				echo form_hidden('password', $password); //take password
				$submit_attr['value'] = 'Display Quiz';
					echo '<td>';
					echo form_submit($submit_attr);
					echo form_close();
					echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td class = "sidepannelnoaction">';			
				echo "Around the App";
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo form_open('controller/searchQuizzes'); 
				echo form_hidden('username', $username);	//take username
				echo form_hidden('password', $password); //take password
				$submit_attr['value'] = 'Search Quiz';
					echo '<td>';
					echo form_submit($submit_attr);
					echo form_close();
					echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo form_open('controller/viewAllQuizzes'); 
				echo form_hidden('username', $username);	//take username
				echo form_hidden('password', $password); //take password
				$submit_attr['value'] = 'View Quizzes';
					echo '<td>';
					echo form_submit($submit_attr);
					echo form_close();
					echo '</td>';
			echo '</tr>';
		?>
	</table>
</div>

<div class = "main">	<!marks the start of the texts in the center pannel(main) of the browser>