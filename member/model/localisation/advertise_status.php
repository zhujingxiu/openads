<?php
class ModelLocalisationAdvertiseStatus extends Model {

	public function getAdvertiseStatus($status_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "advertise_status WHERE status_id = '" . (int)$status_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getAdvertiseStatuses($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "advertise_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'";

			$sql .= " ORDER BY status_id";

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
		} else {
			$advertise_status_data = $this->cache->get('advertise_status.' . (int)$this->config->get('config_language_id'));

			if (!$advertise_status_data) {
				$query = $this->db->query("SELECT status_id, name FROM " . DB_PREFIX . "advertise_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY status_id");

				$advertise_status_data = $query->rows;

				$this->cache->set('advertise_status.' . (int)$this->config->get('config_language_id'), $advertise_status_data);
			}

			return $advertise_status_data;
		}
	}

	public function getAdvertiseStatusDescriptions($status_id) {
		$advertise_status_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "advertise_status WHERE status_id = '" . (int)$status_id . "'");

		foreach ($query->rows as $result) {
			$advertise_status_data[$result['language_id']] = array('name' => $result['name']);
		}

		return $advertise_status_data;
	}

	public function getTotalAdvertiseStatuses() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "advertise_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}
}