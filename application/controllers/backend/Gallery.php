<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends BackEndController
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

        $this->add = 'Добавить Галерею';
        $this->index_title = 'Галерея';
        $this->success_add = 'Вы успешно добавили новую Галерею!';
        $this->success_update_order = 'Вы успешно обновили порядок отображения!';
        $this->success_edit = 'Вы успешно обновили Галерею!';
        $this->success_delete = 'Вы успешно удалили Галерею!';

        $this->data['title'] = $this->index_title;
        $this->data['add'] = $this->add;
        $this->load->model('gallery_model');
    }

    public function index()
    {
        init_load_img($this->main_page);

        $objects = $this->gallery_model->find();

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
                $post['uri' . $lang] = str_replace('â', 'a', $post['uri' . $lang]);
            }

            $id = $this->gallery_model->put($post);
            if (!$id) {
                throw new Exception('Ошибка записи данных в таблицу: ' . $this->main_page);
            }

            if (isset($_FILES['images'])) {

                $uploadData = [];
                $filesCount = count($_FILES['images']['name']);
                for ($i = 0; $i < $filesCount; $i++) {
                    $_FILES['file']['name'] = $_FILES['images']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['images']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['images']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['images']['size'][$i];

                    /// File size 2MB
                    if (isset($_FILES['file']['size'])) {
                        if ($_FILES['file']['size'] >= 2000000) {
                            throw new Exception('Ошибка загрузки файла: привышен допустимый размер!');
                        }
                    }
                    $this->upload->do_upload('file');
                    $file_data = $this->upload->data();
                    $file = $file_data['file_name'];
                    $file_types = array('.jpg', '.jpeg', '.gif', '.png');
                    if (in_array(strtolower($file_data['file_ext']), $file_types)) {
                        $uploadData[$i]['img'] = $file;
                        $uploadData[$i]['gallery_id'] = $id;
                    }
                }
                if (!empty($uploadData)) {
                    $this->db->insert_batch('gallery_img', $uploadData);
                }
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

        $this->load->model('gallery_model');

        try {
            $post = $this->input->post('so');

            if (empty($post) || !is_array($post)) {
                throw new Exception('Ошибка в полученных данных!');
            }

            if (!$this->gallery_model->update_sorder($post)) {
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
        $item = $this->gallery_model->findFirst($id);
        if (empty($item)) throw_on_404();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                foreach ($_POST as $index => $post_data) {
                    $post[$index] = $this->input->post($index);
                }
                $post['updated_at'] = date("Y-m-d H:i:s");
                foreach ($this->langs as $lang) {
                    $post['uri' . $lang] = (!empty($post['title' . $lang])) ? transliteration($post['title' . $lang]) : '';
                }

                if (isset($post['image_order'])) {
                    foreach ($post['image_order'] as $key => $order) {
                        $image_orders[$key] = [
                            'id' => $key,
                            'sorder' => $order,
                        ];
                    }

                    if (!empty($image_orders)) {
                        $this->db->update_batch('gallery_img', $image_orders, 'id');
                    }

                    unset($post['image_order']);
                }

                if (!$this->gallery_model->update($post, $id)) {
                    throw new Exception('Ошибка записи данных в таблицу: ' . $this->main_page);
                }

                if (isset($_FILES['images'])) {

                    $uploadData = [];
                    $filesCount = count($_FILES['images']['name']);
                    for ($i = 0; $i < $filesCount; $i++) {
                        $_FILES['file']['name'] = $_FILES['images']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['images']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['images']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['images']['size'][$i];

                        /// File size 2MB
                        if (isset($_FILES['file']['size'])) {
                            if ($_FILES['file']['size'] >= 2000000) {
                                throw new Exception('Ошибка загрузки файла: привышен допустимый размер!');
                            }
                        }
                        $this->upload->do_upload('file');
                        $file_data = $this->upload->data();
                        $file = $file_data['file_name'];
                        $file_types = array('.jpg', '.jpeg', '.gif', '.png');
                        if (in_array(strtolower($file_data['file_ext']), $file_types)) {
                            $uploadData[$i]['img'] = $file;
                            $uploadData[$i]['gallery_id'] = $id;
                        }
                    }
                    if (!empty($uploadData)) {
                        $this->db->insert_batch('gallery_img', $uploadData);
                    }
                }

                $_SESSION['success'] = $this->success_edit;
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                $errors[] = 'Выброшено исключение : ' . $e->getMessage();
                $_SESSION['error'] = $errors;
            }

            $item = $this->gallery_model->findFirst($id);
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

        $item = $this->gallery_model->findFirst($id);

        if (empty($item)) throw_on_404();

        try {
            if (!empty($item->img)) {
                $fileList = recDirSearch($_SERVER['DOCUMENT_ROOT'] . '/public/gallery/', $item->img);
            }

            if (!empty($fileList)) {
                foreach ($fileList as $file) {
                    unlink($file);
                }
            }
            if (!$this->gallery_model->delete($id)) {
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