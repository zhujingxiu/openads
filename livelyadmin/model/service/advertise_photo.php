<?php
class ModelServiceAdvertisePhoto extends Model {

    public function editAdvertisePhoto($photo_id,$data) {
        $photo = $this->getAdvertisePhoto($photo_id,true);

        if(!empty($photo['advertise_id']) && ( $photo['user_id'] == $this->user->getId() ) ){

            if(!empty($photo['locker']) && $photo['locker']!=$this->user->getId()){
                return -1;
            }
            $fields = array(
                'file'          => htmlspecialchars_decode($data['file']),
                'status'        => (int)$this->config->get('ad_photo_review'),
                'note'          => strip_tags(trim($data['note'])),
            //    'user_id'       => strtolower($photo['from']) == 'member' ? 0 : $this->user->getId(),
                'date_modified' => date('Y-m-d H:i:s')
            );
            if(strtolower($photo['from']) == 'backend' && !$photo['user_id']){
                $fields['user_id'] = strtolower($photo['from']) == 'member' ? 0 : (int)$this->user->getId();
            }
            $history = array(
                'photo_id'      => $photo_id,
                'advertise_id'  => $photo['advertise_id'],
                'from'          => "backend",
                'status'        => (int)$this->config->get('ad_photo_review'),
                'note'          => strip_tags(trim($data['note'])),
                'user_id'       => (int)$this->user->getId(),
                'date_added'    => date('Y-m-d H:i:s')
            );

            $this->db->update("advertise_photo",array('photo_id'=>$photo_id), $fields);
            
            return $this->db->insert("advertise_photo_history", $history);
        }
        
        return false;
    }

    public function getAdvertisePhoto($photo_id) {

        $sql = "SELECT ap.*,w.domain,w.status website_status,a.advertise_sn,a.product_id,a.target_url,a.note ad_note FROM `" . DB_PREFIX . "advertise_photo` ap
        LEFT JOIN ".DB_PREFIX."advertise a ON a.advertise_id = ap.advertise_id LEFT JOIN ".DB_PREFIX."website w ON w.website_id = ap.website_id WHERE ap.photo_id = '" . (int)$photo_id . "' ";

        $query = $this->db->query($sql);

        return $query->num_rows ? $query->row : false;

    }

