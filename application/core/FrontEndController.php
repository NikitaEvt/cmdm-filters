<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Europe/Chisinau');

class FrontEndController extends CI_Controller
{
    protected $uri1;
    protected $uri2;
    protected $uri3;
    protected $uri4;
    protected $uri5;
    protected $uri6;
    protected $data;
    protected $layout_path;
    protected $langs;
    protected $lclang;
    protected $clang;
    protected $site_url;
    protected $full_url;
    protected $menu;

    public $reference = '';

    private function _get_prefered_lang()
    {
        $lang = isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]) ? substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2) : '';
        switch ($lang) {
            case "ru":
                $_SESSION['lang'] = 'ru';
                break;
            case "ro":
                $_SESSION['lang'] = 'ro';
                break;
            default:
                $_SESSION['lang'] = 'ro';
                break;
        }
    }

    private function _assign_language($lang = FALSE)
    {
        switch ($lang) {
            case "ru":
                $_SESSION['lang'] = 'ru';
                break;
            case "ro":
                $_SESSION['lang'] = 'ro';
                break;
            default:
                $_SESSION['lang'] = 'ro';
                break;
        }
    }

    private function _define_constants()
    {
        $this->load->model('constants_model');
        $constants = $this->constants_model->find();
        $lang = get_lang(TRUE);
        foreach ($constants as $constant) {
            define($constant->name, nl2br($constant->$lang));
        }
    }

    private function _is_logged_in()
    {
        $user_id = @$_SESSION['user_id'];
        $user_login = @$_SESSION['user_login'];
        $usr_key = @$_SESSION['usr_key'];

        if (empty($user_id) || empty($user_login) || empty($usr_key)) {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_login']);
            unset($_SESSION['usr_key']);
        }else{
            $client_info = $this->clients_model->get_client_login_id($user_id);
            if (empty($client_info)){
                unset($_SESSION['user_id']);
                unset($_SESSION['user_login']);
                unset($_SESSION['usr_key']);
            } else {
                $this->data['client_info'] = $client_info;
            }
        }
    }

    public function __construct()
    {
        parent::__construct();

        header('Content-type: text/html; charset=utf-8');
        $this->uri1 = uri(1);
        $this->uri2 = uri(2);
        $this->uri3 = uri(3);
        $this->uri4 = uri(4);
        $this->uri5 = uri(5);
        $this->uri6 = uri(6);

        $this->load->helper('users');
        $this->load->library(['cart']);
        $this->load->model('menu_model');
        $this->load->model('categories_model');
        $this->load->model('brands_model');

        if (empty($_SESSION['lang'])) $this->_get_prefered_lang();

        $this->_assign_language($this->uri1);

        $this->_define_constants();

        $this->_is_logged_in();

        $this->output->set_header('X-XSS-Protection: 1; mode=block');
        $this->output->set_header('X-Content-Type-Options: nosniff');

        $this->layout_path = 'pages/index';
        $this->langs = array('EN');
        $this->lclang = get_lang(FALSE);
        $this->clang = get_lang(TRUE);
        if(!empty($_POST['lg'])){
            $this->lclang = $_POST['lg'];
            $this->clang = mb_strtoupper($_POST['lg']);
        }
        $this->site_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'];
        $this->full_url = $this->site_url . $_SERVER['REQUEST_URI'];

        $menu = $this->menu = $this->menu_model->getMenu($this->clang);

        $home_categories = $this->categories_model->get_home_categories('EN');
        $this->data['home_categories'] = $home_categories;

        $footer_brands = $this->brands_model->get_brand_footer('EN');
        $this->data['footer_brands'] = $footer_brands;

        $this->data['total_items'] = $this->cart->total_items();
        $this->data['cart_total'] = $this->cart->total();

        $this->data['uri1'] = $this->uri1;
        $this->data['uri2'] = $this->uri2;
        $this->data['uri3'] = $this->uri3;
        $this->data['uri4'] = $this->uri4;
        $this->data['uri5'] = $this->uri5;
        $this->data['uri6'] = $this->uri6;
        $this->data['langs'] = $this->langs;
        $this->data['lclang'] = $this->lclang;
        $this->data['clang'] = $this->clang;
        $this->data['site_url'] = $this->site_url;
        $this->data['full_url'] = $this->full_url;
        $this->data['menu'] = $this->data['menu_full'] = $menu;
        $this->data['home'] = $this->menu['all'][1]->title;


    }

    protected function _render()
    {
        $this->load->vars($this->data);
        $this->load->view($this->layout_path);
    }

}