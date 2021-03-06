<?php
class ModelUserUser extends Model {
	public function addUser($data) {
		$salt = substr(md5(uniqid(rand(), true)), 0, 9);
		
	    $office_fields = array(
			'office_name' 		=> $data['username'],
			'salt'			=> $salt,
			'password'		=> sha1($salt . sha1($salt . sha1($data['password']))),
			'nickname'		=> $data['nickname'],
			'firstname'		=> $data['firstname'],
			'lastname'		=> $data['lastname'],
			'email'			=> $data['email'],
			'author_id'		=> $data['author_id'],
			'worker'		=> (isset($data['worker']) && is_array($data['worker']) ? implode(",", $data['worker']) : ''),
			'image'			=> $data['image'],
			'status'		=> (int)$data['status'],
			'date_added'	=> date('Y-m-d H:i:s')
		);

		$last_office_id=$this->db->insert("office_user",$office_fields);
	    $fields = array(
			'username' 		=> $data['username'],
			'salt'			=> $salt,
			'password'		=> sha1($salt . sha1($salt . sha1($data['password']))),
			'nickname'		=> $data['nickname'],
	        'office_id'		=> $last_office_id,
			'firstname'		=> $data['firstname'],
			'lastname'		=> $data['lastname'],
			'email'			=> $data['email'],
			'author_id'		=> $data['author_id'],
			'image'			=> $data['image'],
			'status'		=> (int)$data['status'],
			'date_added'	=> date('Y-m-d H:i:s')
		);
		$this->db->insert("user",$fields);
	}

	public function editUser($user_id, $data) {
		$office_id=$this->getUserOfficeId($user_id);
		$fields = array(
			'username' 		=> $data['username'],
			'nickname'		=> $data['nickname'],
			'firstname'		=> $data['firstname'],
			'lastname'		=> $data['lastname'],
			'email'			=> $data['email'],
			'worker'		=> (isset($data['worker']) && is_array($data['worker']) ? implode(",", $data['worker']) : ''),
			'image'			=> $data['image'],
		);
		if(isset($data['status'])){
			$fields['status'] = (int)$data['status'];
		}
		if(isset($data['author_id'])){
			$fields['author_id'] = $data['author_id'];
		}
		$office_fields = array(
			'office_name' 	=> $data['username'],
			'nickname'		=> $data['nickname'],
			'firstname'		=> $data['firstname'],
			'lastname'		=> $data['lastname'],
			'email'			=> $data['email'],
			'image'			=> $data['image'],
		);

		if(isset($data['author_id'])){
			$office_fields['author_id'] = $data['author_id'];
		}
		if(isset($data['status'])){
			$office_fields['status'] = (int)$data['status'];
		}
		$this->db->update("user",array('user_id' =>(int)$user_id),$fields);
		$this->db->update("office_user",array('office_id' =>(int)$office_id),$office_fields);

		if ($data['password']) {
			$salt = substr(md5(uniqid(rand(), true)), 0, 9);
			$fields = array(
				'salt'		=> $salt,
				'password'	=> sha1($salt . sha1($salt . sha1($data['password']))),
			);
			$this->db->update("user",array('user_id' =>(int)$user_id),$fields );
			$this->db->update("office_user",array('office_id' =>(int)$office_id),$fields);
		}
	}

	public function editPassword($user_id, $password) {
		$salt = substr(md5(uniqid(rand(), true)), 0, 9);
		$fields = array(
			'salt'		=> $salt,
			'password'	=> sha1($salt . sha1($salt . sha1($password))),
			'code'		=> ''
		);
		$this->db->update("user" ,array('user_id' => (int)$user_id),$fields);
	}

	public function editCode($email, $code) {
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET code = '" . $this->db->escape($code) . "' WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
	}

	public function deleteUser($user_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "user` WHERE user_id = '" . (int)$user_id . "'");
	}

	public function getUser($user_id) {
		$query = $this->db->query("SELECT u.* FROM `" . DB_PREFIX . "user` u WHERE u.user_id = '" . (int)$user_id . "'");

		return $query->row;
	}

	public function getUserByUsername($username) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE username = '" . $this->db->escape($username) . "'");

		return $query->row;
	}

	public function getUserByCode($code) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE code = '" . $this->db->escape($code) . "' AND code != ''");

		return $query->row;
	}

	public function getUserByAuthorId($author_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE author_id = '" . $this->db->escape($author_id) . "' ");

		return $query->row;
	}

	public function getAuthors(){
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE LENGTH(author_id) = '3' AND status = '1'");

		return $query->rows;
	}

	public function getUsers($data = array()) {
		$sql = "SELECT u.*,nickname name FROM `" . DB_PREFIX . "user` u ";

		$sort_data = array(
			'username',
			'status',
			'date_added',
			'user_id'
		);
        if (isset($data['roles'])){
        	
        	$sql .= " WHERE user_id IN (".implode(",",$data['roles']).")";
        }
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY user_id";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalUsers() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user`");

		return $query->row['total'];
	}

	public function getTotalUsersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user` WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row['total'];
	}

	public function getAdOperators($key){
		$users = $this->config->get('ad_group_'.strtolower($key));
		$data = array();
		if(is_array($users)){
			foreach($users as $uid){
				$row = $this->getUser($uid);
				if($row) {
					$data[] = array(
						'user_id' 	=> $row['user_id'],
						'name' 	=> $row['nickname'],
						'username' 	=> $row['username'],
						'author_id' => $row['author_id']
					);
				}
			}
		}
		return $data;
	}

	public function getUserAuthorId($user_id){
		$query = $this->db->query("SELECT author_id FROM ".DB_PREFIX."user WHERE user_id = '".$user_id."'");
		return $query->num_rows ? $query->row['author_id'] : false;
	}
	public function getUserOfficeId($user_id){
		$query = $this->db->query("SELECT office_id FROM ".DB_PREFIX."user WHERE user_id = '".$user_id."'");
		return $query->num_rows ? $query->row['office_id'] : false;
	}

	public function getUserRoles($user_id){
		$roles = array();
		if(is_array($this->config->get('ad_group_supervisor')) && in_array($user_id,$this->config->get('ad_group_supervisor'))){
			$roles[] = 'supervisor';
		}
		if(is_array($this->config->get('ad_group_manager')) && in_array($user_id,$this->config->get('ad_group_manager'))){
			$roles[] = 'manager';
		}
		if(is_array($this->config->get('ad_group_targeting')) && in_array($user_id,$this->config->get('ad_group_targeting'))){
			$roles[] = 'targeting';
		}
		if(is_array($this->config->get('ad_group_post')) && in_array($user_id,$this->config->get('ad_group_post'))){
			$roles[] = 'post';
		}
		if(is_array($this->config->get('ad_group_photo')) && in_array($user_id,$this->config->get('ad_group_photo'))){
			$roles[] = 'photo';
		}
		if(is_array($this->config->get('ad_group_publisher')) && in_array($user_id,$this->config->get('ad_group_publisher'))){
			$roles[] = 'publisher';
		}
		if(is_array($this->config->get('ad_group_prmotor')) && in_array($user_id,$this->config->get('ad_group_prmotor'))){
			$roles[] = 'prmotor';
		}

		return $roles;
	}
}