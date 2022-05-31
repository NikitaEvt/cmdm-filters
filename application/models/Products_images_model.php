<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Products_images_model extends BaseModel
	{
		public $tblname = 'products_img';

		public function __construct()
		{
			parent::__construct();
		}
        public function getImages($id)
        {
            $this->db->select("
            id as id,
            product_id as product_id,
            img as img,
        ");
            $this->db->where("product_id", $id);
            $this->db->order_by('sorder ASC, id DESC');
            return $this->db->get($this->tblname)->row();
        }
        public function getImagesAll($id)
        {
            $this->db->select("
            id as id,
            product_id as product_id,
            img as img,
        ");
            $this->db->where("product_id", $id);
            $this->db->order_by('sorder ASC, id DESC');
            return $this->db->get($this->tblname)->result();
        }
	}