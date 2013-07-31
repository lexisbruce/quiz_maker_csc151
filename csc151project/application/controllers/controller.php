<?php

class Controller extends CI_Controller	{	
	
	//constructor
	public function __construct(){
		parent::__construct();
		$this->load->model('quiz_app_model', 'quiz_app');	//load model
		$this->load->helper(array('form', 'html', 'url'));	//load helpers
		$this->load->library(array('form_validation'));	//load libraries
	}
	
	/*
	 * Default function being called upon
	 */ 
	public function index($page = 'quiz_app'){
		$data['title'] = $page;
		$this->load->view('templates/home_header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);
	}
	
	/*
	 * You are remapped here when you first log in to your account
	 */
	public function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		//query...
		$result = $this->quiz_app->login($username, $password);	
		
		if($result->num_rows() > 0){
			$page = 'home_profile';		
			$data['title'] = $page;
			$data['userData'] = $result;
			$data['user_quiz_statistics'] = $this->quiz_app->getUserAnsweredQuizzes($username);
			$this->load->view('templates/header', $data);
			$this->load->view('pages/'.$page);
			$this->load->view('templates/footer', $data);
		}				
		else{
			$page = 'no_user_account';			
			$data['title'] = $page;
			$this->load->view('templates/home_header', $data);
			$this->load->view('pages/'.$page);
			$this->load->view('templates/footer', $data);
		}
		
	}
	
	/*
	 * Interface for creating a new user
	 */
	public function createUser(){
		//restrictions
		$config = array(
		    array(
				 'field'   => 'username', 
				 'label'   => 'Username', 
				 'rules'   => 'required'
			),
		    array(
				 'field'   => 'password', 
				 'label'   => 'Password', 
				 'rules'   => 'required'
			),
			array(
				'field' => 'confirm_password',
				'label' => 'Password Confirmation',
				'rules' => 'required|matches[password]'
			),
			array(
				'field' => 'email_add',
				'label' => 'Email Address',
				'rules' => 'required|valid_email'
			)
		);
		
		$this->form_validation->set_rules($config);
		//end of restrictions
	
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$e_add = $this->input->post('email_add');
		
		if($this->form_validation->run() == FALSE)
			$page = 'sign_up';
		else{
			//query...
			$this->quiz_app->createUser($username, $e_add, $password);
			$page = 'sign_up_successful';	
		}
		$data['title'] = $page;
		$this->load->view('templates/home_header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);
	}
	
	/*
	 * Interface for making a new quiz
	 * Redirects you to create_quiz page
	 */
	public function createQuiz(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$email_add = $this->input->post('email_add');
		$page = 'create_quiz';
		
		//query...
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['username'] = $username;
		$data['password'] = $password;
		$data['title'] = $page;
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);
	}
	
