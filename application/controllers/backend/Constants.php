<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Constants extends  BackEndController
{
    public function __construct()
    {
        parent::__construct(__CLASS__);
    }

    public function index()
    {
        $main_page = 'constants';
        $title = 'Константы';

        $this->load->model('constants_model');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ru = $this->input->post('ru', FALSE);
            $ro = $this->input->post('ro', FALSE);
            $en = $this->input->post('en', FALSE);

            try {
                foreach ($ru as $id => $val) {
                    if (!$this->constants_model->update_ru($id, $val)) {
                        throw new Exception('Ошибка записи данных в таблицу: '.$main_page.' RU');
                    }

                }
                foreach ($ro as $id => $val) {
                    if (!$this->constants_model->update_ro($id, $val)) {
                        throw new Exception('Ошибка записи данных в таблицу: '.$main_page.' RO');
                    }

                }
                foreach ($en as $id => $val) {
                    if (!$this->constants_model->update_en($id, $val)) {
                        throw new Exception('Ошибка записи данных в таблицу: '.$main_page.' EN');
                    }
                }
                $constants = $this->constants_model->find();

                $_SESSION['success'] = 'Вы успешно обновили константы!';
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                $errors[] = 'Выброшено исключение : ' . $e->getMessage();
                $_SESSION['error'] = $errors;
            }
        }

        $constants = $this->constants_model->find();
        $constants_list = [];

        $groupes = [];
        if(!empty($constants)){
            foreach($constants as $element){
                $groupes[] = $element->groupes;
            }

            foreach(array_unique($groupes) as $groupe_name){
                // $arr['groupe'] = $groupe_name;
                $arr = [];
                foreach($constants as $element){
                    if($element->groupes == $groupe_name){
                        $arr[] = $element;
                    }
                }
                $constants_list[$groupe_name] = $arr;
            }
        }

        $data = array(
            'inner_view' => 'backend/' . $main_page . '/index',
            'constants' => $constants_list,
            'title' => $title
        );

        $this->load->vars($data);
        $this->load->view('backend/index');
    }
}
