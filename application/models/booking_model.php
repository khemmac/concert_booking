<?php
Class Booking_model extends CI_Model
{
	function get_booking_round(){
		return 1;
	}

	function get_booking_limit(){
		$round = $this->get_booking_round();
		if($round==1)
			return 6;
		else if($round==2)
			return 20;
		else
			return 0;
	}

	function can_book($user_id, $seat_id){
		// ดึง config ที่บอกว่ารอบจองนี้จองได้สูงสุดกี่ที่นั่ง
		$limit = $this->get_booking_limit();

		$count_all = $this->count_book($user_id);

		if($count_all + (!empty($seat_id)?1:0) > $limit)
			return false;
		else
			return true;
	}

	function reach_limit($user_id){
		// config ที่บอกว่ารอบจองนี้เป็นรอบที่เท่าไหร่
		$round = $this->get_booking_round();

		// ดึง config ที่บอกว่ารอบจองนี้จองได้สูงสุดกี่ที่นั่ง
		$limit = $this->get_booking_limit();

		$this->db->select('count(id) AS cnt');
		$this->db->where('booking_id IN (
				SELECT b.id FROM booking b WHERE b.person_id='.$this->db->escape($user_id)
				.' AND b.round='.$this->db->escape($round).' AND b.status=2)');
		$query = $this->db->get('seat');

		$cnt = $query->first_row()->cnt;

		return ($cnt>=$limit);
	}

	function count_book($user_id){
		// config ที่บอกว่ารอบจองนี้เป็นรอบที่เท่าไหร่
		$round = $this->get_booking_round();

		$this->db->select('count(id) AS cnt');
		$this->db->where('booking_id IN (
				SELECT b.id FROM booking b WHERE b.person_id='.$this->db->escape($user_id)
				.' AND b.round='.$this->db->escape($round).' AND b.status<>99)');
		$query = $this->db->get('seat');
		//echo $this->db->last_query();
		return $query->first_row()->cnt;
	}

	function do_book($user_id, $zone_id, $seat_id){
		// call sp
		$sql = "CALL sp_booking (?,?,?)";
		$parameters = array($user_id, $zone_id, $seat_id);
		$query = $this->db->query($sql, $parameters);

		return $query->result_array();
	}

	function undo_book($user_id, $zone_id, $seat_id){
		$sql = "UPDATE seat SET booking_id=NULL, is_booked=0
WHERE id=? AND booking_id=(SELECT id FROM booking WHERE person_id=? AND status=1 LIMIT 1)";
		$query = $this->db->query($sql, array($seat_id, $user_id));
		return 1;
	}

}
