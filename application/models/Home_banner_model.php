<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Home_banner_model extends BaseModel
    {
        protected $tblname = 'home_banner';

        public function __construct()
        {
            parent::__construct();
        }

        public function get_home_banner($lang = false)
        {
            if (empty($lang)) {
                return false;
            }
            $this->db->select("
            id as id,
            title$lang as title,
            subtitle$lang as desc,
            url$lang as url,
            img$lang as img
        ");
            $this->db->where('isShown', 1);
            $this->db->order_by('sorder ASC, ID DESC');
            return $this->db->get($this->tblname)->result();
        }
    }
