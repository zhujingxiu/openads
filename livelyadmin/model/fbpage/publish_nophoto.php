<?php
class ModelFbpagePublishNophoto extends Model {

    private $post_type = 3;
    public function deleteContribute($contribute_id){
        $where = array();
        $where['contribute_id'] = $contribute_id;
        $this->db->delete("fbpage_nophoto_post",$where);
        $this->db->delete("fbpage_nophoto_post_history",$where);
        $where['post_type'] = array('logic'=>'in','value'=>'3,4');
        $this->db->delete("sns_balance",$where);
    }

    public function getContributes($data) {
        $sql = "SELECT p.* FROM " . DB_PREFIX . "fbpage_nophoto_post p WHERE p.publish > '".$this->config->get('fbpage_initial_publish')."' ";
        $implode = array();
        // 根据当前登录用户,获取用户的下属用户的author_id
        if(!in_array($this->user->getId(), $this->config->get("sns_group_admin"))){
            $authors = array("'".$this->user->getAuthorId()."'");
            $wokers = $this->user->geWorkers();
            $this->load->model('user/user');
            foreach ($wokers as $value) {
                $_author = $this->model_user_user->getUser($value);
                if(!empty($_author['author_id'])){
                    $authors[] = "'".$_author['author_id']."'";
                }
            }
            $implode[] = "p.author_id IN (".implode(",", $authors).") ";
        }

        if (!empty($data['filter_entry'])) {
            $implode[] = "p.entry_sn LIKE '%" . $this->db->escape($data['filter_entry']) . "%'";
        }

        if (!empty($data['filter_product_id'])) {
            $implode[] = "p.product_id = '" . (int)$data['filter_product_id'] . "'";
        }
        if (!empty($data['filter_author_id'])) {
            $implode[] = "p.author_id = '" . $this->db->escape(trim($data['filter_author_id'])) . "'";
        } 
        if (!empty($data['filter_user_id'])) {
            $implode[] = "p.user_id = '" . (int)$data['filter_user_id'] . "'";
        }   
     
        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $implode[] = "p.status = '" . (int)$data['filter_status'] . "'";
        }   
        if (isset($data['filter_publish']) && $data['filter_publish']!==false) {
            $implode[] = "p.publish = '".(int)$data['filter_publish']."' ";
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
        $sort_data = array(
            'p.status',
            'p.publish',
            'p.product_id',
            'p.entry_sn',
            'p.author_id',
            'p.submited_date',   
            'p.date_modified',
            'p.user_id',
        );  
        
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];   
        } else {
            $sql .= " ORDER BY p.date_modified";   
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

    public function getTotalContributes($data) {
        $sql = "SELECT COUNT(p.contribute_id) AS total FROM " . DB_PREFIX . "fbpage_nophoto_post p WHERE p.publish > '".$this->config->get('fbpage_initial_publish')."'";
        $implode = array();
        // 根据当前登录用户,获取用户的下属用户的author_id
        if(!in_array($this->user->getId(), $this->config->get("sns_group_admin"))){
            $authors = array("'".$this->user->getAuthorId()."'");
            $wokers = $this->user->geWorkers();
            $this->load->model('user/user');
            foreach ($wokers as $value) {
                $_author = $this->model_user_user->getUser($value);
                if(!empty($_author['author_id'])){
                    $authors[] = "'".$_author['author_id']."'";
                }
            }
            $implode[] = "p.author_id IN (".implode(",", $authors).") ";
        }

        if (!empty($data['filter_entry'])) {
            $implode[] = "p.entry_sn LIKE '%" . $this->db->escape($data['filter_entry']) . "%'";
        }

        if (!empty($data['filter_product_id'])) {
            $implode[] = "p.product_id = '" . (int)$data['filter_product_id'] . "'";
        }
        if (!empty($data['filter_author_id'])) {
            $implode[] = "p.author_id = '" . $this->db->escape(trim($data['filter_author_id'])) . "'";
        } 
        if (!empty($data['filter_user_id'])) {
            $implode[] = "p.user_id = '" . (int)$data['filter_user_id'] . "'";
        }   
      
        if (isset($data['filter_publish'])) {
            $implode[] = "p.publish = '".(int)$data['filter_publish']."' ";
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

    public function getContribute($contribute_id) {
        $sql = "SELECT * FROM " . DB_PREFIX . "fbpage_nophoto_post WHERE contribute_id = '" . (int)$contribute_id . "' AND publish > '".$this->config->get('fbpage_initial_publish')."' ";
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
        $this->db->update("fbpage_nophoto_post",$where,array('locker' => 0));
    }

    public function setTempLocker($contribute_id,$user_id=false){
        $value = $user_id ? (int)$user_id : (int)$this->user->getId();
        $this->db->update("fbpage_nophoto_post",array('contribute_id' =>(int)$contribute_id),array('locker' =>$value));
    }
    
    public function editContribute($data,$mode='modified'){  

        if(!isset($data['contribute_id'])){return false;}
        $info = $this->getContribute($data['contribute_id']);
        if(!$info){return false;}
        $log = $fields = $where = array();
        $where['contribute_id'] = (int)$data['contribute_id'];
        $fields['date_modified'] = date('Y-m-d H:i:s');
        $fields['user_id'] = $this->user->getId();
        switch (strtolower($mode)) {
            case 'modified':
                if(!empty($data['entry_modified']) && !empty($data['entry_sn'])){
                    $fields['entry_sn'] = $data['entry_sn'];
                }            
                if(isset($data['publish']) && $data['publish'] !==false ){
                    $fields['publish'] = (int)$data['publish'];
                    $log['post'] = (int)$data['publish'];
                }
                if(!empty($data['url_modified']) && !empty($data['target_url'])){
                    $fields['url_modified'] = 1;
                    $fields['target_url'] = $data['target_url'];
                }
                if(!empty($data['content_modified']) && !empty($data['content'])){
                    $fields['content'] = $data['content'];
                }
                if(!empty($data['expired_modified']) && !empty($data['expired'])){
                    $fields['expired'] = $data['expired'];
                }
                if(!empty($data['note'])){
                    $fields['note'] = $data['note'];
                }
                $this->db->update("fbpage_nophoto_post",$where, $fields);
                break;
            case 'init':
                $this->db->update("fbpage_nophoto_post",$where,array('url_modified' => 0));
                if( $info['publish'] != $this->config->get("fbpage_testing_publish") ){
                    //$log['post'] = 2;
                }
                break;
            case 'bulk':
                if(isset($data['publish']) ){
                    $fields['publish'] = (int)$data['publish'];
                    if($info['publish'] != $data['publish']){
                        $log['post'] = (int)$data['publish'];   
                    }
                }
                if(isset($data['status']) ){
                    $fields['status'] = (int)$data['status'];
                    if($info['status'] != $data['status']){
                        $log['edit'] = (int)$data['status'];    
                    }
                    if(!isset($data['publish'])){
                        if(in_array($data['status'], $this->config->get("fbpage_level_status")) 
                            && $info['publish'] != $this->config->get("fbpage_testing_publish") ){
                            $fields['publish'] = $this->config->get("fbpage_testing_publish");
                            $log['post'] = $this->config->get("fbpage_testing_publish");
                        }
                    }
                }
                $this->db->update("fbpage_nophoto_post",$where, $fields);
                if(isset($data['status'])){
                    $where['post_type'] = $this->post_type ;
                    $tmp = array(
                        'status'    => (int)$data['status'],
                        'amount'    => getContributeAmount($this->post_type,$data['status']),
                        'user_id'   => (int)$this->user->getId(),
                        'date_added'=> date('Y-m-d H:i:s')
                    );
                    $this->db->update("sns_balance",$where,$tmp);
                }
                break;
            case 'expired':
                $condition = array();
                $condition[] = " `contribute_id` = '".(int)$data['contribute_id']."' ";
                $condition[] = " `expired` > 0";
                $query = $this->db->query("SELECT DATEDIFF(NOW() ,MAX(date_added)) is_expired  FROM ".DB_PREFIX."fbpage_nophoto_post_history WHERE ".implode(" AND ", $condition));
                if(isset($query->row['is_expired']) && (int)$query->row['is_expired'] > 0){
                    $this->db->update("fbpage_nophoto_post",$where,array('publish' => $this->config->get("fbpage_expired_publish")));
                    if($info['publish']!=$this->config->get("fbpage_expired_publish")){
                        $log['post'] = (int)$this->config->get("fbpage_expired_publish");
                    }
                }   
                break;
        }
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
                    $this->db->insert('fbpage_nophoto_post_history',$tmp); 
                }
            }
        }
    }

    public function getHistories($contribute_id,$start=0,$limit=20){
        $sql = "SELECT h.*,u.nickname FROM ".DB_PREFIX."fbpage_nophoto_post_history h LEFT JOIN ".DB_PREFIX."user u ON h.user_id = u.user_id WHERE h.contribute_id = '".(int)$contribute_id."' ORDER BY h.date_added DESC LIMIT " . (int)$start. "," . (int)$limit;
        $query = $this->db->query($sql);
    
        return $query->rows;
    }

    public function getTotalHistory($contribute_id){
        $query = $this->db->query("SELECT COUNT(history_id) total FROM ".DB_PREFIX."fbpage_nophoto_post_history WHERE contribute_id = '".(int)$contribute_id."'");
        return $query->row['total'];
    }
    
}