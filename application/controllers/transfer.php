<?php
class Transfer extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		//load model
		$this->load->model('tranfer_model','',TRUE);
		$this->load->model("email_model",'',TRUE);
		$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
		$this->output->set_header('Cache-Control: max-age=-1281, public, must-revalidate, proxy-revalidate', FALSE);
		$this->output->set_header('Pragma: no-cache');
	}

	function index(){
		if(!is_user_session_exist($this))
			redirect('member/login?rurl='.uri_string());
		$file_path = FCPATH."fileuploads/";
		$rules = array(
					array(
						'field'		=> 'code',
						'label'		=> 'รหัสจอง',
						'rules'		=> 'trim|required|exact_length[7]|xss_clean||callback_check_code_valid'
					),
					array(
						'field'		=> 'pay_money',
						'label'		=> 'จำนวนเงินที่โอน',
						'rules'		=> 'trim|required|numeric'
					),
					array(
						'field'		=> 'pay_money_satang',
						'label'		=> 'จำนวนเงินที่โอน (สตางค์)',
						'rules'		=> 'trim|required|numeric|exact_length[2]'
					)
				);
		if (empty($_FILES['slip']['name']))
		{
			$this->form_validation->set_rules('slip', 'หลักฐานการโอนเงิน', 'required');
		}
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == FALSE) {
			$this->phxview->RenderView('transfer');
			$this->phxview->RenderLayout('default');
		} else {
			$ids = $this->input->post('code');
			$img_name ="";
			if(isset($_FILES['slip']['name'])){
				$date = new DateTime();
				$time = $date->getTimestamp();
				$path = $_FILES['slip']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				$img_name = $time.'.'.$ext;
				//move_uploaded_file($_FILES['slip']['tmp_name'],$file_path.$img_name);
				$this->ReSizeImage($file_path.$img_name,1100,700,$_FILES['slip']);
			
				$this->tranfer_model->money_tranfer($img_name);
				$list = $this->tranfer_model->loadBookingContents($ids);
				foreach($list as $o){
					$obj = array("email"=>$o["email"]
								,"code" =>$o["code"]
								,"pay_date"=>$o["pay_date"]
								,"pay_money"=>$o["pay_money"]
								,"bank_name"=>$o["bank_name"]);
					$this->email_model->approve_tranfer($obj);
				}
				
				redirect('booking/complete', 'refresh');
			}else{
				$this->phxview->RenderView('transfer');
				$this->phxview->RenderLayout('default');
			}
			
		}
	}

 	function send_email(){
		$code = $_GET["code"];
		$list = $this->tranfer_model->loadBookingContents($code);
		foreach($list as $o){
			$obj = array("email"=>$o["email"]
						,"code" =>$o["code"]
						,"pay_date"=>$o["pay_date"]
						,"pay_money"=>$o["pay_money"]
						,"bank_name"=>$o["bank_name"]);
			$this->email_model->approve_tranfer($obj);
		}
		$res = array("success"=>true);
		echo json_encode($res);
	}
	
	function check_code_valid(){
		$result = $this->tranfer_model->loadBooking();
		//if(!empty($result)){
		if($result->num_rows() > 0) {
			return true;
		}else{
			$this->form_validation->set_message('check_code_valid', 'ไม่พบข้อมูลรหัสจองนี้!');
			return false;
		}
	}

	function ReSizeImage($target,$w,$h,$tmp){
		 if(strtolower($this->extention($tmp['name']))=='.jpg'){
			 $image_full = imagecreatefromjpeg($tmp['tmp_name']);	
		 }else if(strtolower($this->extention($tmp['name']))=='.gif'){
			 $image_full = imagecreatefromgif($tmp['tmp_name']);	
		 }else if(strtolower($this->extention($tmp['name']))=='.png'){
			 $image_full = imagecreatefrompng($tmp['tmp_name']);	
		 }
	
		$image_small = imagecreatetruecolor($w,$h);
	
		list($width, $height, $type, $attr) = getimagesize($tmp['tmp_name']);
		
		imagecopyresampled($image_small,$image_full,0,0,0,0,$w,$h,$width,$height);
		
		if(strtolower($this->extention($tmp['name']))=='.jpg'){
			imagejpeg($image_small,$target);
			
		 }else if(strtolower($this->extention($tmp['name']))=='.gif'){
			imagegif($image_small,$target);	
		 }else if(strtolower($this->extention($tmp['name']))=='.png'){
			imagepng($image_small,$target);
		 }
	
		imagedestroy($image_full);
		imagedestroy($image_small);
	
	 }
	
	function extention($filename){
	   $exten = strtolower(strrchr($filename, '.'));
	   $file_extention = array('.jpg','.gif','.png');
	   if(!in_array($exten,$file_extention)){
		return false ;   
	   }else{
		return $exten ;   
	   }		
	}
	
}
