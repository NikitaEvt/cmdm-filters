<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends BackEndController
{
    protected $add;
    protected $index_title;
    protected $title;
    protected $success_add;
    protected $success_update_order;
    protected $success_edit;
    protected $success_delete;

    public function __construct()
    {
        parent::__construct(__CLASS__);

        $this->add = 'Добавить производителя';
        $this->index_title = 'Производители';
        $this->success_add = 'Вы успешно добавили нового производителя!';
        $this->success_update_order = 'Вы успешно обновили порядок отображения!';
        $this->success_edit = 'Вы успешно обновили производителя!';
        $this->success_delete = 'Вы успешно удалили производителя!';

        $this->data['title'] = $this->index_title;
        $this->data['add'] = $this->add;
        $this->load->model('brands_model');
    }

    public function index()
    {
        init_load_img($this->main_page);

        $this->data['inner_view'] = $this->index_view;

        $objects = $this->brands_model->find();
        $this->data['objects'] = $objects;
        $this->data['list'] = categories_map($objects);

        $this->load->vars($this->data);
        $this->load->view($this->main_layout);
    }

    public function put()
    {
        check_if_POST();

        $post = array();

        init_load_img($this->main_page);

        try {
            foreach ($_POST as $index => $item) {
                $post[$index] = $this->input->post($index, TRUE);
            }

            foreach ($this->langs as $lang) {
                $post['uri'.$lang] = (!empty($post['title'])) ? transliteration($post['title']) : '';
            }
            if (!empty($parent_step))
                $post['step'] = !empty($parent_step) ? $parent_step->step + 1 : 1;
            else
                $post['step'] = 1;
            if (!empty($_FILES['img']['name'])) {
                $this->upload->do_upload('img');
                $file_data = $this->upload->data();
                $file = $file_data['file_name'];

                $file_types = array('.jpg', '.jpeg', '.gif', '.png');

                if (in_array(strtolower($file_data['file_ext']), $file_types)) {
                    $post['img'] = $file;
                }
            }

            $id = $this->brands_model->put($post);
            if (!$id) {
                throw new Exception('Ошибка записи данных в таблицу: ' . $this->main_page);
            }


            $_SESSION['success'] = $this->success_add;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            $errors[] = 'Выброшено исключение : ' . $e->getMessage();
            $_SESSION['error'] = $errors;
        }

        redirect($this->path);
    }

    public function update_order()
    {
        check_if_POST();

        try {
            $post = $this->input->post('so');

            if (empty($post) || !is_array($post)) {
                throw new Exception('Ошибка в полученных данных!');
            }

            if (!$this->brands_model->update_sorder($post)) {
                throw new Exception('Ошибка записи данных в таблицу: ' . $this->main_page);
            }

            $_SESSION['success'] = $this->success_update_order;
        } catch (Exception $e) {
            $errors[] = 'Выброшено исключение : ' . $e->getMessage();
            $_SESSION['error'] = $errors;
        }

        redirect($this->path);
    }

    public function item($id = 0)
    {
        $id = (int)$id;

        init_load_img($this->main_page);

        $item = $this->brands_model->findFirst($id);

        if (empty($item)) throw_on_404();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                foreach ($_POST as $index => $post_data) {
                    $post[$index] = $this->input->post($index, TRUE);
                }

                foreach ($this->langs as $lang) {
                    $post['uri'.$lang] = (!empty($post['title'])) ? transliteration($post['title']) : '';
                }

                if (!empty($_FILES['img']['name'])) {
                    $this->upload->do_upload('img');
                    $file_data = $this->upload->data();
                    $file = $file_data['file_name'];

                    $file_types = array('.jpg', '.jpeg', '.gif', '.png');

                    if (in_array(strtolower($file_data['file_ext']), $file_types)) {
                        $post['img'] = $file;
                    }
                }
                if (!$this->brands_model->update($post, $id)) {
                    throw new Exception('Ошибка записи данных в таблицу: ' . $this->main_page);
                }

                $_SESSION['success'] = $this->success_edit;
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                $errors[] = 'Выброшено исключение : ' . $e->getMessage();
                $_SESSION['error'] = $errors;
            }

            $item = $this->brands_model->findFirst($id);
        }

        $this->data['inner_view'] = $this->item_view;
        $this->data['title'] = 'Редактирование ' . $item->title;
        $this->data['parent_url'] = $this->path;
        $this->data['parent_title'] = $this->index_title;
        $this->data['item'] = $item;

        $objects = $this->brands_model->find();
        $this->data['objects'] = $objects;
        $this->data['list'] = categories_map($objects);

        $this->load->vars($this->data);
        $this->load->view($this->main_layout);
    }

    public function delete($id = false)
    {
        $id = (int)$id;

        $item = $this->brands_model->findFirst($id);

        if (empty($item)) throw_on_404();

        try {
            if (!$this->brands_model->delete($id)) {
                throw new Exception('Ошибка удаления данных из таблицы: ' . $this->main_page);
            }

            $_SESSION['success'] = $this->success_delete;
        } catch (Exception $e) {
            $errors[] = 'Выброшено исключение : ' . $e->getMessage();
            $_SESSION['error'] = $errors;
        }

        redirect($this->path);
    }
}