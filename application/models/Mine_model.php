<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mine_model extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function delete_photo($tblname = false, $column = '', $id = false, $path = '')
    {
        if (empty($tblname) || empty($id)) return false;

        $column = (empty($column)) ? 'img' : $column;
        $old = $this->db->where('id', $id)->get($tblname)->row();
        if (!empty($old->{$column})) {
            $files = recDirSearch($_SERVER['DOCUMENT_ROOT'] . '/public/' . $path . '/', $old->{$column});
            foreach ($files as $file) {
                unlink($file);
            }
        }
        return $this->db->where('id', $id)->update($tblname, array($column => ''));

    }

    public function delete_file($tblname = false, $lang = false, $id = false)
    {
        if (empty($tblname) || empty($lang) || empty($id)) return false;

        $file = $lang;
        $id = (int)$id;

        return $this->db->where('id', $id)->update($tblname, array($file => ''));
    }

    public function change_select($tblname = false, $id = false, $value = false, $col = false)
    {
        if (empty($tblname) || empty($id) || empty($value) || empty($col)) return false;

        $id = (int)$id;
        $value = (int)$value;

        return $this->db->where('id', $id)->update($tblname, array($col => $value));
    }

    public function change_check($tblname = false, $id = false, $value = false, $col = false)
    {
        if (empty($tblname) || empty($id) || empty($col)) return false;

        $id = (int)$id;
        $value = (bool)$value;

        return $this->db->where('id', $id)->update($tblname, array($col => $value));
    }

    public function change_check_null($tblname = false, $id = false, $value = false, $col = false)
    {
        if (empty($tblname) || empty($id) || empty($col)) return false;

        $id = (int)$id;
        $value = 0;
        $this->db->select("
            id as id,
        ");
        $id_null = $this->db->where($col, 1)->get($tblname)->row();
        if (isset($id_null)) {
            $this->db->where('id', $id_null->id)->update($tblname, array($col => $value));
            return $id_null->id;
        }
        return false;
    }

    public function change_check_guid($tblname = false, $id = false, $value = false, $col = false)
    {
        if (empty($tblname) || empty($id) || empty($col)) return false;

        $id = (int)$id;
        $guid = GUID();
        $value = (bool)$value;
        return $this->db->where('id', $id)->update($tblname, array($col => $value, 'GUID' => $guid));
    }

    public function change_check_fire($tblname = false, $id = false, $value = false, $col = false)
    {
        if (empty($tblname) || empty($id) || empty($col)) return false;

        $id = (int)$id;
        $value = (bool)$value;
        return $this->db->where('id', $id)->update($tblname, array($col => $value,));
    }
}