<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_feature_model extends BaseModel
{
    protected $tblname = 'shop_feature';
    protected $tblname_values = 'shop_feature_values';

    public function __construct()
    {
        parent::__construct();
    }

    public function features($type = 'all', $with_values = false) {
        if(is_null($type)) return array();

        if(is_numeric($type)) {
            $this->db->where('type_id', $type);
        }
        // $this->db->order_by('is_brand DESC');
        // $this->db->order_by('sorder ASC, id ASC');
         $this->db->order_by('id ASC');
        $result = $this->db->get($this->tblname)->result_array();

        $features = array();
        if($result) {
            foreach($result as $res) {
                $features[$res['id']] = $res;
                if($with_values) {
                    $this->db->where('feature_id', $res['id']); 
                    $this->db->order_by('id ASC'); 
                    $features[$res['id']]['values'] = $this->db->get($this->tblname_values)->result_array();
                }
            }
        }

        return $features;
    }

    public function getColumns($columns, $lang = 'RU') {
        $this->db->where_in('id', $columns);
        $this->db->order_by('sorder ASC');
        $result = $this->db->get($this->tblname)->result_array();

        $features = array();
        if($result) {
            foreach($result as $res) {
                $features[$res['id']] = $res['name_'.$lang];
            }
        }

        return $features;
    }
}
