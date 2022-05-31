<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends BackEndController
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

        $this->add = 'Добавить текстовую страницу';
        $this->index_title = 'Верхнее меню';
        $this->success_add = 'Вы успешно добавили новую текстовую страницу!';
        $this->success_update_order = 'Вы успешно обновили порядок отображения!';
        $this->success_edit = 'Вы успешно обновили текстовую страницу!';
        $this->success_delete = 'Вы успешно удалили текстовую страницу!';

        $this->data['title'] = $this->index_title;
        $this->data['add'] = $this->add;
        $this->load->model('menu_model');
    }

    public function index()
    {
        init_load_img($this->main_page);
        if ($this->data['admin_type'] != 1) { redirect('/backend/products/');}

        $objects = $this->menu_model->find();

        $this->data['inner_view'] = $this->index_view;
        $this->data['objects'] = $objects;

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
                $post[$index] = $this->input->post($index);
            }

            foreach ($this->langs as $lang) {
                $post['uri' . $lang] = (!empty($post['title' . $lang])) ? transliteration($post['title' . $lang]) : '';
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

            $id = $this->menu_model->put($post);
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

        $this->load->model('menu_model');

        try {
            $post = $this->input->post('so');

            if (empty($post) || !is_array($post)) {
                throw new Exception('Ошибка в полученных данных!');
            }

            if (!$this->menu_model->update_sorder($post)) {
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
        $item = $this->menu_model->findFirst($id);
        if (empty($item)) throw_on_404();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                foreach ($_POST as $index => $post_data) {
                    $post[$index] = $this->input->post($index);
                }
                $post['updated_at'] = date("Y-m-d H:i:s");
                if ($id != 1 && $item->system != 1) {
                    foreach ($this->langs as $lang) {
                        $post['uri' . $lang] = (!empty($post['title' . $lang])) ? transliteration($post['title' . $lang]) : '';
                        $post['uri' . $lang] = str_replace('â', 'a', $post['uri' . $lang]);
                    }
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

                if (!$this->menu_model->update($post, $id)) {
                    throw new Exception('Ошибка записи данных в таблицу: ' . $this->main_page);
                }

                $_SESSION['success'] = $this->success_edit;
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                $errors[] = 'Выброшено исключение : ' . $e->getMessage();
                $_SESSION['error'] = $errors;
            }

            $item = $this->menu_model->findFirst($id);
        }

        $this->data['inner_view'] = $this->item_view;
        $this->data['title'] = 'Редактирование ' . $item->titleRU;
        $this->data['parent_url'] = $this->path;
        $this->data['parent_title'] = $this->index_title;
        $this->data['item'] = $item;

        $this->load->vars($this->data);
        $this->load->view($this->main_layout);
    }

    public function delete($id = false)
    {
        $id = (int)$id;

        $item = $this->menu_model->findFirst($id);

        if (empty($item)) throw_on_404();

        try {
            if (!empty($item->img)) {
                $fileList = recDirSearch($_SERVER['DOCUMENT_ROOT'] . '/public/menu/', $item->img);
            }

            if (!empty($fileList)) {
                foreach ($fileList as $file) {
                    unlink($file);
                }
            }
            if (!$this->menu_model->delete($id)) {
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