<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Slider_model extends BaseModel
	{
		protected $tblname = 'slider';

		public function __construct()
		{
			parent::__construct();
		}

        public function get_front_slider($lang = 'EN'){
            if (empty($lang)) return false;

            $lower = strtolower($lang);

            $this->db->select("
            id as id,
            title$lang as title,
            url$lang as url,
            img$lang as img,
            subtitle$lang as subtitle,
            color as color,
            text_alight as text_alight,
        ");
            $this->db->where('isShown', 1);
            $this->db->order_by('sorder ASC, id DESC');
            return $this->db->get($this->tblname)->result();
        }
	}