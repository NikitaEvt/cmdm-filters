<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Import extends FrontEndController
{


    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (empty($page)) throw_on_404();
    }

    public function products()
    {
        $file = realpath('public') . '/import/products2.csv';
        if (file_exists($file)) {
            $csv = array_map('str_getcsv', file($file));

            $insert_batch =array();
            if (!empty($csv)){
                unset($csv[0]);
                foreach ($csv as $item){
                    $data =array();
/*                    $data['id'] = $item[0];
                    $data['SKU'] = $item[1];
                    $data['titleRU'] = $this->get_string_between($item[2],'[:ru]','[:ro]');
                    $data['titleRO'] = $this->get_string_between($item[2],'[:ro]','[:]');
                    $data['descRU'] = str_replace('\n','',$this->get_string_between($item[3],'[:ru]','[:ro]'));
                    $data['descRO'] = str_replace('\n','',$this->get_string_between($item[3],'[:ro]','[:]'));
                    $data['textRU'] = str_replace('\n','',$this->get_string_between($item[4],'[:ru]','[:ro]'));
                    $data['textRO'] = str_replace('\n','',$this->get_string_between($item[4],'[:ro]','[:]'));
                    $data['price'] = $item[5];
                    $data['category_title'] = $item[6];
                    $data['img'] = $item[7];
                    $data['uriRU'] = transliteration($data['titleRU']);
                    $data['uriRO'] = transliteration($data['titleRO']);*/
                    $data['id'] = $item[0];
                    $data['category_title'] = $item[2];
                    $insert_batch[]=$data;
                }
//                $this->db->insert_batch('products', $insert_batch);
//                $this->db->update_batch('products', $insert_batch, 'id');
            }
        }
    }

    public function categories()
    {
        $file = realpath('public') . '/import/categories.csv';
        if (file_exists($file)) {
            $csv = array_map('str_getcsv', file($file));

            $insert_batch =array();
            if (!empty($csv)){
                unset($csv[0]);
                foreach ($csv as $item){
                    $data =array();
                    $data['id'] = $item[0];
                    $data['parent_id'] = $item[4];
                    if (!empty($data['parent_id'])){
                        $data['step'] = 1;
                    } else {
                        $data['step'] = 0;
                    }
                    $data['titleRU'] = $item[1];
                    $data['titleRO'] = $item[1];
                    $data['descRU'] = str_replace('\n','',$this->get_string_between($item[12],'[:ru]','[:ro]'));
                    $data['descRO'] = str_replace('\n','',$this->get_string_between($item[12],'[:ro]','[:]'));
                    $data['img'] = $item[14];
                    $data['uriRU'] = transliteration($data['titleRU']);
                    $data['uriRO'] = transliteration($data['titleRO']);
                    $insert_batch[]=$data;
                }
//                $this->db->insert_batch('categories', $insert_batch);
            }
        }
    }

    public function products_cat()
    {
        $products = $this->db->select('id, SKU, category_id, category_title')->get('products')->result();
        if (!empty($products)) {
            $insert_batch =array();
                foreach ($products as $item){
                    $data =array();
                    $category = '';
                    $category_title = explode(">", $item->category_title);
                    if (!empty($category_title[1])){
                        $category_title[1] = explode("|", $category_title[1]);
                        $category = $category_title[1][0];
                    } else {
                        $category = $category_title[0];
                    }
                    $category = $this->db->select('id')->where('titleRU', $category)->get('categories')->row();
                    if (!empty($category)){
                        $data['category_id'] = $category->id;
                        $data['id'] = $item->id;
                    } else {
                        $data['category_id'] = 0;
                        $data['id'] = $item->id;
                    }
                    $insert_batch[]=$data;
                }
//            dump($insert_batch);
                $this->db->update_batch('products', $insert_batch, 'id');
            }
    }

    function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}
