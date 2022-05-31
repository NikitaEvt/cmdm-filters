<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
//        @session_start();
        header('Content-type: text/html; charset=utf-8');
//        check_if_POST();
        $this->load->library('session');
        if (empty($_SESSION['lang'])) $this->_get_prefered_lang();
        $this->lclang = get_lang(FALSE);
        $this->clang = get_lang(TRUE);
    }

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
            case "en":
                $_SESSION['lang'] = 'en';
                break;
            default:
                $_SESSION['lang'] = 'ru';
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

}