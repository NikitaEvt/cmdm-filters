<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends BackEndController
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

        $this->add = 'Добавить товар';
        $this->index_title = 'Каталог';
        $this->success_add = 'Вы успешно добавили новый товар!';
        $this->success_update_order = 'Вы успешно обновили порядок отображения!';
        $this->success_edit = 'Вы успешно обновили товар!';
        $this->success_delete = 'Вы успешно удалили товар!';

        $this->data['title'] = $this->index_title;
        $this->data['add'] = $this->add;

        $this->load->model(['products_model', 'categories_model' => 'categories', 'brands_model' => 'brands']);
    }

    public function index()
    {
        init_load_img($this->main_page);
        $search_get = $this->input->post_get('query');
        if (!empty($search_get)) {
            $objects = $this->products_model->search_get_products($search_get);
            $this->data['count'] = 0;
        } else {
            $objects = $this->products_model->inCategory(isset($_GET['cat']) ? $_GET['cat'] : 0)->pagination(40, isset($_GET['page']) ? $_GET['page'] : 1);
            $this->data['count'] = $objects['count'];
            $objects = $objects['data'];
        }

        $this->data['objects'] = $objects;
        $this->data['inner_view'] = $this->index_view;
        $this->data['categories'] = $this->categories->getCategories();
        $this->data['for_list'] = options_categories($this->data['categories']);
        $this->data['brands'] = $this->brands->getBrends_product();
        $this->data['all_categories'] = $this->categories->find();
        $this->data['categories_json'] = admin_categories_map($this->categories->find(), 0);

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
                if ($item == 'on') {
                    $post[$index] = 1;
                }
            }

            foreach ($this->langs as $lang) {
                if (isset($post['title' . $lang]))
                    $post['uri' . $lang] = (!empty($post['title' . $lang])) ? transliteration($post['title' . $lang]) : '';
                $post['uri' . $lang] = str_replace('â', 'a', $post['uri' . $lang]);
            }

            if (!$this->products_model->put($post)) {
                throw new Exception('Ошибка записи данных в таблицу: ' . $this->main_page);
            }
            $id = $this->db->insert_id();
            if (isset($_FILES['images'])) {
                $uploadData = [];
                $filesCount = count($_FILES['images']['name']);
                for ($i = 0; $i < $filesCount; $i++) {
                    $_FILES['file']['name'] = $_FILES['images']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['images']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['images']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['images']['size'][$i];

                    // File upload configuration
                    $uploadPath = 'public/products';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['encrypt_name'] = true;

                    /// File size 2MB
                    if (isset($_FILES['file']['size'])) {
                        if ($_FILES['file']['size'] >= 2000000) {
                            throw new Exception('Ошибка загрузки файла: привышен допустимый размер!');
                        }
                    }

                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    // Upload file to server
                    if ($this->upload->do_upload('file')) {
                        // Uploaded file data
                        $fileData = $this->upload->data();
                        $uploadData[$i]['product_id'] = $id;
                        $uploadData[$i]['img'] = $fileData['file_name'];
                    }
                }

                if (!empty($uploadData)) {
                    $this->db->insert_batch('products_img', $uploadData);
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

        try {
            $post = $this->input->post('so');

            if (empty($post) || !is_array($post)) {
                throw new Exception('Ошибка в полученных данных!');
            }

            if (!$this->products_model->update_sorder($post)) {
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

        $item = $this->products_model->findFirst($id);

        if (empty($item)) throw_on_404();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            unset($_POST['add_products_alt']);

            // delete prods caracteristics
            $this->db->where('product_id', $id)->delete('products_features');
            if (!empty($_POST['features'])){
                $caract = $_POST['features'];
                // if features checkboxes is not empty
                if (!empty($caract)){
                    // add new characteristics
                    foreach ($caract as $type => $element){
                        foreach ($element as $feature_id => $feature_value_id){
                            foreach($feature_value_id as $k => $v){
                                $this->db->insert('products_features', [
                                    'product_id' => $id,
                                    'feature_id' => $type,
                                    'feature_value_id' => $v,
                                ]);
                            }
                        }
                    }
                }

                unset($_POST['features']);
            }
            $radio_feature = $this->input->post('radio_feature', true);
            if (!empty($radio_feature)){
                // if not empty radio features, add it
                if (!empty($radio_feature)) {
                    foreach ($radio_feature as $feature => $feature_value) {
                        $this->db->insert('products_features', [
                            'product_id' => $id,
                            'feature_id' => $feature,
                            'feature_value_id' => $feature_value,
                        ]);
                    }
                }
                unset($_POST['radio_feature']);
            }
            
            if (!empty($_POST['image_order'])){
                foreach ($_POST['image_order'] as $key => $item){
                    $this->db->where('id', $key);
                    $this->db->update('products_img', array('sorder' =>$item));
                }
                unset($_POST['image_order']);
            }
            try {
                foreach ($_POST as $index => $post_data) {
                    $post[$index] = $this->input->post($index, TRUE);
                }

                foreach ($this->langs as $lang) {
                    if (isset($post['title' . $lang]))
                        $post['uri' . $lang] = (!empty($post['title' . $lang])) ? transliteration($post['title' . $lang]) : '';
                    $post['uri' . $lang] = str_replace('â', 'a', $post['uri' . $lang]);
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

                        // File upload configuration
                        $uploadPath = 'public/products';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'jpg|jpeg|png';
                        $config['encrypt_name'] = true;

                        // Load and initialize upload library
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        // Upload file to server
                        if ($this->upload->do_upload('file')) {
                            // Uploaded file data
                            $fileData = $this->upload->data();
                            $uploadData[$i]['product_id'] = $id;
                            $uploadData[$i]['img'] = $fileData['file_name'];
                        }
                    }

                    if (!empty($uploadData)) {
                        $this->db->insert_batch('products_img', $uploadData);
                    }
                }


                if (!$this->products_model->update($post, $id)) {
                    throw new Exception('Ошибка записи данных в таблицу: ' . $this->main_page);
                }

                $_SESSION['success'] = $this->success_edit;

            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                $errors[] = 'Выброшено исключение : ' . $e->getMessage();
                $_SESSION['error'] = $errors;
            }

            $item = $this->products_model->findFirst($id);
        }
        $caracteristics_list = array();
        if (!empty($item->type_id)) {
            // get selected product caracteristics
            $selected = $this->db->where('product_id', $id)->get('products_features')->result();
            $this->data['selected_features'] = $selected;

            $caracteristics_list = array();
            $caracteristics = $this->products_model->get_prod_characteristics($item->type_id);

            if (!empty($caracteristics)) {
                foreach ($caracteristics as $el) {
                    $arr = array();
                    foreach ($caracteristics as $values) {
                        if ($values->value_feature_id == $el->feature_id) {
                            $arr[] = [
                                'value_id' => $values->item_id,
                                'value_name' => $values->item_name,
                                'color' => $values->color,
                            ];
                        }
                    }
                    $caracteristics_list[$el->feature_id] = [
                        'feature_id' => $el->feature_id,
                        'feature_name' => $el->feature_name,
                        'feature_sorder' => $el->feature_sorder,
                        'feature_type' => $el->feature_type,
                        'feature_values' => $arr
                    ];
                }
            }
        }

        $product_types = $this->db->order_by('sorder ASC, id DESC')->get('shop_type')->result();
        $this->data['product_types'] = $product_types;

        $item->images = $this->db->where('product_id', $id)->order_by('sorder ASC, id DESC')->get('products_img')->result();

        $products_alt = $this->products_model->gat_products_alt($id);
        $this->data['products_alt'] = $products_alt;

        $this->data['inner_view'] = $this->item_view;
        $this->data['caracteristics_list'] = $caracteristics_list;
        $this->data['title'] = 'Редактирование ' . $item->titleEN . ' ( ID: '.$item->id.' )';
        $this->data['parent_url'] = $this->path;
        $this->data['parent_title'] = $this->index_title;
        $this->data['item'] = $item;
        $this->data['brands'] = $this->brands->getBrends_product();

        $this->data['categories'] = $this->categories->getCategories();
        $this->data['for_list'] = options_categories($this->data['categories']);

        $this->load->vars($this->data);
        $this->load->view($this->main_layout);
    }

    public function delete($id = false)
    {
        $id = (int)$id;

        $item = $this->products_model->findFirst($id);

        if (empty($item)) throw_on_404();

        try {
            if (!$this->products_model->delete($id)) {
                throw new Exception('Ошибка удаления данных из таблицы: ' . $this->main_page);
            }

            $images = $this->db->where('product_id', $id)->from('products_img')->get()->result_array();
            foreach ($images as $image) {
                @unlink(FCPATH . 'public/products/' . $image['img']);
                $this->db->where('id', $image['id'])->delete('products_img');
            }
            $_SESSION['success'] = $this->success_delete;
        } catch (Exception $e) {
            $errors[] = 'Выброшено исключение : ' . $e->getMessage();
            $_SESSION['error'] = $errors;
        }

        redirect($this->path);
    }

    public function products_alt()
    {
        check_if_POST();
        $product = $this->products_model->product_alt($_POST['product']);
        if (empty($product)) throw_on_404();

        $data = array(
            'products_alt' => $product->id,
            'product_id' => $_POST['id'],
            'SKU' => $product->SKU,
            'titleRU' => $product->title,
            'sorder' => 1,
        );
        $this->db->insert('products_alternative', $data);

        echo '
<table class="table table-bordered table-striped table-hover" id="prodalt' . $product->id . '">
    <tbody>
    <tr>
        <td width="150">
            SKU: ' . $product->SKU . '
        </td>
        <td width="">
            ' . $product->title . '
        </td>
        <td width="100">
            <a onclick="DeleteProdAlt( ' . $product->id . ' )" data-op="<?=$key->id?>" class="btn btn-xs default btn-editable red-stripe">
                <i class="glyphicon glyphicon-remove-circle"></i> Удалить
            </a>
        </td>
    </tr>
    </tbody>
</table>';
    }

    public function product_features()
    {
        check_if_POST();

        if (!empty($_POST['type_id'])) {
            $caracteristics_list = array();
            $caracteristics = $this->products_model->get_prod_characteristics($_POST['type_id']);

            // get selected product caracteristics
            $selected = $this->db->where('product_id', $_POST['id'])->get('products_features')->result();

            if (!empty($caracteristics)) {
                foreach ($caracteristics as $el) {
                    $arr = array();
                    foreach ($caracteristics as $values) {
                        if ($values->value_feature_id == $el->feature_id) {
                            $arr[] = [
                                'value_id' => $values->item_id,
                                'value_name' => $values->item_name,
                                'color' => $values->color,
                            ];
                        }
                    }
                    $caracteristics_list[$el->feature_id] = [
                        'feature_id' => $el->feature_id,
                        'feature_name' => $el->feature_name,
                        'feature_sorder' => $el->feature_sorder,
                        'feature_type' => $el->feature_type,
                        'feature_values' => $arr
                    ];
                }
            }
        }
        if (!empty($caracteristics_list)){
            echo $this->load->view('backend/products/_features_list', array('caracteristics_list' => $caracteristics_list, 'selected_features'=>$selected), true);
        }
    }


    public function prodalt_delete()
    {
        $id = $_POST['id'];
        $this->db->where('id', $id);
        $this->db->delete('products_alternative');
    }

}

