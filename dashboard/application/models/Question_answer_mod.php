<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_answer_mod extends CI_Model {

	function get_all_question(){
		return $this->db->get('user_question');
	}

	function get_question_answered($id_pertanyaan, $id_user){
		$this->db->select('jawaban');
		$this->db->from('user_answer_question');
		$this->db->where('id_pertanyaan', $id_pertanyaan);
		$this->db->where('id_user', $id_user);

		return $this->db->get();
	}

}

/* End of file question_answer.php */
/* Location: ./application/controllers/question_answer.php */