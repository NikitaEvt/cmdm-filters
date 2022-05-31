<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends BaseModel
{
    protected $tblname = 'categories';

    public function __construct()
    {
        parent::__construct();
    }

    public function getCategories($lang = 'RU')
    {
        return $this->db->select(['id', 'titleRU AS title', 'parent_id', 'uri' . $lang . ' AS uri', 'parent_id', 'step'])->where(['isShown' => 1])->order_by('sorder ASC, id DESC')->get($this->tblname)->result();
    }

    public function get_category_parents()
    {
        $this->db->select("            id as id,            titleRU as titleRU,            parent_id as parent_id,        ");
        $this->db->where('isShown', 1);
        $this->db->where('step', 1);
        $this->db->order_by('sorder ASC, id DESC');
        return $this->db->get($this->tblname)->result();
    }

    public function get_front_сategories($lang)
    {
        if (empty($lang)) return false;
        $lower = strtolower($lang);
        $this->db->select("            id as id,            title$lang as title,            url$lower as url,            img$lower as img,        ");
        $this->db->where('isShown', 1);
        $this->db->order_by('sorder ASC, id DESC');
        return $this->db->get($this->tblname)->result();
    }

    public function get_categories_perent($lang)
    {
        $this->db->select("            id as id,            title$lang as title,            uri$lang as url,        ");
        $this->db->where('isShown', 1);
        $this->db->where('step', 1);
        $this->db->order_by('sorder ASC, id DESC');
        $parent_category = $this->db->get($this->tblname)->result();
        if (!empty($parent_category)){
            foreach ($parent_category as $item){
                $this->db->select("            id as id,            title$lang as title,            uri$lang as url,        ");
                $this->db->where('isShown', 1);
                $this->db->where('parent_id', $item->id);
                $this->db->order_by('sorder ASC, id DESC');
                $item->children = $this->db->get($this->tblname)->result();
            }
        }
        return $parent_category;
    }

    public function get_categories_by_id($lang, $id)
    {
        if (empty($lang)) return false;
        $this->db->select("            id as id, step as step,            parent_id as parent_id,        uri$lang as uri,           title$lang as title,        ");
        $this->db->where('id', $id);
        return $this->db->get($this->tblname)->row();
    }

    public function get_categories_cildren($lang, $id)
    {
        if (empty($lang)) return false;
        $this->db->select("            id as id,            parent_id as parent_id,            uri$lang as uri,            title$lang as title,     img as img,    ");
        $this->db->where('parent_id', $id);
        $this->db->order_by('sorder ASC, id DESC');
        return $this->db->get($this->tblname)->result();
    }

    public function get_categories_by_uri($lang, $url)
    {
        if (empty($lang)) return false;
        $this->db->select("
            id as id,
            parent_id as parent_id,
            step as step,
            title$lang as title,
            desc$lang as desc,
            desc$lang as text,
            uri$lang as uri,
            uriRU as uriRU,
            uriRO as uriRO,
            uriEN as uriEN,
            img as img,
            seoTitle$lang as otitle,
            seoKeywords$lang as keywords,
            seoDesc$lang as description,
        ");
        $this->db->where('uri' . $lang, $url);
        $this->db->order_by('sorder ASC, id DESC');
        return $this->db->get($this->tblname)->row();
    }

    public function get_home_categories($lang)
    {
        if (empty($lang)) return false;
        $this->db->select("
            id as id,
            title$lang as title,
            desc$lang as desc,
            uri$lang as uri,
            img as img,
        ");
        $this->db->where('isShown', 1);
        $this->db->where('home_views' , 1);
        $this->db->order_by('sorder ASC, id DESC');
        return $this->db->get($this->tblname)->result();
    }

    public function get_categories_all($lang)
    {
        if (empty($lang)) return false;
        $this->db->select("
            id as id,
            parent_id as parent_id,
            title$lang as title,
            uri$lang as uri,
        ");
        $this->db->where('isShown', 1);
        $this->db->order_by('sorder ASC, id DESC');
        return $this->db->get($this->tblname)->result();
    }

    public function get_list_categories($lang)
    {
        if (empty($lang)) return false;
        $this->db->select("
            id as id,
            parent_id as parent_id,
            title$lang as title,
            uri$lang as uri,
        ");
        $this->db->where('isShown', 1);
        $this->db->order_by('sorder ASC, id DESC');
        return $this->db->get($this->tblname)->result();
    }

    public function get_categories_arr($id)
    {
        if (empty($id)) return false;
        $categories_arr = array();
        $categories_arr[0] = $id;
        $this->db->select("id, parent_id");
        $this->db->where('parent_id', $id);
        $this->db->where('isShown', 1);
        $this->db->order_by('sorder ASC, id DESC');
        $categories_tree = $this->db->get($this->tblname)->result();
        if (!empty($categories_tree)){
            $categories_arr = categories_tree_parts($this->db ,$categories_tree, $categories_arr);
        }
        return $categories_arr;
    }

}