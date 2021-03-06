<?php
class ModelFbaccountProfilePhoto extends Model {
    private $post_type = 1;

    public function deleteContribute($contribute_id){
        $where = array();
        $where['contribute_id'] = (int)$contribute_id;
        $this->db->delete("fbaccount_photo_post",$where);
        $this->db->delete("fbaccount_photo_post_history",$where);
        $where['post_type'] = $this->post_type;
        $this->db->delete("sns_balance",$where);
        $this->db->delete("fbaccount_photo_text_history",array('post_id' => (int)$contribute_id));
        return true;
    }

    public function getContributes($data) {
        if(!isset($data['filter_mode'])){$data['filter_mode']='';}
        $sql = '';
        switch (strtolower($data['filter_mode']) ){

            case 'images':
                $implode = array();
                if (!empty($data['filter_date_start'])) {
                        $implode[] = " AND DATE(h.date_added) >= DATE('" . $this->db->escape($data['filter_date_start']) . "')";
                }
                if (!empty($data['filter_date_end'])) {
                        $implode[] = " AND DATE(h.date_added) <= DATE('" . $this->db->escape($data['filter_date_end']) . "')";
                }
                $sql = "SELECT DISTINCT p.* FROM ".DB_PREFIX."fbaccount_photo_post p LEFT JOIN ".DB_PREFIX."fbaccount_photo_post_history h ON h.contribute_id = p.contribute_id ".implode(" ", $implode);
                $implode = array();
                $implode[] = " ( p.locker = '0' OR p.locker = '".(int)$this->user->getId()."' )";
                if(!empty($data['filter_status']) && !empty($data['filter_post_status'])){
                    $implode[] = " ( p.status = '".(int)$data['filter_status']."' OR p.publish = '".(int)$data['filter_post_status']."' )";
                    $sql .= " AND ( ( h.type = 'edit' AND h.value = '".(int)$data['filter_status']."' ) OR ( h.type = 'post' AND h.value = '".(int)$data['filter_post_status']."' ) ) ";
                }else if(!empty($data['filter_status']) && $data['filter_status']){
                    $implode[] = "p.status = '".(int)$data['filter_status']."'";
                    $sql .= " AND ( h.type = 'edit' AND h.value = '".(int)$data['filter_status']."' ) ";
                }else if(!empty($data['filter_post_status']) && $data['filter_post_status']){
                    $implode[] = "p.publish = '".(int)$data['filter_post_status']."'";
                    $sql .= " AND ( h.type = 'post' AND h.value = '".(int)$data['filter_post_status']."' ) ";
                }else{
                    $implode[] = " ( p.status IN (".implode(" , ", $this->config->get("fbaccount_photo_artist_status")).") OR p.publish IN (".implode(" , ", $this->config->get("fbaccount_photo_artist_publish"))."))";
                    $sql .= " AND ( ( h.type = 'edit' AND h.value IN (".implode(" , ", $this->config->get("fbaccount_photo_artist_status")).") ) OR ( h.type = 'post' AND h.value IN (".implode(" , ", $this->config->get("fbaccount_photo_artist_publish")).") ) ) ";
                }           
                if (!empty($data['filter_artist_id'])) {
                    $implode[] = " p.artist_id = '" . (int)$data['filter_artist_id'] . "' ";
                }
                $sql .= " WHERE ".implode(" AND ", $implode)." ORDER BY h.date_added DESC , p.contribute_sn ";
                
                break;

            default:
                $sql = "SELECT p.* FROM " . DB_PREFIX . "fbaccount_photo_post p WHERE ( p.author_id = '".$this->user->getAuthorId()."' OR p.artist_id = '".$this->user->getAuthorId()."' )";
                $implode = array();

                if (!empty($data['filter_contribute_sn'])) {
                    $implode[] = "p.contribute_sn LIKE '%" . $this->db->escape($data['filter_contribute_sn']) . "%'";
                }
                if (!empty($data['filter_entry'])) {
                    $implode[] = "p.entry_sn LIKE '%" . $this->db->escape($data['filter_entry']) . "%'";
                }

                if (!empty($data['filter_product_id'])) {
                    $implode[] = "p.product_id = '" . (int)$data['filter_product_id'] . "'";
                }
              
                if (!empty($data['filter_user_id'])) {
                    $implode[] = "p.user_id = '" . (int)$data['filter_user_id'] . "'";
                }   

                if (isset($data['filter_status']) && !is_null($data['filter_status']) && $data['filter_status']!==false) {
                    $implode[] = "p.status = '" . (int)$data['filter_status'] . "'";
                }   

                if (!empty($data['filter_submited_date'])) {
                    $implode[] = "DATE(p.submited_date) >= DATE('" . $this->db->escape($data['filter_submited_date']) . "')";
                }
                if (!empty($data['filter_date_modified'])) {
                    $implode[] = "DATE(p.date_modified) >= DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
                }
                //export target url start
                if (!empty($data['filter_entry_sn'])) {
                    $implode[] = "p.entry_sn = '" . $this->db->escape($data['filter_entry_sn']) . "'";
                }   

                if ($implode) {
                    $sql .= " AND " . implode(" AND ", $implode);
                }
                $sort_data = array(
                    'p.status',
                    'p.product_id',
                    'p.entry_sn',
                    'p.submited_date',
                    'p.date_modified',
                    'p.contribute_sn',
                    'p.user_id',
                    'p.author_id',
                    'p.artist_id'
                );  
                
                if (isset($data['order']) && ($data['order'] == 'ASC')) {
                    $order = " ASC";
                } else {
                    $order = " DESC";
                }
                $sql .= " ORDER BY ";
                if(!isset($this->request->get['sort'])){
                    if(in_array($this->user->getId(), $this->config->get("sns_group_artist"))){
                        $sql .= " p.status IN (".implode(" , ",$this->config->get("fbaccount_photo_artist_status")).") ".$order.", p.publish IN (".implode(" , ",$this->config->get("fbaccount_photo_artist_publish")).") ".$order.", ";
                    }else if(in_array($this->user->getId(), $this->config->get("sns_group_market"))){
                        $sql .= " p.status IN (".implode(" , ",$this->config->get("fbaccount_photo_auditor_status")).") ".$order.", ";
                    }
                }

                if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                    $sql .= $data['sort'].$order." ";   
                } else {
                    $sql .= " p.date_modified".$order."  ";    
                }

                if(!isset($this->request->get['sort'])){
                    if(in_array($this->user->getId(), $this->config->get("sns_group_market"))){
                        $sql .= ", p.publish IN (".implode(" , ",$this->config->get("fbaccount_photo_auditor_publish")).") ".$order;
                    }
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
                break;
        }
        if(!empty($sql)){
            $query = $this->db->query($sql);
            return $query->rows;
        }
        return false;
    }

