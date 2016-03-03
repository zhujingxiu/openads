<?php
class ModelLocalisationTargeting extends Model {
	public function addTargeting($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "targeting SET category = '".$this->db->escape($data['category'])."',`default`='".(int)$data['default']."',`sort`='".(int)$data['sort']."', value= '".$this->db->escape($data['value'])."', user_id = '" . (int)$this->user->getId() . "',date_added = NOW()");
		$targeting_id = $this->db->getLastId();
		foreach ($data['description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "targeting_description SET targeting_id = '" . (int)$targeting_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}
		$this->cache->delete('targeting');

		return $targeting_id;
	}
	
	public function editTargeting($targeting_id, $data) {
		$this->db->query("UPDATE  " . DB_PREFIX . "targeting SET category = '".$this->db->escape($data['category'])."', `status`='".(int)$data['status']."',`default`='".(int)$data['default']."', `sort`='".(int)$data['sort']."', value= '".$this->db->escape($data['value'])."', user_id = '" . (int)$this->user->getId() . "',date_added = NOW() WHERE targeting_id = '".(int)$targeting_id."'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "targeting_description WHERE targeting_id = '" . (int)$targeting_id . "'");

		foreach ($data['description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "targeting_description SET targeting_id = '" . (int)$targeting_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->cache->delete('targeting');
	}
	
	public function deleteTargeting($targeting_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "targeting WHERE targeting_id = '" . (int)$targeting_id . "' ");
		$this->db->query("DELETE FROM " . DB_PREFIX . "targeting_description WHERE targeting_id = '" . (int)$targeting_id . "' ");
	}
	
	
	public function getTargeting($targeting_id) {
		$query = $this->db->query("SELECT t.*,td.name FROM " . DB_PREFIX . "targeting t LEFT JOIN ".DB_PREFIX."targeting_description td ON t.targeting_id = td.targeting_id WHERE t.targeting_id = '" . (int)$targeting_id . "' AND td.language_id = '".$this->config->get('config_language_id')."'");
		return $query->row;
	}

	public function getTargetings($data = array()) {
		$sql = "SELECT t.*,td.name,u.username,u.firstname,u.lastname FROM " . DB_PREFIX . "targeting t	LEFT JOIN " . DB_PREFIX . "targeting_description td ON (t.targeting_id = td.targeting_id AND td.language_id = '".$this->config->get('config_language_id')."')
		LEFT JOIN ".DB_PREFIX."user u ON t.user_id = u.user_id WHERE 1 " ;
		$implode = array();

		if (!empty($data['filter_category'])) {
			$implode[] = "t.category = '" . $this->db->escape($data['filter_category']) . "'";
		}

		if (!empty($data['filter_name'])) {
			$implode[] = "td.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_value'])) {
			$implode[] = "t.value LIKE '%" . $this->db->escape($data['filter_value']) . "%'";
		}

		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		$sort_data = array(
			'td.name',
			'value',
			'user_id',
			'category',
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY t.targeting_id";	
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
	
	public function getTotalTargetings($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "targeting WHERE 1 ";
		$implode = array();

		if (!empty($data['filter_category'])) {
			$implode[] = "category = '" . $this->db->escape($data['filter_category']) . "'";
		}

		if (!empty($data['filter_name'])) {
			$implode[] = "name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_value'])) {
			$implode[] = "value LIKE '%" . $this->db->escape($data['filter_value']) . "%'";
		}				

		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTargetingsByCategory($category='product'){
		$query = $this->db->query("SELECT t.`targeting_id`,td.`name`,t.`default`,t.`value` FROM ".DB_PREFIX."targeting t LEFT JOIN ".DB_PREFIX."targeting_description td ON ( t.targeting_id = td.targeting_id AND td.language_id = '".$this->config->get('config_language_id')."') WHERE t.category = '".$this->db->escape(strtolower($category))."' AND status = '1' ORDER BY sort ASC ");
		return $query->rows;
	}

	public function getTargetingDescriptions($targeting_id) {
		$description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "targeting_description WHERE targeting_id = '" . (int)$targeting_id . "'");

		foreach ($query->rows as $result) {
			$description_data[$result['language_id']] = array(
				'name'            => $result['name'],
			);
		}

		return $description_data;
	}
	
}