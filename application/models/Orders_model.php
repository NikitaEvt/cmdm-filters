<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Orders_model extends BaseModel
	{
		protected $tblname = 'orders';

		public function __construct()
		{
			parent::__construct();
		}

		public function find() {
			$items = $this->db->select([ '*'
			])
				->order_by($this->tblname.'.added DESC, '.$this->tblname.'.id DESC')->get($this->tblname)->result();
			return $items;
		}

		public function findFirst($id)
		{
			$item = $this->db->select(['*'])->where('id', $id)
				->order_by($this->tblname.'.added ASC, '.$this->tblname.'.id DESC')->get($this->tblname)->row();
			return $item;
		}

		public function orderProducts($id, $lang) {

			$products = $this->db->select(['*
			'])->where('order_id', $id)->get('orders_products')->result();

			foreach ($products as $key => $product) {
				$products[$key]->product = $this->db->select('uri'.$lang.' AS uri, title'.$lang.' AS title')->where('id', $product->product_id)->get('products')->row();
			}
			return $products;
		}
        public function date_time($data_time) {
            return $this->db->select('*')->where('id', $data_time)->get('delivery')->row();
        }
        public function region_order($region_id) {
            return $this->db->select('*')->where('id', $region_id)->get('regions')->row()->titleRO;
        }
        public function date_time_map($data_time_map) {
            return $this->db->select('*')->where('id', $data_time_map)->get('store_orders')->row();
        }
        public function stor_delivery($id) {
            return $this->db->select('*')->where('id', $id)->get('stores')->row();
        }
        public function client_name($id) {
            return $this->db->select('name')->where('id', $id)->get('clients')->row();
        }
		public function count() {
			return $this->db->select('COUNT(id) AS count')->where('status', 'new')->get($this->tblname)->row()->count;
		}


		public function getDetails($id, $lang) {
			$products = $this->db->select('product_id')->from($this->tblname.'_products')->where('order_id', $id)->get()->result();
			$this->load->model('catalog_model', 'products');

			foreach ($products as $product)
				$products_ids[] = $product->product_id;

			$products = $this->products->getByIDs($products_ids, $lang);

			return $products;
		}


		public function putDeliveryMethod($data = false)
		{
			if (empty($data)) {
				return false;
			}

			return $this->db->insert($this->tblname, $data);
		}

		public function updateSorderStandart($data = false) {
			if (empty($data)) {
				return false;
			}

			foreach ($data as $id => $sorder) {
				if (!$this->db->where('id', $id)->update($this->tblname, array('sorder' => $sorder))) {
					return false;
				}
			}

			return true;
		}

		public function findFirstStandart($id = false) {
			$id = (int)$id;
			$query = $this->db->where('id', $id)->get($this->tblname);
			return $query->row();
		}
		
        public function stor_title($id) {
             if (empty($id)) return false;
            $this->db->select("titleRO as title,id
            ");
            $this->db->where('id', $id);
            return $this->db->get('stores')->row();
        }
        
		public function updateStandart($data = false, $id = false) {
			if (empty($data) || empty($id)) {
				return false;
			}

			return $this->db->where('id', $id)->update($this->tblname, $data);
		}

		public function changeTable($newtable = '', $continue = false) {
			if (!empty($newtable))
				$this->tblname = $newtable;

			if ($continue)
				return $this;
		}
	}