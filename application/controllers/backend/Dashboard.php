<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends BackEndController
{
    public function __construct()
    {
        parent::__construct(__CLASS__);
        $this->load->model('mine_model');
    }

    public function delete_photo()
    {
        check_if_POST();

        $tblname = $this->input->post('table');
        $id = $this->input->post('id');
        $column = $this->input->post('column');
        $tb_img = $this->input->post('tb');

        if (empty($column)) $column = 'img';
        $path = (!empty($this->input->post('path'))) ? $this->input->post('path') : $tblname;

        $result = ($this->mine_model->delete_photo($tblname, $column, $id, $path)) ? 200 : 500;
        if (!empty($tb_img))
        {
            $this->db->where('id', $id);
            $this->db->delete($tblname);
        }
        $response['status'] = $result;

        echo json_encode($response);
        exit();
    }

    public function delete_img_row()
    {
        check_if_POST();

        $tblname = $this->input->post('table');
        $id = $this->input->post('id');
        $model = $tblname . '_model';
        $this->load->model($model);

        $result = ($this->$model->delete($id)) ? 200 : 500;

        $response['status'] = $result;

        echo json_encode($response);
        exit();

    }

    public function delete_file()
    {
        check_if_POST();

        $tblname = $this->input->post('table');
        $id = $this->input->post('id');
        $lang = $this->input->post('lang');

        $result = ($this->mine_model->delete_file($tblname, $lang, $id)) ? 200 : 500;

        $response['status'] = $result;

        echo json_encode($response);
        exit();
    }

    public function change_select()
    {
        check_if_POST();

        $tblname = $this->input->post('table');
        $id = $this->input->post('id');
        $value = $this->input->post('value');
        $col = $this->input->post('col');

        $result = ($this->mine_model->change_select($tblname, $id, $value, $col)) ? 200 : 500;

        $response['status'] = $result;

        echo json_encode($response);
        exit();
    }

    public function change_check()
    {
        check_if_POST();

        $tblname = $this->input->post('table');
        $id = $this->input->post('id');
        $value = $this->input->post('value');
        $col = $this->input->post('col');

        $result = ($this->mine_model->change_check($tblname, $id, $value, $col)) ? 200 : 500;

        $response['status'] = $result;

        echo json_encode($response);
        exit();
    }


}