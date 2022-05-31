<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Brands_model extends BaseModel
	{
		protected $tblname = 'brands';

		public function __construct()
		{
			parent::__construct();
		}
        public function getBrends_product() {
            return $this->db->select([
                'id',
                'title',
            ])
                ->where('isShown', 1)
                ->order_by('sorder ASC, id DESC')->get($this->tblname)->result();
        }

		public function getBrands($tree=true) {
			$brands = $this->db->select('id, title, parent_id, step')->where('isShown', 1)->order_by('sorder ASC, id DESC')->get($this->tblname)->result();
			if ($tree) {
				$tree_array = [];
				foreach ($brands as $key => $brand) {
					$products = $this->db->select('COUNT(id) AS count')->where('brand_id', $brand->id)->from('products_models')->get()->row();
					if ($products->count == 0)
						unset($brands[$key]);
					else
						$tree_array[$key] = $this->getTree($brand->id);
				}

				if (!empty($tree_array))
					$brands = reorder($tree_array);
				else
					$brands = [];
			}

			return $brands;
		}

		public function getTree($brand_id) {
			$item = $this->db->select('title, parent_id, step, id')->where('id', $brand_id)->get($this->tblname)->row();
			if ($item->parent_id != 0)
				$tree = $this->getParent($item->parent_id);

			$tree[$item->step]['title'] = $item->title;
			$tree[$item->step]['id'] = $item->id;
			return $tree;
		}

		private function getParent($parent_id) {
			$result = [];
			$parent = $parent_id;

			while ($parent > 0) {
				$item = $this->db->select('step, title, parent_id')->where('id', $parent)->get($this->tblname)->row();
				$result[$item->step] = $item->title;
				$parent = $item->parent_id;
			}

			return $result;
		}

        public function get_brand_by_uri($lang, $url){
            if (empty($lang)) return false;
            $this->db->select("
            id as id,
            title as title,
            text$lang as text,
            uri as url,
            img as img,
            seoTitle$lang as otitle,
            seoKeywords$lang as keywords,
            seoDesc$lang as description,
        ");
            $this->db->where('isShown', 1);
            $this->db->where('uri'.$lang, $url);
            $this->db->order_by('sorder ASC, id DESC');
            return $this->db->get($this->tblname)->row();
        }

        public function get_brand($lang){
            if (empty($lang)) return false;
            $this->db->select("
            id as id,
            title as title,
            uri as uri,
            img as img,
        ");
            $this->db->where('isShown', 1);
            $this->db->order_by('sorder ASC, id DESC');
            return $this->db->get($this->tblname)->result();
        }

        public function get_brand_footer($lang){
            if (empty($lang)) return false;
            $this->db->select("
            id as id,
            title as title,
            uri as uri,
            img as img,
        ");
            $this->db->where('isShown', 1);
            $this->db->limit(6);
            $this->db->order_by('sorder ASC, id DESC');
            return $this->db->get($this->tblname)->result();
        }

        public function get_brand_by_id($id){
            $this->db->select("
            id as id,
            title as title,
        ");
            $this->db->where('isShown', 1);
            $this->db->where('id', $id);
            $this->db->order_by('sorder ASC, id DESC');
            return $this->db->get($this->tblname)->row();
        }
	}