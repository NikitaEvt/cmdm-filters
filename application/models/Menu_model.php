<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends BaseModel
{
    protected $tblname = 'menu';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_page_data($uri = false, $lang = false)
    {
        if (empty($uri) || empty($lang)) {
            return false;
        }

        $this->db->select("
            id as id,
            title$lang as title,
            desc$lang as desc,
            text$lang as text,
            seoTitle$lang as otitle,
            seoKeywords$lang as keywords,
            seoDesc$lang as description,
            uri$lang as uri,
            uriRU as uriRU,
            uriEN as uriEN,
            isShown as isShown,
            sorder as sorder,
            onTop as onTop,
            onBottom as onBottom,
            img as img
        ");
        $this->db->where("uri$lang", $uri);
        return $this->db->get('menu')->row();
    }

    public function get_page_data_by_id($id = false, $lang = false)
    {
        if (empty($lang) || empty($id)) {
            return false;
        }

        $id = (int) $id;

        $this->db->select("
            id as id,
            title$lang as title,
            desc$lang as desc,
            text$lang as text,
            seoTitle$lang as otitle,
            seoKeywords$lang as keywords,
            seoDesc$lang as description,
            uri$lang as uri,
            uriRU as uriRU,
            uriEN as uriEN,
            uriRO as uriRO,
            isShown as isShown,
            sorder as sorder,
            onTop as onTop,
            onBottom as onBottom,
            img as img
        ");
        $this->db->where('id', $id);
        return $this->db->get('menu')->row();
    }

    public function get_page_data_by_url($url = false, $lang = false)
    {
        if (empty($lang) || empty($url)) {
            return false;
        }

        $this->db->select("
            id as id,
            title$lang as title,
            desc$lang as desc,
            text$lang as text,
            seoTitle$lang as otitle,
            seoKeywords$lang as keywords,
            seoDesc$lang as description,
            uri$lang as uri,
            uriRU as uriRU,
            uriEN as uriEN,
            isShown as isShown,
            sorder as sorder,
            onTop as onTop,
            onBottom as onBottom,
            img as img
        ");
        $this->db->where('uri'.$lang, $url);
        return $this->db->get('menu')->row();
    }

    public function getMenu($lang)
    {
        if (empty($lang)) return false;

        $this->db->select("
            id as id,
            sorder as sorder,
            title$lang as title,
            uri$lang as uri,
            onTop as onTop,
            onBottom as onBottom,
        ");
        $this->db->where('isShown', 1);
        $this->db->order_by('sorder ASC, ID DESC');
        $data = $this->db->get('menu')->result();

        $arr = array();
        $response = array();
        $response['top'] = array();
        $response['bottom'] = array();
        $response['all'] = array();
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $arr[$value->id] = $value;
            }
            $data = $arr;
            foreach ($data as $key => $value) {
                if ($value->onTop == 1) $response['top'][$key] = $data[$key];
            }
            foreach ($data as $key => $value) {
                if ($value->onBottom == 1) $response['bottom'][$key] = $data[$key];
            }
        }

        $response['all'] = $data;

        return $response;
    }
}
