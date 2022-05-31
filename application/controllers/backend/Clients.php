<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends BackEndController
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

        $this->add = 'Добавить Клиента';
        $this->index_title = 'Клиенты';
        $this->success_add = 'Вы успешно добавили нового Клиента!';
        $this->success_update_order = 'Вы успешно обновили порядок отображения!';
        $this->success_edit = 'Вы успешно обновили Клиента!';
        $this->success_delete = 'Вы успешно удалили Клиента!';

        $this->data['title'] = $this->index_title;
        $this->data['add'] = $this->add;
        $this->load->model('clients_model');
    }

    public function index()
    {
        init_load_img($this->main_page);

        $objects = $this->clients_model->find();

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
                $post[$index] = $this->input->post($index, TRUE);
            }
            $post["password"] = codCrypt($post["password"]);
            $id = $this->clients_model->put($post);
            if (!$id) {
                throw new Exception('Ошибка записи данных в таблицу: ' . $this->main_page);
            } else {
                $data = array(
                    'client_id' => $id
                );
                $this->db->insert('clients_addresses', $data);
            }

            $_SESSION['success'] = $this->success_add;
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            $errors[] = 'Выброшено исключение : ' . $e->getMessage();
            $_SESSION['error'] = $errors;
        }

        redirect($this->path);
    }

    public function item($id = 0)
    {
        $id = (int)$id;

        init_load_img($this->main_page);

        $item = $this->clients_model->findFirst($id);
        $addres = $this->clients_model->clients_addres($id);

        if (empty($item)) throw_on_404();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST["addres"])){
                $this->db->where('client_id', $id);
                $this->db->update('clients_addresses', $_POST["addres"]);
                unset($_POST["addres"]);
            }
            try {
                foreach ($_POST as $index => $post_data) {
                    $post[$index] = $this->input->post($index, TRUE);
                }
                if (empty($post["password"])){ unset($post["password"]); } else{
                    $post["password"] = codCrypt($post["password"]);
                }
                if (!$this->clients_model->update($post, $id)) {
                    throw new Exception('Ошибка записи данных в таблицу: ' . $this->main_page);
                }

                $_SESSION['success'] = $this->success_edit;
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                $errors[] = 'Выброшено исключение : ' . $e->getMessage();
                $_SESSION['error'] = $errors;
            }

            $item = $this->clients_model->findFirst($id);
            $addres = $this->clients_model->clients_addres($id);
        }

        $this->data['inner_view'] = $this->item_view;
        $this->data['title'] = 'Редактирование ' . $item->name;
        $this->data['parent_url'] = $this->path;
        $this->data['parent_title'] = $this->index_title;
        $this->data['item'] = $item;
        $this->data['addres'] = $addres;

        $this->load->vars($this->data);
        $this->load->view($this->main_layout);
    }

    public function delete($id = false)
    {
        $id = (int)$id;

        $item = $this->clients_model->findFirst($id);

        if (empty($item)) throw_on_404();

        try {
            if (!$this->clients_model->delete($id)) {
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