<?php

class Pages extends CI_Controller {

	public function view($page = 'index', $path2 = '')
	{
		//echo strrpos($page, 'include');
		if (!file_exists('application/views/'.$page.'.php')
			|| strrpos($page, 'include')===0
			|| strrpos($page, 'layouts')===0
		)
		{
			// Whoops, we don't have a page for that!
			show_404();
			//echo '<h1>ไม่พบหน้า : '.$page.'</h1>';
			redirect('index');
		}else{
			// defined data for page
			$property_bag = array();
/*
			// load configurations
			$this->config->load('app_config');

			// check session
			$session_user_obj = get_user_session($this);//$this->session->userdata('session_reward');
			$session_user_id = get_user_session_id($this);//$this->session->userdata('session_reward');
			if(!empty($session_user_obj) && !empty($session_user_id)){
				$session_user_id = $session_user_obj->id;
				$property_bag['PROP_BAG_SESSION_USER_ID'] = $session_user_id;
				$property_bag['PROP_BAG_SESSION_USER_NICK'] = $session_user_obj->nick;
			}

			// load point
			if(!empty($session_user_id)){
				$GAME_ADMIN_URL = $this->config->item('GAME_ADMIN_URL');
				$json_result = $this->curl->simple_post($GAME_ADMIN_URL.'/index.php/controller/promotion_request/client_load_point',
					array('id'=>$session_user_id)
				);
				$point_result = json_decode($json_result);

				$property_bag['PROP_BAG_CLIENT_POINT'] = $point_result->data->point;
			}
			// cache control
*/
			//echo $page;
			//return;

			$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
			$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
			$this->output->set_header('Cache-Control: max-age=-1281, public, must-revalidate, proxy-revalidate', FALSE);
			$this->output->set_header('Pragma: no-cache');

			$this->phxview->RenderView($page, $property_bag);
			$this->phxview->RenderLayout('default');
		}

	}
}

?>