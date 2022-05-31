<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseModel extends CI_Model
{
    protected $tblname = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function find()
    {
        $query = $this->db->order_by('sorder ASC, id DESC')->get($this->tblname);

        return $query->result();
    }

    public function findFirst($id)
    {
        $id = (int)$id;

        $query = $this->db->where('id', $id)->get($this->tblname);

        return $query->row();
    }

    public function put($data = false)
    {
        if (empty($data)) {
            return false;
        }

        $this->db->insert($this->tblname, $data);
        return $this->db->insert_id();
    }

    public function update($data = false, $id = false)
    {
        if (empty($data) || empty($id)) {
            return false;
        }
        return $this->db->where('id', $id)->update($this->tblname, $data);
    }

    public function update_sorder($data = false)
    {
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

    public function delete($id = false)
    {
        if (empty($id)) {
            return false;
        }

        $id = (int) $id;

        return $this->db->delete($this->tblname, array('id' => $id));
    }

	public function init_pagination($total_rows, $per_page, $url) {
		$this->load->library('pagination');
		$config['base_url'] = $url;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['first_link'] = $config['last_link'] = $config['next_link'] = $config['prev_link'] = false;
		$config['cur_tag_open'] = '<a>';
		$config['cur_tag_close'] = '</a>';

		$this->pagination->initialize($config);

		return $this->pagination->create_links();
	}
    public function select_max_sorder() {
        $this->db->select_max('sorder');
        return $this->db->get($this->tblname)->row();
    }

    public function deleteByField($field = null, $value = null)
    {
        if(is_array($field)) {
            return $this->db->delete($this->tblname, $field);
        } elseif (empty($field) || empty($value)) {
            return false;
        }

        return $this->db->delete($this->tblname, array($field => $value));
    }
    public function getByField($field, $value = null, $all = false, $order = null, $by = 'ASC', $limit = null, $type = '') {
        if(is_array($field)) {
            $this->db->where($field);
        } else {
            $this->db->where($field, $value);
        }

        if($order) {
            $this->db->order_by($order.' '.$by);
        }

        if($limit) {
            $this->db->limit($limit);
        }

        if ($all) {
            if($type == 'array') {
                return $this->db->get($this->tblname)->result_array();
            } else {
                return $this->db->get($this->tblname)->result();
            }
        } else {
            if($type == 'array') {
                return $this->db->get($this->tblname)->row_array();
            } else {
                return $this->db->get($this->tblname)->row();
            }
        }
    }
}