<?php

class Quiz_app_model extends CI_Model {
	
	//constructor
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}//end of construct
	
	/*
	 * Create new user query function of the page
	 * Inserts the user to the database
	 */
	public function createUser($username, $e_add, $password){
		//query...
		$this->db->query("Insert into users values('".$username."', '".$e_add."', '".$password."')");
	}
	
	/*
	 * Login query function of the page
	 * Retrieves all information about the username given that
	 * username and password matches
	 */
	 public function login($username, $password){
		//query...
		$result = $this->db->query("select * from users where username = '".$username."' and password = '".$password."'");
		return $result;
	 }
	 
	 
	 /*
	  * Creates a quiz for the particular user
	  */
	  public function addQuiz($title, $owner, $category){
		$this->db->query("Insert into quiz(title, owner_username, category_name) values('$title', '$owner', '$category')");
	  }
	  
	  /*
	   * Deletes the specified quiz
	   */
	   public function deleteQuiz($title){
		$this->db->query("Delete from quiz where title = '$title'");
	   }
	   
	   /*
	    * Retrievs all quizzes in the database except your own quizzes
		* and the quizzes which you have already answered
		*/
	   public function getAllQuizzes($owner){
		$result = $this->db->query("Select * from quiz q where owner_username <> '$owner' and not exists (Select quiz_id from user_quizzes u where q.quiz_id =  u.quiz_id)");
		return $result;
	   }
	   
	   /*
	    * Search quizzes by category
		*/
		public function searchQuiz($category, $owner){
			$result = $this->db->query("Select * from quiz q where category_name = '$category' and owner_username <> '$owner' and not exists (Select quiz_id from user_quizzes u where q.quiz_id =  u.quiz_id)");
			return $result;
		}
	   
	   /*
	    * Display all user quizzes
		*/
		public function getUserQuizzes($owner){
		 $result = $this->db->query("Select * from quiz as q where q.owner_username = '$owner'");
		 return $result;
		}
		
		/*
		 * Get a particular quiz
		 */
		 public function getParticularQuiz($owner, $title){
			$result = $this->db->query("Select * from quiz where owner_username = '$owner' and title = '$title'");
			return $result;
		 }
		
		/*
		 * Edits the quiz's attributes
		 */
		 public function editQuiz($owner, $n_title, $n_category, $o_title){
			$this->db->query("Update quiz set title = '$n_title', category_name = '$n_category' where title = '$o_title' and 	owner_username = '$owner'");
		 }
		 
		 
		/*
		 * Gets all the quiz's questions
		 */
		public function getQuizQuestion($quiz_id){
			$result = $this->db->query("Select q1.quiz_id, title, question_given, cor_choice_letter,  question_number from (quiz q1 join question q2 on q1.quiz_id = q2.quiz_id) where q1.quiz_id = $quiz_id order by q1.quiz_id, q2.question_number");
			return $result;
		}
		 
		 /*
		  * Adds a question to a specified quiz
		  */ 
		 public function addQuestion($question_given, $quiz_id){
			$this->db->query("Insert into question(question_given, quiz_id) values('$question_given', $quiz_id)");
		 }
		 
		 /*
		  * Get a particular question
		  */
		 public function getParticularQuestion($quiz_id, $question_given){
			$result = $this->db->query("Select * from question where quiz_id = $quiz_id and question_given = '$question_given'");
			return $result;
		 }
		 
		 /*
		  *	Retrieves all the questions owned by the current user
		  */
		 public function getUserQuestions($quiz_id){
			$result = $this->db->query("Select * from question where quiz_id = $quiz_id");
			return $result;
		}
		
		/*
		 * Deletes the particular question
		 */ 
		public function deleteQuestion($question_number, $quiz_id){
			$this->db->query("Delete from question where question_number = $question_number and quiz_id = $quiz_id");
		}
		
		/*
		 * Edits a particular question
		 */
		public function editQuestion($n_question, $n_cor_choice, $quiz_id,  $question_number){
			$this->db->query("Update question set question_given = '$n_question', cor_choice_letter = '$n_cor_choice' where quiz_id = $quiz_id and question_number = $question_number");
		}
		 
		 /*
		  * Sets the correct answer for a specific question
		  */
		 public function setCorrectAnswer($cor_choice, $quiz_id, $question_number, $question){
			$this->db->query("Update question set cor_choice_letter = '$cor_choice' where quiz_id = $quiz_id and $question_number = $question_number and question_given = '$question'");
		 }
		 
		 /*
		  * Adds a choice to a given question
		  */
		  public function addChoice($option_given, $letter, $question_number){
			$this->db->query("Insert into choice(option_given, letter, question_number) values ('$option_given', '$letter', $question_number)");
		  }
		  
		  /*
		   * Gets all the choices for a given question
		   */
		  public function getChoice($question_number){
			$result = $this->db->query("Select * from choice where question_number = $question_number");
			return $result;
		  }
		  
		  /*
		   * Edits the choices of a given question
		   */
		  public function editChoice($letter, $question_number, $option){
			$this->db->query("Update choice set option_given = '$option' where question_number = $question_number and letter = '$letter'");
		  }
		 
		  
		 /*
		  * Check if answer is correct.
		  * If so, retruns the tupple
		  */
		 public function checkCorrectAnswer($question_number, $quiz_id, $answer){
			$result = $this->db->query("Select cor_choice_letter from question where quiz_id = $quiz_id and question_number = $question_number and cor_choice_letter = '$answer'");
			return $result;
		 }
		 
		 /*
		  * Sets the attributes for user_quizzes relation
		  */
		 public function setStatistics($username, $id, $score, $percentage){
			$this->db->query("Insert into user_quizzes(username, quiz_id, score, percentage) values ('$username', $id, $score, $percentage)");
		 }
		 
		 /*
		  * Retrives the statistics on the quizzes that was already answered by the 
		  * user
		  */
		 public function getUserAnsweredQuizzes($username){
			$result = $this->db->query("Select owner_username, title, score, percentage from user_quizzes u, quiz q where u.username = '$username' and u.quiz_id = q.quiz_id");
			return $result;
		 }
		  
}//end of class