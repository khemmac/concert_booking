<?php
Class Tranfer_model extends CI_Model
{
	
	function insert(){
		$this->db->select('username');
		$this->db->where('username', $this->input->post('username'));
		$query = $this->db->get('person');
		$this->db->limit(1);

		if($query->num_rows() > 0)
			throw new Exception('username "'.$this->input->post('username').'" is exists.');

		$formData = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'question' => $this->input->post('question'),
			'answer' => $this->input->post('answer'),
			'code' => $this->input->post('code'),
			'thName' => $this->input->post('thName'),
			'enName' => $this->input->post('enName'),
			'nickName' => $this->input->post('nickName'),
			'sex' => $this->input->post('sex'),
			'birthDate' => $this->input->post('birth_year').'-'.$this->input->post('birth_month').'-'.$this->input->post('birth_date'),
			'address' => $this->input->post('address'),
			'tel' => $this->input->post('tel'),
			'email' => $this->input->post('email'),
			'job' => $this->input->post('job'),
			'job_area' => $this->input->post('job_area'),
			'favorite_artist' => $this->input->post('favorite_artist')
		);

		$this->db->set('createDate', 'NOW()', false);
		$this->db->insert('person', $formData);
	}

	function money_tranfer(){
		$user_id = get_user_session_id($this);

		$this->db->select('code');
		$this->db->where('person_id', $user_id);
		$this->db->where('code', $this->input->post('code'));
		$this->db->where('status', '2'); //2=ยืนยันการจอง
		$result = $this->db->get('booking');

		if($result->num_rows() == 0) {
			$err = array('success'=>false,'msg'=>'code "'.$this->input->post('code').'" is tranfed or not exists.');	
			//echo json_encode($err);
			//throw new Exception('code "'.$this->input->post('code').'" is not exists.');
			return $err;
		}
		
		$formData = array(
			'code' => $this->input->post('code'),
			'pay_date' => $this->input->post('transfer_year').'-'.$this->input->post('transfer_month').'-'.$this->input->post('transfer_date').' '.$this->input->post('time').':00',
			'pay_money' => $this->input->post('pay_money'),
			'bank_name' => $this->input->post('bank_name'),
			'bank_ref_id' => null,
			'payment_type' => '1', //0=Credit ,1=Tranfer
			'status' => '3' //1=ระหว่าจอง ,2=ยืนยันการจอง ,3=แจ้งโอนเงินแล้ว ,4=ยืนยันการโอนเงิน ,99=เลยเวลา 
		);
		
		$res = array('success'=>true,'msg'=>'');
		$this->db->set('updateDate', 'NOW()', false);
		$this->db->update('booking', $formData);
		return $res;
	}

}