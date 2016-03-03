<?php
class ControllerCommonProfile extends Controller {
	public function index() {
		$this->load->language('common/menu');

		$this->load->model('user/user');

		$this->load->model('tool/image');

		$user_info = $this->model_user_user->getUser($this->user->getId());

		if ($user_info) {
			$data['nickname'] = $user_info['nickname'];
			$data['username'] = $user_info['username'];
			$roles = array();
			if($this->user->getId()==1){
				$roles[] = $this->language->get('text_admin');
			}else {
				$_roles = $this->model_user_user->getUserRoles($this->user->getId());
				foreach($_roles as $key){
					$roles[] = $this->language->get('text_group_'.strtolower($key));
				}
			}
			$data['roles'] =  implode("<br>",$roles);

			if (is_file(DIR_IMAGE . $user_info['image'])) {
				$data['image'] = $this->model_tool_image->resize($user_info['image'], 45, 45);
			} else {
				$data['image'] = $this->model_tool_image->resize('no_image.png', 45, 45);
			}
		} else {
			$data['username'] = '';
			$data['image'] = '';
		}
		$data['private'] = $this->url->link('common/private','token='.$this->session->data['token']);

		return $this->load->view('common/profile.tpl', $data);
	}
}