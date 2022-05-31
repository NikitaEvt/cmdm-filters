<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Articles_model extends BaseModel
	{
		protected $tblname = 'articles';

		public function __construct()
		{
			parent::__construct();
		}

		public function find_by_date(){
            $this->db->select("*");
            $this->db->order_by('date DESC, ID DESC');
            return $this->db->get($this->tblname)->result();
        }

        public function get_home_articles($lang){
            $this->db->select("
            id as id,
            title$lang as title,
            desc$lang as desc,
            uri$lang as uri,
            img as img,
            date as date,
        ");
            $this->db->where('isShown', 1);
            $this->db->order_by('date DESC, ID DESC');
            return $this->db->get($this->tblname)->result();
        }

        public function get_news_all()
        {
            $this->db->select("id");
            $this->db->where('isShown', 1);
            return $this->db->get($this->tblname)->result();
        }

        public function get_news_pag($lang,$offset,$limit)
        {
            if (empty($lang)) {
                return false;
            }
            $this->db->select("
            id as id,
            title$lang as title,
            uri$lang as uri,
            desc$lang as desc,
            img as img,
            date as date,
        ");
            $this->db->where('isShown', 1);
            $this->db->offset($offset);
            $this->db->limit($limit);
            $this->db->order_by("date DESC, id DESC");
            return $this->db->get($this->tblname)->result();

        }
        public  function get_news_uri($lang, $uri)
        {

            $this->db->select("
            id as id,
            title$lang as title,
            desc$lang as desc,
            text$lang as text,
            uri$lang as uri,
            uriRU as uriRU,
            uriRO as uriRO,
            uriEN as uriEN,
            img as img,
            date as date,
            seoTitle$lang as otitle,
            seoKeywords$lang as keywords,
            seoDesc$lang as description,
        ");
            $this->db->where('uri' . $lang, $uri);
            $this->db->order_by("sorder ASC, id DESC");
            return $this->db->get($this->tblname)->row();
        }
	}