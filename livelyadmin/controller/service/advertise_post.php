<?php
class ControllerServiceAdvertisePost extends Controller {
	private $error = array();
	private $params = array(
		'filter_advertise_sn' => 'filter_advertise_sn',
		'filter_customer_id' => 'filter_customer_id',
		'filter_status' => 'filter_status',
		'filter_in_charge' => 'filter_in_charge',
		'filter_author' => 'filter_author',
		'filter_modified_start' => 'filter_modified_start',
		'filter_modified_end' => 'filter_modified_end',
		'sort' => array('default'=>'ap.date_modified'),
		'order' => array('default'=>'DESC'),
		'page' => array('default'=>1)
	);
	public function index() {
		$this->load->language('service/advertise_post');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->addStyle(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.css');
		$this->document->addScript(TPL_JS.'datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle(TPL_JS.'formvalidation/dist/css/formValidation.css');
		$this->document->addScript(TPL_JS.'formvalidation/dist/js/formValidation.js');
		$this->document->addScript(TPL_JS.'formvalidation/dist/js/framework/bootstrap.min.js');
		$this->document->addScript(TPL_JS.'jquery.maxlength.min.js');

		$this->load->model('service/advertise_post');

		$this->params['token'] = $this->session->data['token'];

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('service/advertise_post', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['list'] = $this->url->link('service/advertise_post', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->session->data['selected'])) {
			$data['selected'] = $this->session->data['selected'];
			unset($this->session->data['selected']);
		} else {
			$data['selected'] = false;
		}

		$this->load->model('localisation/advertise_post');
		$data['statuses'] = $this->model_localisation_advertise_post->getAdvertisePosts();
		$this->load->model('user/user');
		$data['managers'] = $this->model_user_user->getAdOperators('manager');

		// Filter Data
		$filter_data = $this->request->getFilter($this->params);
		$data = array_merge($data,$filter_data);
		$filter_data['start'] = ($filter_data['page'] - 1) * $this->config->get('config_limit_admin');
		$filter_data['limit'] = $this->config->get('config_limit_admin');

		$this->load->model('customer/customer');
		$data['filter_customer'] = '';
		if($data['filter_customer_id']){
			$customer = $this->model_customer_customer->getCustomer($data['filter_customer_id']);
			$data['filter_customer'] = empty($customer['username']) ? '' : $customer['username'].' '.$customer['nickname'];
		}
		$data['posts'] = array();

		$results = $this->model_service_advertise_post->getAdvertisePosts($filter_data);
		foreach ($results as $result) {
			$customer = $this->model_customer_customer->getCustomer($result['customer_id']);
			$in_charger = $this->model_user_user->getUser($result['in_charge']);
			$operator = $this->model_user_user->getUser($result['user_id']);

			$data['posts'][] = array(
				'post_id'  		=> $result['post_id'],
				'advertise_id'  => $result['advertise_id'],
				'advertise_sn'  => $result['advertise_sn'],
				'status'        => $result['status'],
				'status_text'   => $this->adstyle->getPostStatusText($result['status']),
				'product'       => $this->adstyle->getProductText($result['product_id']),
				'customer'      => empty($customer['username']) ? $this->language->get('text_unknown') : $customer['nickname'],
				'charger'       => empty($in_charger['username']) ? $this->language->get('text_unknown') : $in_charger['nickname'],
				'author'      	=> empty($operator['username']) ? $this->language->get('text_unknown') : $operator['nickname'],
				'date_modified' => date('Y-m-d', strtotime($result['date_modified'])).'<br>'.date('H:i:s', strtotime($result['date_modified'])),
			);
			if($data['selected']===false){
				$data['selected'] = $result['post_id'];
			}
		}

		//Pagination
		$pagination = new Pagination();
		$pagination->total = $this->model_service_advertise_post->getTotalAdvertisePosts($filter_data);
		$pagination->page = $filter_data['page'];
		$pagination->limit = $filter_data['limit'];
		$pagination->url = $this->url->link('service/advertise_post', $this->request->setPageUrl($this->params) . '&page={page}', 'SSL');
		$data['pagination'] = $pagination->render();
		$data['results'] = $pagination->getResults($this->language->get('text_pagination'));

		//Sort Order
		$url = $this->request->setOrderUrl($this->params);
		$data['sort_advertise'] = $this->url->link('service/advertise_post', $url. '&sort=a.advertise_sn' , 'SSL');
		$data['sort_customer'] = $this->url->link('service/advertise_post', $url. '&sort=ap.customer_id' , 'SSL');
		$data['sort_operator'] = $this->url->link('service/advertise_post', $url. '&sort=ap.user_id' , 'SSL');
		$data['sort_in_charge'] = $this->url->link('service/advertise_post', $url. '&sort=ap.in_charge' , 'SSL');
		$data['sort_status'] = $this->url->link('service/advertise_post', $url. '&sort=ap.status' , 'SSL');
		$data['sort_date_modified'] = $this->url->link('service/advertise_post', $url. '&sort=ap.date_modified' , 'SSL');

		//Page Text
		$this->language->setText($data,array(
			'heading_title' => 'heading_title',
			'text_list' => 'text_list',
			'text_edit' => 'text_edit',
			'text_filter_title' => 'text_filter_title',
			'text_no_results' => 'text_no_results',
			'text_confirm' => 'text_confirm',
			'tab_history' => 'tab_history',
			'tab_advertise' => 'tab_advertise',
			'tab_post' => 'tab_post',
			'column_ad_sn' => 'column_ad_sn',
			'column_status' => 'column_status',
			'column_date_modified' => 'column_date_modified',
			'column_in_charge' => 'column_in_charge',
			'entry_advertise_sn' => 'entry_advertise_sn',
			'entry_product' => 'entry_product',
			'entry_status' => 'entry_status',
			'entry_modified_start' => 'entry_modified_start',
			'entry_modified_end' => 'entry_modified_end',
			'entry_in_charge' => 'entry_in_charge',
			'entry_author' => 'entry_author',
			'button_filter' => 'button_filter',
			'button_reset' => 'button_reset',
		));

		$this->response->setOutput($this->load->view('service/advertise_post_list.tpl', $data,true));
	}

	public function edit() {
		$this->load->language('service/advertise_post');

		$this->load->model('service/advertise_post');
		$json = array('status'=>0,'msg'=>$this->language->get('text_exception'));
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			if (strlen($this->request->post['headline']) >25 || strlen($this->request->post['text'])>90){
				$json = array('status'=>0,'msg'=>$this->language->get('error_headline_text'));
			}else{
				$result = $this->model_service_advertise_post->editAdvertisePost($this->request->post['post_id'],$this->request->post);
				if($result == -1){
					$json = array('status'=>0,'msg'=>$this->language->get('text_locked'));
				}else if($result == -2){
					$json = array('status'=>0,'msg'=>$this->language->get('text_no_targeting'));
				}else if($result){
					$json = array('status'=>1,'msg'=>$this->language->get('text_success'));
					$this->session->data['success'] = $this->language->get('text_success');
					$this->session->data['selected'] = $this->request->post['post_id'];
				}
			}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function detail() {
		$this->load->language('service/advertise_post');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		$data['token'] = $this->session->data['token'];
		$data['action'] = $this->url->link('service/advertise_post/edit','token='.$this->session->data['token'],'SSL');

		$this->load->model('localisation/targeting');
		$data['locations'] = $this->model_localisation_targeting->getTargetingsByCategory('location');
		$data['genders'] = $this->model_localisation_targeting->getTargetingsByCategory('gender');
		$data['languages'] = $this->model_localisation_targeting->getTargetingsByCategory('language');

		$this->load->model('localisation/advertise_post');
		$data['post_statuses'] = $this->model_localisation_advertise_post->getAdvertisePosts();

		$this->load->model('service/advertise_post');
		$post = $this->model_service_advertise_post->getAdvertisePost($this->request->get['post_id']);

		$data['post_id'] = $post['post_id'];
		$data['advertise_id'] = $post['advertise_id'];
		$data['target_url'] = $post['target_url'];
		$data['domain'] = $post['domain'];
		$data['website_status'] = $post['website_status'];
		$data['ad_note'] = $post['ad_note'];
		$data['product'] = $this->adstyle->getProductText($post['product_id']);
		$data['status_text'] = $this->adstyle->getPostStatusText($post['status']);

		$data['headline'] = isset($post['headline']) ? $post['headline'] : '';
		$data['text'] = isset($post['text']) ? $post['text'] : '';
		$data['note'] = isset($post['note']) ? $post['note'] : '';

		$this->load->model('user/user');
		$locker = $this->model_user_user->getUser($post['locker']);
		$keyer = empty($locker['username']) ? false : $locker['nickname'];

		//Lock Modify
		$data['locked'] = $data['relax'] = $data['modify'] = false;
		if(!$post['website_status']){
			$data['locked'] = true;
			$data['modify'] = false;
			$data['text_lock'] = $this->language->get('text_website_status');
		}else if(!empty($post['locker'])){
			if($post['locker'] == $this->user->getId()){
				$data['locked'] = false;
				$data['modify'] = !in_array($post['status'], $this->config->get('ad_post_levels'));
			}else{
				$data['locked'] = true;
				$data['modify']  = false;
				$data['text_lock'] = sprintf($this->language->get('text_lock'),$keyer);
				$data['relax'] = $this->validate();
			}
		}else if(($this->user->getId() == $post['user_id'])){
			$this->load->model('service/advertise');
			$this->model_service_advertise->lockAdComponent((int)$post['post_id'] ,'post');
			$data['modify'] = !in_array($post['status'], $this->config->get('ad_post_levels'));
		}

		//Targeting
		$targeting = $this->model_service_advertise_post->getAdvertiseTargeting($data['advertise_id']);

		$data['location'] = isset($targeting['location']) ? explode(",", $targeting['location']) : array();
		$data['language'] = isset($targeting['language']) ? explode(",", $targeting['language']) : array();
		$data['other_location'] = isset($targeting['other_location']) ? $targeting['other_location'] : '';
		$data['other_language'] = isset($targeting['other_language']) ? $targeting['other_language'] : '';
		$data['gender'] = isset($targeting['gender']) ? $targeting['gender'] : '';
		$data['age_min'] = isset($targeting['age_min']) ? $targeting['age_min'] : '';
		$data['age_max'] = isset($targeting['age_max']) ? $targeting['age_max'] : '';
		$data['interest'] = isset($targeting['interest']) ? $targeting['interest'] : '';
		$data['audience'] = isset($targeting['audience']) ? $targeting['audience'] : '';
		$data['targeting_status'] = $this->adstyle->getTargetingStatusText($targeting['status']);

		//Photo
		$this->load->model('tool/image');
		$photo = $this->model_service_advertise_post->getAdvertisePhoto($data['advertise_id']);
		$data['file'] = '';
		if(!empty($photo['file'])){
			$files = json_decode($photo['file'],true);
			if(is_array($files)){
				$file = array();
				foreach ($files as $item) {
					if (file_exists($item['path'])){
					$file[] = array(
						'realpath' => HTTP_CATALOG.substr($item['path'],strpos($item['path'],'/')+1),
						'name' => $item['name'],
						'path' => $item['path'],
						'image'	=> $this->model_tool_image->resize($item['path'], 470, 245,true)
					);
					}
				}
				$data['file'] = $file;
			}
		}
		$data['photo_note'] = isset($photo['note']) ? $photo['note'] : '';
		$data['photo_status'] = $this->adstyle->getPhotoStatusText($photo['status']);

		//Page Text
		$this->language->setText($data,array(
			'button_save' => 'button_save',
			'button_relax' => 'button_relax',

			'error_headline' => 'error_headline',
			'error_headline_length' => 'error_headline_length',
			'error_text' => 'error_text',
			'error_text_length' => 'error_text_length',
			'entry_headline' => 'entry_headline',
			'entry_post_text' => 'entry_post_text',
			'entry_note' => 'entry_note',
			'entry_status' => 'entry_status',

			'entry_target_url' => 'entry_target_url',
			'entry_location' => 'entry_location',
			'entry_other_location' => 'entry_other_location',
			'entry_language' => 'entry_language',
			'entry_lother_anguage' => 'entry_other_language',
			'entry_gender' => 'entry_gender',
			'entry_age' => 'entry_age',
			'entry_interest' => 'entry_interest',
			'entry_audience' => 'entry_audience',

			'entry_photo' => 'entry_photo',
			'entry_product' => 'entry_product',
			'entry_domain' => 'entry_domain',
			'entry_ad_node' => 'entry_ad_node',
			'tab_post' => 'tab_post',
			'tab_history' => 'tab_history',
			'text_advertise' => 'text_advertise',
			'text_targeting' => 'text_targeting',
			'text_post' => 'text_post',
			'text_photo' => 'text_photo',
			'text_empty' => 'text_empty'
		));

		$this->response->setOutput($this->load->view('service/advertise_post_form.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->isSupervisor() && $this->user->isManager()) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function history() {
		$this->load->language('service/advertise_post');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_operator'] = $this->language->get('column_operator');
		$data['column_note'] = $this->language->get('column_note');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['histories'] = array();
		$this->load->model('user/user');
		$this->load->model('service/advertise_post');

		$results = $this->model_service_advertise_post->getAdvertisePostHistories($this->request->get['post_id'], ($page - 1) * 10, 10);

		foreach ($results as $result) {

			if($result['in_charge']){
				$user = $this->model_user_user->getUser($result['in_charge']);
				$operator = empty($user['username']) ? '' : $user['nickname'];
			}else if($result['user_id']){
				$user = $this->model_user_user->getUser($result['user_id']);
				$operator = empty($user['username']) ? '' : $user['nickname'];
			}else{
				$operator = $this->language->get('entry_customer');
			}

			$data['histories'][] = array(
				'operator' 	=> $operator,
				'status'   	=> $result['status'],
				'note'    	=> nl2br($result['note']),
				'date_added'=> date('Y-m-d', strtotime($result['date_added'])).'<br>'. date('H:i:s', strtotime($result['date_added']))
			);
		}

		$pagination = new Pagination();
		$pagination->total = $this->model_service_advertise_post->getTotalAdvertisePostHistories($this->request->get['post_id']);
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('service/advertise_post/history', 'token=' . $this->session->data['token'] . '&post_id=' . $this->request->get['post_id'] . '&page={page}', 'SSL');
		$data['pagination'] = $pagination->render();
		$data['results'] = $pagination->getResults($this->language->get('text_pagination'));

		$this->response->setOutput($this->load->view('service/advertise_history.tpl', $data));
	}
}