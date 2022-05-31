<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends BackEndController
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

        $this->add = 'Добавить новость';
        $this->index_title = 'Новости';
        $this->success_add = 'Вы успешно добавили новую новость!';
        $this->success_update_order = 'Вы успешно обновили порядок отображения!';
        $this->success_edit = 'Вы успешно обновили новость!';
        $this->success_delete = 'Вы успешно удалили новость!';

        $this->data['title'] = $this->index_title;
        $this->data['add'] = $this->add;
        $this->load->model('articles_model');
    }

    public function index()
    {
        init_load_img($this->main_page);

        $objects = $this->articles_model->find_by_date();

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

            foreach ($_FILES as $key => $file) {
                if ($file['name'] == '') continue;
                $this->upload->do_upload($key);
                $file_data = $this->upload->data();
                $filename = $file_data['file_name'];

                $file_types = array('.jpg', '.jpeg', '.gif', '.png');

                if (in_array(strtolower($file_data['file_ext']), $file_types)) {
                    $post[$key] = $filename;
                }
            }

            $id = $this->articles_model->put($post);
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

            if (!$this->articles_model->update_sorder($post)) {
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

        $item = $this->articles_model->findFirst($id);
        if (empty($item)) throw_on_404();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                foreach ($_POST as $index => $post_data) {
                    $post[$index] = $this->input->post($index);
                }
                $post['updated_at'] = date("Y-m-d H:i:s");
                foreach ($this->langs as $lang) {
                    $post['uri' . $lang] = (!empty($post['title' . $lang])) ? transliteration($post['title' . $lang]) : '';
                    $post['uri' . $lang] = str_replace('â', 'a', $post['uri' . $lang]);
                }

                foreach ($_FILES as $key => $file) {
                    if ($file['name'] == '') continue;
                    $this->upload->do_upload($key);
                    $file_data = $this->upload->data();
                    $filename = $file_data['file_name'];

                    $file_types = array('.jpg', '.jpeg', '.gif', '.png');
                    if (in_array(strtolower($file_data['file_ext']), $file_types)) {
                        $post[$key] = $filename;

                        if (!empty($item->{$key})) {
                            $fileList = recDirSearch($_SERVER['DOCUMENT_ROOT'] . '/public/articles/', $item->{$key});
                            if (!empty($fileList)) {
                                foreach ($fileList as $fileremove) {
                                    $fileremove = str_replace('\\', '/', $fileremove);
                                    if (file_exists($fileremove))
                                        unlink($fileremove);
                                }
                            }
                        }
                    }
                }

                if (!$this->articles_model->update($post, $id)) {
                    throw new Exception('Ошибка записи данных в таблицу: ' . $this->main_page);
                }

                $_SESSION['success'] = $this->success_edit;
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                $errors[] = 'Выброшено исключение : ' . $e->getMessage();
                $_SESSION['error'] = $errors;
            }

            $item = $this->articles_model->findFirst($id);
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

        $item = $this->articles_model->findFirst($id);

        if (empty($item)) throw_on_404();

        try {
            $keys = ['img'];
            foreach ($keys as $key) {
                if (!empty($item->{$key})) {
                    $fileList = recDirSearch($_SERVER['DOCUMENT_ROOT'] . '/public/articles/', $item->{$key});
                    if (!empty($fileList))
                        foreach ($fileList as $fileremove) {
                            $fileremove = str_replace('\\', '/', $fileremove);
                            if (file_exists($fileremove))
                                unlink($fileremove);
                        }
                }
            }
            if (!$this->articles_model->delete($id)) {
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