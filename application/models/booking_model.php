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

	// data
	function prepare_print_data($user_id, $booking_id){
		// load profile data
		$this->db->select('thName,code');
		$this->db->where('id', $user_id);
		$this->db->limit(1);
		$query = $this->db->get('person');
		$person_data = $query->first_row('array');

		// load booking data
		$this->db->where('id', $booking_id);
		$this->db->limit(1);
		$query = $this->db->get('booking');
		$booking_data = $query->first_row('array');

		//print_r($booking_data);

		// seat data
		$sql = "SELECT
s.zone_id, z.name AS zone_name
, s.id AS seat_id, s.name AS seat_name
, s.booking_id, b.person_id, b.status
, z.price
FROM seat s
JOIN zone z ON s.zone_id=z.id
JOIN booking b ON s.booking_id=b.id AND b.person_id=? AND b.status=2
WHERE  s.booking_id=?
ORDER BY seat_id ASC";
		$query = $this->db->query($sql, array($user_id, $booking_id));
		$booking_list = $query->result_array();
		$zone_distinct_list = array();
		foreach($booking_list AS $b_obj){
			$exist = false;
			foreach($zone_distinct_list AS $z){
				if($b_obj['zone_name']==$z){
					$exist = true; break;
				}
			}
			if(!$exist)
				array_push($zone_distinct_list, $b_obj['zone_name']);
		}

		return array(
			'person'=>$person_data,
			'zone_list'=>$zone_distinct_list,
			'booking_data'=>$booking_data,
			'booking_list'=>$booking_list
		);
	}

}