    public function getAdvertisePhotos($data = array()) {
        $sql = "SELECT ap.*,w.domain,a.advertise_sn ,a.product_id FROM `" . DB_PREFIX . "advertise_photo` ap LEFT JOIN ".DB_PREFIX."website w ON w.website_id = ap.website_id
        LEFT JOIN ".DB_PREFIX."advertise a ON a.advertise_id = ap.advertise_id WHERE w.status = '1' AND ap.status > '".$this->config->get('ad_post_pending')."'";

        if(!$this->user->isSupervisor()){
            $sql .= " AND ap.user_id = '".$this->user->getId()."'";
        }
        if (!empty($data['filter_advertise_sn'])) {
            $sql .= " AND a.advertise_sn LIKE '" . $data['filter_advertise_sn'] . "%'";
        }
        if (!empty($data['filter_in_charge'])) {
            $sql .= " AND ap.in_charge = '" . (int)$data['filter_in_charge'] . "'";
        }
        if (!empty($data['filter_status'])) {
            $sql .= " AND ap.status = '" . (int)$data['filter_status'] . "'";
        }
        if (!empty($data['filter_customer_id'])) {
            $sql .= " AND a.customer_id = '" . (int)$data['filter_customer_id'] . "'";
        }        
        if (isset($data['filter_artist'])) {
            $sql .= " AND ap.user_id = '" . (int)$data['filter_artist'] . "'";
        }
        if (!empty($data['filter_date_added'])) {
            $sql .= " AND DATE(ap.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }

        if (!empty($data['filter_date_modified'])) {
            $sql .= " AND DATE(ap.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
        }

        if (!empty($data['filter_modified_start'])) {
            $sql .= " AND DATE(ap.date_modified) >= DATE('" . $this->db->escape($data['filter_modified_start']) . "')";
        }

        if (!empty($data['filter_modified_end'])) {
            $sql .= " AND DATE(ap.date_modified) <= DATE('" . $this->db->escape($data['filter_modified_end']) . "')";
        }

        $sort_data = array(
            'ap.advertise_id',
            'a.advertise_sn',
            'ap.status',
            'a.customer_id',
            'ap.date_added',
            'ap.date_modified',
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY ap.date_modified";
        }

        if (isset($data['order']) && ($data['order'] == 'ASC')) {
            $sql .= " ASC";
        } else {
            $sql .= " DESC";
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

    public function getTotalAdvertisePhotos($data = array()) {
        $sql = "SELECT COUNT(ap.photo_id) AS total FROM `" . DB_PREFIX . "advertise_photo` ap LEFT JOIN ".DB_PREFIX."advertise a ON a.advertise_id = ap.advertise_id LEFT JOIN ".DB_PREFIX."website w ON w.website_id = ap.website_id
        WHERE w.status = '1' AND ap.status > '".$this->config->get('ad_post_pending')."'";

        if(!$this->user->isSupervisor()){
            $sql .= " AND ap.user_id = '".$this->user->getId()."'";
        }
        if (!empty($data['filter_advertise_sn'])) {
            $sql .= " AND a.advertise_sn LIKE '" . $data['filter_advertise_sn'] . "%'";
        }

        if (!empty($data['filter_customer_id'])) {
            $sql .= " AND a.customer_id = '" . (int)$data['filter_customer_id'] . "'";
        }  
        if (!empty($data['filter_status'])) {
            $sql .= " AND ap.status = '" . (int)$data['filter_status'] . "'";
        }
        if (!empty($data['filter_in_charge'])) {
            $sql .= " AND ap.in_charge = '" . (int)$data['filter_in_charge'] . "'";
        }

        if (isset($data['filter_artist'])) {
            $sql .= " AND ap.user_id = '" . (int)$data['filter_artist'] . "'";
        }
        if (!empty($data['filter_date_added'])) {
            $sql .= " AND DATE(ap.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }

        if (!empty($data['filter_date_modified'])) {
            $sql .= " AND DATE(ap.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
        }
        if (!empty($data['filter_modified_start'])) {
            $sql .= " AND DATE(ap.date_modified) >= DATE('" . $this->db->escape($data['filter_modified_start']) . "')";
        }

        if (!empty($data['filter_modified_end'])) {
            $sql .= " AND DATE(ap.date_modified) <= DATE('" . $this->db->escape($data['filter_modified_end']) . "')";
        }
        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getAdvertisePhotoHistories($photo_id, $start = 0, $limit = 10) {
        if ($start < 0) {
            $start = 0;
        }

        if ($limit < 1) {
            $limit = 10;
        }
        $sql = "SELECT aph.*, aps.name AS status FROM " . DB_PREFIX . "advertise_photo_history aph
        LEFT JOIN " . DB_PREFIX . "advertise_photo_status aps ON (aph.status = aps.status_id AND aps.language_id = '" . (int)$this->config->get('config_language_id') . "') 
        WHERE aph.photo_id = '" . (int)$photo_id . "'  ORDER BY aph.date_added DESC LIMIT " . (int)$start . "," . (int)$limit;
        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotalAdvertisePhotoHistories($photo_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "advertise_photo_history WHERE photo_id = '" . (int)$photo_id . "'");

        return $query->row['total'];
    }
    public function getAdvertiseTargeting($advertise_id) {
        $data = array(
            'one' => true,
            'field' => 'at.*,ats.name',
            'alias'=>'at',
            'join' => array(
                array(
                    'table' => 'advertise_targeting_status',
                    'alias' => 'ats',
                    'on' => "ats.status_id = at.status AND ats.language_id ='".$this->config->get('config_language_id')."'"
                )
            ),
            'condition' => array(
                'advertise_id' => $advertise_id
            )
        );
        return $this->db->fetch('advertise_targeting',$data);
    }

    public function getAdvertisePost($advertise_id) {
        $data = array(
            'one' => true,
            'field' => 'ap.*,aps.name',
            'alias'=>'ap',
            'join' => array(
                array(
                    'table' => 'advertise_post_status',
                    'alias' => 'aps',
                    'on' => "aps.status_id = ap.status AND aps.language_id ='".$this->config->get('config_language_id')."'"
                )
            ),
            'condition' => array(
                'advertise_id' => $advertise_id
            )
        );
        return $this->db->fetch('advertise_post',$data);
    }

    public function validateState($entry_id){
        $data = array(
            'one'       => true,
            'alias'     => 'am',  
            'field'     => array('ap.status'),
            'join'      => array(
                array(
                    'table' => 'advertise',
                    'alias' => 'a',
                    'on'    => 'a.advertise_id = am.advertise_id'
                ),
                array(
                    'table' => 'advertise_post',
                    'alias' => 'ap',
                    'on'    => 'a.post_id = ap.post_id'
                )
            ),
            'condition' => array(
                'photo_id' => $entry_id
            )
        );        
        $result = $this->db->fetch('advertise_photo',$data);
        if(isset($result['status']) && in_array($result['status'], $this->config->get('ad_post_levels'))){
            return true;
        }
        return false;
    }
}