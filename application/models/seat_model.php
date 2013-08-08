<?php
Class Seat_model extends CI_Model
{
	function load_booking_seat(){
		$result_data = array(
			'zones'=>array(),
			'seats'=>array(),
			'price'=>0
		);
		if(!is_user_session_exist($this))
			return $result_data;

		$user_id = get_user_session_id($this);
		$sql = 'SELECT
s.zone_id, z.name AS zone_name,
s.id AS seat_id, s.name AS seat_name,
z.price
FROM seat s
LEFT JOIN zone z ON s.zone_id=z.id
WHERE s.booking_id IN (
    SELECT b.id FROM booking b WHERE person_id='.$this->db->escape($user_id).' AND status=1
)
ORDER BY zone_id ASC, seat_id ASC';
		$query = $this->db->query($sql);

		foreach($query->result_array() AS $value){
			// add zone data
			$zone_exist = false;
			foreach($result_data['zones'] AS $z_value){
				if($value['zone_name']==$z_value){
					$zone_exist = true; break;
				}
			}
			if(!$zone_exist) array_push($result_data['zones'], $value['zone_name']);

			// add seat data
			array_push($result_data['seats'], $value['seat_name']);

			$result_data['price'] += $result_data['price'];
		}
		return $result_data;
	}

	function load_zone_seat($zone_name){
		$result_data = array();
		if(!is_user_session_exist($this))
			return $result_data;

		$user_id = get_user_session_id($this);

		$sql = "SELECT
s.id AS seat_id, s.name AS seat_name
, s.is_booked, s.booking_id, s.is_soldout
, IF((SELECT COUNT(b.id) FROM booking b WHERE b.person_id=".$this->db->escape($user_id)." AND b.status=1 AND s.booking_id=b.id)>0, 1, 0) AS is_own
FROM seat s
JOIN zone z ON s.zone_id=z.id
WHERE z.name=".$this->db->escape($zone_name);
		return $result_data;
	}

}