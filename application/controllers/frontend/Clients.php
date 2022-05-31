<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends FrontEndController
{
    private $page_id;

    public function __construct()
    {
        parent:: __construct();
        $this->page_id = 10;
        $this->load->model('clients_model');
    }

    private function _load_main_page($page)
    {
        $this->data['page_title'] = (!empty($page->otitle)) ? $page->otitle : $page->title;
        $this->data['page_name'] = $page->title;
        $this->data['text'] = $page->text;
        $this->data['image'] = '/assets/img/og_img.png';
        $this->data['keywords'] = $page->keywords;
        $this->data['description'] = $page->description;
        $this->data['otitle'] = (!empty($page->otitle)) ? $page->otitle : $page->title;
    }

    private function loadOGImgData($page = false)
    {
        if (empty($page)) throw_on_404();

        if (!empty($page->img)) {
            $this->data['og_img'] = newthumbs($page->img, 'menu', 500, 300, 'og500x300x1', 1);
            $this->data['og_img_width'] = 500;
            $this->data['og_img_height'] = 300;
        } else {
            $this->data['og_img'] = newthumbs('og_img.png', 'i', 214, 51, 'og214x51x1', 1);
            $this->data['og_img_width'] = 214;
            $this->data['og_img_height'] = 51;
        }
    }

    public function index()
    {
        $page = $this->menu_model->get_page_data_by_id($this->page_id, $this->clang);
        if (empty($page)) throw_on_404();

        if (empty($this->data['client_info'])){
            redirect('/login');
        }

        $this->data['inner_view'] = 'pages/clients/index';

        $this->loadOGImgData($page);
        $this->_load_main_page($page);

        $this->_render();
    }
    public function order_history()
    {
        $page = $this->menu_model->get_page_data_by_id(14, $this->clang);
        if (empty($page)) throw_on_404();

        $this->data['lang_urls'] = array(
            'ro' => $page->uriRO,
            'ru' => $page->uriRU,
        );
        $this->data['inner_view'] = 'pages/clients/order_history';

        $this->load->model('orders_model');
        $order_history = $this->orders_model->order_client($_SESSION['user_id']);
        if (!empty($order_history)){
            foreach ($order_history as $item){
                $item->products = $this->orders_model->orderProducts($item->id, $this->clang);
            }
        }

        $this->data['order_history'] = $order_history;

        $this->loadOGImgData($page);
        $this->_load_main_page($page);

        $this->_render();
    }
    public function customer_data_edit()
    {
        $page = $this->menu_model->get_page_data_by_id(12, $this->clang);
        if (empty($page)) throw_on_404();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $index => $post_data) {
                $post[$index] = $this->input->post($index, TRUE);
            }
            $data = array(
                'name' => $post['name'],
                'email' => $post['email'],
                'phone' => $post['phone']
            );
            $this->db->where('id', $_SESSION['user_id']);
            $this->db->update('clients', $data);
            $_SESSION['user_login'] = $post['email'];

            $data = array(
                'locality' => $post['locality'],
                'street' => $post['street'],
                'house_number' => $post['house_number'],
                'apartment_number' => $post['apartment_number']
            );
            $this->db->where('client_id', $_SESSION['user_id']);
            $this->db->update('clients_addresses', $data);
        }

        $clients_addresses = $this->clients_model->clients_addres($this->data['client_info']->id);
        if (empty($clients_addresses)){
            $this->db->insert('clients_addresses', array('client_id'=>$this->data['client_info']->id));
            $clients_addresses = $this->clients_model->clients_addres($this->data['client_info']->id);
        }
        $this->data['clients_addresses'] = $clients_addresses;
        $this->data['lang_urls'] = array(
            'ro' => $page->uriRO,
            'ru' => $page->uriRU,
        );
        $this->data['inner_view'] = 'pages/clients/edit';

        $this->loadOGImgData($page);
        $this->_load_main_page($page);

        $this->_render();
    }
    public function customer_password_edit()
    {
        $page = $this->menu_model->get_page_data_by_id(11, $this->clang);
        if (empty($page)) throw_on_404();

        $this->data['lang_urls'] = array(
            'ro' => $page->uriRO,
            'ru' => $page->uriRU,
        );
        $this->data['inner_view'] = 'pages/clients/new_password';

        $this->loadOGImgData($page);
        $this->_load_main_page($page);

        $this->_render();
    }

    public function login()
    {
        $page = $this->menu_model->get_page_data_by_id(8, $this->clang);
        if (empty($page)) throw_on_404();
        $this->data['post_login'] = false;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $index => $post_data) {
                $post[$index] = $this->input->post($index);
            }

            if (!empty($post['email']) && !empty($post['password'])){
                $client = $this->clients_model->get_client_login($post['email'],codCrypt($post['password'], true));
                if (!empty($client)){
                    if ($client->active == 1) {
                        $_SESSION['user_id'] = $client->id;
                        $_SESSION['user_login'] = $client->email;
                        $_SESSION['usr_key'] = hash('sha512', $client->email . $client->password);
                        redirect('/account');
                    } else {
                        $this->data['post_login'] = $post;
                        $this->data['error_login'] = 'To enter, confirm your email';
                    }
                } else {
                    $this->data['error_login'] = 'You have entered incorrect data';
                    $this->data['post_login'] = $post;
                }
            }
        }
        if (!empty($this->data['client_info'])){
            redirect('/account');
        }

        $this->data['inner_view'] = 'pages/clients/login';

        $this->loadOGImgData($page);
        $this->_load_main_page($page);

        $this->_render();
    }
    public function registration()
    {
        $page = $this->menu_model->get_page_data_by_id(9, $this->clang);
        if (empty($page)) throw_on_404();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $index => $post_data) {
                $post[$index] = $this->input->post($index);
            }
            if (!empty($post['email'])&& !empty($post['password'])){
                $clients = $this->clients_model->check_email($post['email']);
                if (!empty($clients)){
                    $this->data['error_reg'] = 'This email is already registered';
                } else {
                    if ($post['password'] == $post['password_check']){
                        $data = array(
                            'name' => $post['name'],
                            'surname' => $post['surname'],
                            'phone' => $post['phone'],
                            'email' => $post['email'],
                            'password' => codCrypt($post['password'], true),
                        );
                        $this->db->insert('clients', $data);
                        $client_id = $this->db->insert_id();
                        if (!empty($client_id)){
                            $link = 'http://bulking-lab.ga/check_email?token=' . codCrypt($post['email'], true);
                            $tx = 'Confirm registration on the site:';
                            $tx .= '<br><a href="' . $link . '"> Confirm registration </a>';
                            //            EMAIL TO SERVER
                            $this->load->library('email');
                            $config['charset'] = 'utf-8';
                            $config['mailtype'] = 'html';
                            $this->email->initialize($config);
                            $this->email->from('no-reply@' . $_SERVER['HTTP_HOST'], $_SERVER['HTTP_HOST']);
                            $this->email->to($post['email']);
                            $this->email->subject('Confirm registration');
                            $this->email->message($tx);
                            $this->email->send();
                            $this->data['success_reg'] = 'To register, confirm your email';
                        }
                    } else {
                        $this->data['error_reg'] = 'Password mismatch';
                    }
                }
            }
        }
        if (!empty($this->data['client_info'])){
            redirect('/account');
        }
        $this->data['inner_view'] = 'pages/clients/registration';

        $this->loadOGImgData($page);
        $this->_load_main_page($page);

        $this->_render();
    }
    public function reset_password()
    {
        $page = $this->menu_model->get_page_data_by_id(6, $this->clang);
        if (empty($page)) throw_on_404();

        $this->data['lang_urls'] = array(
            'ro' => $page->uriRO,
            'ru' => $page->uriRU,
        );
        $this->data['inner_view'] = 'pages/clients/reset_password';

        $this->loadOGImgData($page);
        $this->_load_main_page($page);

        $this->_render();
    }
    public function registration_active()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET') {
            throw_on_404();
        } else {
            if (!empty($_GET['token'])){
                $email = codCrypt($_GET['token'],false);
                $data = array(
                    'active' => 1,
                );
                $this->db->where('email',$email);
                $this->db->update('clients', $data);

                $page = $this->menu_model->get_page_data_by_id(8, $this->clang);
                if (empty($page)) throw_on_404();

                redirect('/login');
            }else{
                throw_on_404();
            }
        }
    }


}