    public function getTotalContributes($data) {
        $sql = "SELECT COUNT(p.contribute_id) AS total FROM " . DB_PREFIX . "fbaccount_photo_post p WHERE ( p.author_id = '".$this->user->getAuthorId()."' OR p.artist_id = '".$this->user->getAuthorId()."' )";
        $implode = array();

        if (!empty($data['filter_real_contribute_sn'])) {
            $implode[] = "p.contribute_sn = '" . $this->db->escape($data['filter_real_contribute_sn']) . "'";
        }
        if (!empty($data['filter_contribute_sn'])) {
            $implode[] = "p.contribute_sn LIKE '%" . $this->db->escape($data['filter_contribute_sn']) . "%'";
        }
        if (!empty($data['filter_entry'])) {
            $implode[] = "p.entry_sn LIKE '%" . $this->db->escape($data['filter_entry']) . "%'";
        }
        if (!empty($data['filter_product_id'])) {
            $implode[] = "p.product_id = '" . (int)$data['filter_product_id'] . "'";
        }

        if (!empty($data['filter_user_id'])) {
            $implode[] = "p.user_id = '" . (int)$data['filter_user_id'] . "'";
        }   
        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $implode[] = "p.status = '" . (int)$data['filter_status'] . "'";
        }   
        if (!empty($data['filter_submited_date'])) {
            $implode[] = "DATE(p.submited_date) >= DATE('" . $this->db->escape($data['filter_submited_date']) . "')";
        }
        if (!empty($data['filter_date_modified'])) {
            $implode[] = "DATE(p.date_modified) >= DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
        }
        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }
        $query = $this->db->query($sql);
        return $query->row['total'];
    }
    public function getContributeBySn($contribute_sn){
        $sql = "SELECT p.* FROM " . DB_PREFIX . "fbaccount_photo_post p WHERE contribute_sn = '" . $this->db->escape($contribute_sn) . "'";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function getContribute($contribute_id) {
        $sql = "SELECT p.* FROM " . DB_PREFIX . "fbaccount_photo_post p WHERE contribute_id = '" . (int)$contribute_id . "'";
        $query = $this->db->query($sql);
        return $query->row;
    }

    public function resetTempLocker($contribute_id=false,$locker=false){
        $where= array();
        if($contribute_id){
            $where['contribute_id'] = (int)$contribute_id;
        }
        if($locker){
            $where['locker'] = (int)$locker;
        }else{
            $where['locker'] = (int)$this->user->getId();
        }
        $this->db->update("fbaccount_photo_post",$where,array('locker' => 0));
    }

    public function setTempLocker($contribute_id,$user_id=false){
        $value = $user_id ? (int)$user_id : (int)$this->user->getId();
        $this->db->update("fbaccount_photo_post",array('contribute_id' =>(int)$contribute_id),array('locker' =>$value));
    }
    
    public function editContribute($data){      
        if(!isset($data['contribute_id'])){return false;}
        $info = $this->getContribute($data['contribute_id']);
        if(!$info){return false;}
        $log = $fields = $where = array();
        $where['contribute_id'] = $data['contribute_id'];
        if(isset($data['artist_auditor']) && $data['artist_auditor']){
            $fields['artist_id'] = (int)$this->user->getId();
        }else{
            $fields['user_id'] = (int)$this->user->getId();
        }     
        $fields['date_modified'] = date('Y-m-d H:i:s');            
        if(isset($data['publish']) && $data['publish'] !==false ){
            if($data['publish'] > $this->config->get('fbaccount_photo_initial_publish')
                && in_array($info['status'], $this->config->get("fbaccount_photo_level_status"))){
                $fields['publish'] = (int)$data['publish'];
                $log['post'] = (int)$data['publish'];
            }else{
                return false;
            }
        }
        if(!empty($data['upload_files'])){
            $fields['upload_files'] = $data['upload_files'];
        }
        if(!empty($data['target_url'])){
            $fields['target_url'] = $data['target_url'];
        }
        if(!empty($data['content'])){
            $fields['content'] = $data['content'];
        }
        if(!empty($data['note'])){
            $fields['note'] = $data['note'];
        }
        if(!empty($data['finished_type']) && $data['finished_type']=='edit'){
            $fields['status'] = $this->config->get("fbaccount_photo_artist_finished_status");
            $log['edit'] = $this->config->get("fbaccount_photo_artist_finished_status");
        }
        if(!empty($data['finished_type']) && $data['finished_type']=='post'){
            $fields['publish'] = $this->config->get("fbaccount_photo_artist_finished_publish");
            $log['post'] = $this->config->get("fbaccount_photo_artist_finished_publish");
        }
        if(!empty($data['expired'])){
			$fields['expired'] = $data['expired'];
		}
        if(!empty($data['entry_sn'])){
			$fields['entry_sn'] = $data['entry_sn'];
		}
						
        $this->db->update("fbaccount_photo_post SET",$where, $fields);

        $history_id = 0 ;
        $this->resetTempLocker($data['contribute_id']);
        if($log){
            foreach ($log as $key => $value) {
                if(in_array(trim($key), array('edit','post'))){
                    $tmp = array(
                        'type' => trim($key), 
                        'value' => (int)$value,
                        'user_id' => (int)$this->user->getId(),
                        'date_added' => date('Y-m-d H:i:s'),
                        'contribute_id' => (int)$data['contribute_id'],
                    );
                    $history_id = $this->db->insert('fbaccount_photo_post_history',$tmp); 
                }
            }
        }
        return $history_id;
    }

    public function getHistories($contribute_id,$start=0,$limit=20){
        $sql = "SELECT h.*,u.nickname FROM ".DB_PREFIX."fbaccount_photo_post_history h LEFT JOIN ".DB_PREFIX."user u ON h.user_id = u.user_id WHERE h.type = 'edit' AND h.contribute_id = '".(int)$contribute_id."' ORDER BY h.date_added DESC LIMIT " . (int)$start. "," . (int)$limit;
        $query = $this->db->query($sql);
    
        return $query->rows;
    }

    public function getTotalHistory($contribute_id){
        $query = $this->db->query("SELECT COUNT(history_id) total FROM ".DB_PREFIX."fbaccount_photo_post_history WHERE type = 'edit' AND contribute_id = '".(int)$contribute_id."'");
        return $query->row['total'];
    }

}