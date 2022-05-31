<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Home_video_model extends BaseModel
    {
        protected $tblname = 'home_video';

        public function __construct()
        {
            parent::__construct();
        }
        public function get_home_video($lang){
            $this->db->select("
            id as id,
            title$lang as title,
            url$lang as url,
            img as img,
        ");
            $this->db->where('isShown', 1);
            $this->db->order_by('sorder ASC, ID DESC');
            return $this->db->get($this->tblname)->result();
        }
    }