	/*
	 * Confirms the creation of a new Quiz.
	 * Redirects you to display_quiz page
	 */
	public function createQuizSuccess(){
		$title = $this->input->post('title');
		$owner = $this->input->post('owner');
		$category = $this->input->post('category');
		$password = $this->input->post('password');
		$page = 'display_quiz';
		//query...
		$this->quiz_app->addQuiz($title, $owner, $category);
		$data['userData'] = $this->quiz_app->login($owner, $password);
		$data['userQuizzes'] = $this->quiz_app->getUserQuizzes($owner);
		$data['username'] = $owner;
		$data['password'] = $password;
		$data['title'] = $page;
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);
	}
	
	/*
	 * Displays the quizzes owned by the user currently logged in
	 */
	public function viewUserQuizzes(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$page = 'display_quiz';
		
		//query...
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['userQuizzes'] = $this->quiz_app->getUserQuizzes($username);
		$data['title'] = $page;
		$data['username'] = $username;
		$data['password'] = $password;
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);
	}
	
	
	/*
	 * Interface for adding a question to a given quiz
	 * Redirects you to add_questions page
	 */
	public function addQuestion(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$page = 'add_questions';
		
		//query...
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['title'] = $page;
		$data['quiz_title'] = $title;
		$data['username'] = $username;
		$data['password'] = $password;
		$data['id'] = $id;
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);
	}
	
	/*
	 * Adds the question
	 * Redirects you to add_choce page
	 */
	public function addQuestionSuccessful(){
		$question_given = $this->input->post('question');
		//hidden inputs
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$page = 'add_choice';
		
		//query...
		$this->quiz_app->addQuestion($question_given, $id);
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['quizQuestion'] = $this->quiz_app->getParticularQuestion($id, $question_given);
		$data['quiz_title'] = $title;
		$data['username'] = $username;
		$data['password'] = $password;
		$data['title'] = $page;
		$data['id'] = $id;
		$data['question_given'] = $question_given;
		
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);
	}
	
	/*
	 * Adds the choice for a question
	 * Redirects you to display_quiz page
	 */
	public function addChoice(){
		$page = 'display_quiz';
		$option_a = $this->input->post('choice_a');
		$option_b = $this->input->post('choice_b');
		$option_c = $this->input->post('choice_c');
		$option_d = $this->input->post('choice_d');
		$answer = $this->input->post('choice_answer');
		//hidden
		$question_number = $this->input->post('question_number');
		$question_id = $this->input->post('question_id');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$id = $this->input->post('id');
		$question = $this->input->post('question');
		
		
		//query...
		$this->quiz_app->addChoice($option_a, 'a', $question_number);	//choice a
		$this->quiz_app->addChoice($option_b, 'b', $question_number);	//choice b
		$this->quiz_app->addChoice($option_c, 'c', $question_number);	//choice c
		$this->quiz_app->addChoice($option_d, 'd', $question_number);	//choice d
		$this->quiz_app->setCorrectAnswer($answer, $id, $question_number, $question);
		
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['userQuizzes'] = $this->quiz_app->getUserQuizzes($username);
		$data['username'] = $username;
		$data['password'] = $password;
		$data['title'] = $page;
	
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);
	}
	
	
	/*
	 * Interface for deleting a quiz
	 * Redirects you to confirm_delete_quiz page
	 */ 
	public function deleteQuiz(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$title = $this->input->post('title');
		$page = 'confirm_delete_quiz';
		
		$data['title'] = $page;
		$data['quiz_title'] = $title;
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['username'] = $username;
		$data['password'] = $password;
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);
	}
	
	/*
	 * Deletes the quiz
	 * Redirects you to display_quiz page
	 */
	public function deleteSuccess(){
		$page = 'display_quiz';
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$title = $this->input->post('title');
		
		//query...
		$this->quiz_app->deleteQuiz($title);
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['userQuizzes'] = $this->quiz_app->getUserQuizzes($username);
		$data['username'] = $username;
		$data['password'] = $password;
		$data['title'] = $page;
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);
	}
	
	/*
	 * Interface for editing quiz.
	 * Redirects you to the edit_quiz page
	 */
	public function editQuiz(){
		$page = 'edit_quiz';
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$title = $this->input->post('title');
		
		//query...
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['userQuizzes'] = $this->quiz_app->getParticularQuiz($username, $title);
		$data['username'] = $username;
		$data['password'] = $password;
		$data['title'] = $page;
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);
	}
	
	/*
	 * Edits the quiz attributes
	 * Redirects you to the display_quiz page
	 */
	public function editQuizSuccess(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$old_title = $this->input->post('old_title');
		$new_title = $this->input->post('new_title');
		$category = $this->input->post('category');
		$page = 'display_quiz';
		
		//query...
		$data['userData'] = $this->quiz_app->login($username, $password);
		$this->quiz_app->editQuiz($username, $new_title, $category, $old_title);
		$data['userQuizzes'] = $this->quiz_app->getUserQuizzes($username);
		$data['username'] = $username;
		$data['password'] = $password;
		$data['title'] = $page;
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);
	}
	
	/*
	 * Accesses the question and displays it by
	 * redirecting you to question_list page
	 */
	public function accessQuestion(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$page = 'question_list';
		
		//query...
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['userQuizQuestion'] = $this->quiz_app->getUserQuestions($id);
		$data['username'] = $username;
		$data['password'] = $password;
		$data['title'] = $page;
		$data['quiz_title'] = $title;
		$data['id'] = $id;
		
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);
	}
	
	/*
	 * Interface for deleting a question
	 */
	public function deleteQuestion(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$question_number = $this->input->post('question_number');
		$page = 'confirm_delete_question';
		
		//query..
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['username'] = $username;
		$data['password'] = $password;
		$data['title'] = $page;
		$data['quiz_title'] = $title;
		$data['id'] = $id;
		$data['question_number'] = $question_number;
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);
	}
	
	/*
	 * Deletes the question
	 */
	public function deleteQuizSuccess(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$question_number = $this->input->post('question_number');
		$page = 'question_list';
		
		//query...
		$this->quiz_app->deleteQuestion($question_number, $id);
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['userQuizQuestion'] = $this->quiz_app->getUserQuestions($id);
		$data['username'] = $username;
		$data['password'] = $password;
		$data['title'] = $page;
		$data['quiz_title'] = $title;
		$data['id'] = $id;
		
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);
	}
	
	/*
	 * Interface for editing a question
	 */
	public function editQuestion(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$question_given = $this->input->post('question_given');
		$page = 'edit_question';
		
		//query...
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['userQuizQuestion'] = $this->quiz_app->getParticularQuestion($id, $question_given);
		$data['username'] = $username;
		$data['password'] = $password;
		$data['title'] = $page;
		$data['quiz_title'] = $title;
		$data['id'] = $id;
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);	
	}
	
	/*
	 * Edits the question
	 */
	public function editQuestionSuccess(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$question_number = $this->input->post('question_number');
		$n_question = $this->input->post('new_question');
		$n_cor_choice = $this->input->post('new_cor_choice');
		$page = 'question_list';
		
		//query...
		$this->quiz_app->editQuestion($n_question, $n_cor_choice, $id, $question_number);
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['userQuizQuestion'] = $this->quiz_app->getUserQuestions($id);
		$data['username'] = $username;
		$data['password'] = $password;
		$data['title'] = $page;
		$data['quiz_title'] = $title;
		$data['id'] = $id;
		
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);	
	}
	
	/*
	 * Views the Choices
	 */
	public function viewChoices(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$question_given = $this->input->post('question_given');
		$question_number = $this->input->post('question_number');
		$page = 'choice_list';
		
		//query...
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['questionChoices'] = $this->quiz_app->getChoice($question_number);
		$data['username'] = $username;
		$data['password'] = $password;
		$data['title'] = $page;
		$data['quiz_title'] = $title;
		$data['question_given'] = $question_given;
		$data['question_number'] = $question_number;
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);	
	}
	
	/*
	 * Interface for editing the choices of a question
	 * Redirects you to edit_choice page
	 */
	public function editChoice(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$question_number = $this->input->post('question_number');
		$letter = $this->input->post('letter');
		$question_given = $this->input->post('question_given');
		$title = $this->input->post('title');
		$new_choice = $this->input->post('new_choice');
		$page = 'edit_choice';
		
		//query...
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['questionChoices'] = $this->quiz_app->getChoice($question_number);
		$data['username'] = $username;
		$data['password'] = $password;
		$data['title'] = $page;
		$data['quiz_title'] = $title;
		$data['question_given'] = $question_given;
		$data['question_number'] = $question_number;
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);	
	}
	
	/*
	 * Edits the choice
	 * Redirects you to display_quiz page
	 */
	public function editChoiceSuccess(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$question_number = $this->input->post('question_number');
		//$option_given = $this->input->post('option_given');
		$letter = $this->input->post('letter');
		$question_given = $this->input->post('question_given');
		$title = $this->input->post('title');
		$new_choice = $this->input->post('new_choice');
		$page = 'choice_list';
		
		//query...
		for($i = 0; $i < count($new_choice); $i++){
			$this->quiz_app->editChoice($letter[$i], $question_number, $new_choice[$i]);
		}
		//echo count($question_number);
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['questionChoices'] = $this->quiz_app->getChoice($question_number);
		$data['title'] = $page;
		$data['username'] = $username;
		$data['password'] = $password;
		$data['quiz_title'] = $title;
		$data['question_given'] = $question_given;
		$data['question_number'] = $question_number;
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);
	}
	
	/*
	 * Views all the quizzes available for you to answer
	 * Redirects you to display_all_quiz page
	 */
	public function viewAllQuizzes(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$page = 'display_all_quiz';
		
		//query...
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['all_quiz'] = $this->quiz_app->getAllQuizzes($username);
		$data['username'] = $username;
		$data['password'] = $password;
		$data['title'] = $page;
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);	
	}
	
	/*
	 * Lets you answer a selected quiz
	 * Redirects you to answer_quiz page
	 */
	public function answerQuiz(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$page = 'answer_quiz';
		
		//query...
		$data['questionToAnswer'] = $this->quiz_app->getQuizQuestion($id);
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['username'] = $username;
		$data['password'] = $password;
		$data['id'] = $id;
		$data['quiz_title'] = $title;
		$data['title'] = $page;
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);	
	}
	
	/*
	 * Checks the answer of the quiz recently answered by the user
	 */
	public function checkQuiz(){
		$answer = $this->input->post('answer');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$question_number = $this->input->post('question_number');
		$id = $this->input->post('id');
		$page = 'home_profile';
		
		$score = 0;
		$total = 0;	//total items
		for($i = 0; $i < count($answer); $i++){
			//query...
			$result = $this->quiz_app->checkCorrectAnswer($question_number[$i], $id, $answer[$i]);
			
			if($result->num_rows() == 1)
				$score++;
			else
				$score = $score;
			$total++;				
		}
		$percentage = ($score/$total) * 100;
		//query...
		$this->quiz_app->setStatistics($username, $id, $score, $percentage);
		$data['user_quiz_statistics'] = $this->quiz_app->getUserAnsweredQuizzes($username);
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['username'] = $username;
		$data['password'] = $password;
		$data['title'] = $page;
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);	
	}
	
	public function searchQuizzes(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$page = 'search_quiz';
		
		//query...
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['title'] = $page;
		$data['username'] = $username;
		$data['password'] = $password;
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);	
	}
	
	public function searchQuizzesSuccessful(){
		$category = $this->input->post('category');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$page = 'search_result';
		
		$data['userData'] = $this->quiz_app->login($username, $password);
		$data['title'] = $page;
		$data['username'] = $username;
		$data['password'] = $password;
		$data['all_quiz'] = $this->quiz_app->searchQuiz($category, $username);
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page);
		$this->load->view('templates/footer', $data);	
	}
}//end of class

