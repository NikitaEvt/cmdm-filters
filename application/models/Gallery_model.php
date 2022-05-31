<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_model extends BaseModel
{
    protected $tblname = 'gallery';

    public function __construct()
    {
        parent::__construct();
    }

    public function findFirst($id)
    {
        $id = (int)$id;
        $item = $this->db->where('id', $id)->get($this->tblname)->row();
        $item->images = $this->db->where('gallery_id', $id)->order_by('sorder ASC, id DESC')->get('gallery_img')->result();
        return $item;
    }

    public function get_gallereis($lang = false)
    {
        if (empty($lang)) {
            return false;
        }
        $this->db->select("
            id as id,
            title$lang as title,
            uri$lang as uri
        ");
        $this->db->where('isShown', 1);
        $this->db->order_by('sorder ASC, ID DESC');
        $items =  $this->db->get($this->tblname)->result();
        foreach ($items as $item){
            $item->images = $this->db->where('gallery_id', $item->id)->order_by('sorder ASC, id DESC')->get('gallery_img')->result();
        }
        return $items;
    }

}
