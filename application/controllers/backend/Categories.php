<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends BackEndController
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

        $this->add = 'Добавить категорию';
        $this->index_title = 'Категории';
        $this->success_add = 'Вы успешно добавили новую категорию!';
        $this->success_update_order = 'Вы успешно обновили порядок отображения!';
        $this->success_edit = 'Вы успешно обновили категорию!';
        $this->success_delete = 'Вы успешно удалили категорию!';

        $this->data['title'] = $this->index_title;
        $this->data['add'] = $this->add;
        $this->load->model('categories_model');

        $this->data['categories'] = $this->categories_model->getCategories();
    }

    public function index()
    {
        init_load_img($this->main_page);

        $objects = $this->categories_model->find();
        $categories_tree = array_categories_parse_bk($objects);

        $this->data['inner_view'] = $this->index_view;
        $this->data['objects'] = $objects;
	    $this->data['categories'] = $this->categories_model->get_category_parents();
	    $this->data['categories_tree'] = $categories_tree;

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

            if (!empty($post['parent_id'])) {
	            $parent_step = $this->db->select('step')->where('id', $post['parent_id'])->get('categories')->row()->step;
	            $post['step'] = !empty($parent_step) ? $parent_step + 1 : 1;
            } else
            	$post['step'] = 1;

	        foreach ($this->langs as $lang) {
		        $post['uri'.$lang] = (!empty($post['title'.$lang])) ? transliteration($post['title'.$lang]) : '';
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

            $id = $this->categories_model->put($post);
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

            if (!$this->categories_model->update_sorder($post)) {
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

        $item = $this->categories_model->findFirst($id);

        if (empty($item)) throw_on_404();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                foreach ($_POST as $index => $post_data) {
                    $post[$index] = $this->input->post($index, TRUE);
                }
                $post['updated_at'] = date("Y-m-d H:i:s");
	            $parent_step = $this->db->select('step')->where('id', $post['parent_id'])->get('categories')->row();
                if ($post['parent_id'] == $id) {$parent_step = ''; $post['parent_id'] = 0;}
	            $post['step'] = !empty($parent_step)?$parent_step->step+1:1;

	            foreach ($this->langs as $lang) {
		            $post['uri'.$lang] = (!empty($post['title'.$lang])) ? transliteration($post['title'.$lang]) : '';
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


                if (!$this->categories_model->update($post, $id)) {
                    throw new Exception('Ошибка записи данных в таблицу: ' . $this->main_page);
                }

                $_SESSION['success'] = $this->success_edit;
                $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
                $this->cache->delete('categoriesRO');
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                $errors[] = 'Выброшено исключение : ' . $e->getMessage();
                $_SESSION['error'] = $errors;
            }
            $item = $this->categories_model->findFirst($id);
        }

        $this->data['inner_view'] = $this->item_view;
        $this->data['title'] = 'Редактирование ' . $item->titleRU;
        $this->data['parent_url'] = $this->path;
        $this->data['parent_title'] = $this->index_title;
        $this->data['item'] = $item;
        $categories_tree= $this->categories_model->find();
        $categories_tree = array_categories_parse_bk($categories_tree);
        $this->data['categories_tree'] = $categories_tree;

        $this->load->vars($this->data);
        $this->load->view($this->main_layout);
    }

    public function delete($id = false)
    {
        $id = (int)$id;

        $item = $this->categories_model->findFirst($id);

        if (empty($item)) throw_on_404();

        try {
            if (!$this->categories_model->delete($id)) {
                throw new Exception('Ошибка удаления данных из таблицы: ' . $this->main_page);
            }
            $_SESSION['success'] = $this->success_delete;
        } catch (Exception $e) {
            $errors[] = 'Выброшено исключение : ' . $e->getMessage();
            $_SESSION['error'] = $errors;
        }

        redirect($this->path);
    }

    public function update_characters() {
        check_if_POST();

        $this->db->update_batch('characters', $this->input->post('items'), 'id');
    }
}