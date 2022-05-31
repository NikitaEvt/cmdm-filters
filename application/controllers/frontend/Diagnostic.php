<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diagnostic extends FrontEndController
{
    private $page_id;

    public function __construct()
    {
        parent:: __construct();
        $this->page_id = 5;
        $this->load->model('diagnostics_model');
    }

    private function _load_main_page($page)
    {
        $this->data['page_title'] = (!empty($page->otitle)) ? $page->otitle : $page->title;
        $this->data['page_name'] = $page->title;
        $this->data['text'] = $page->text;
        $this->data['image'] = $page->img;
        $this->data['keywords'] = $page->keywords;
        $this->data['description'] = $page->description;
        $this->data['otitle'] = (!empty($page->otitle)) ? $page->otitle : $page->title;
        $this->data['lang_urls'] = array(
            'en' => '/'.$page->uriEN,
        );
        $this->data['inner_view'] = 'pages/diagnostic/index';
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
        $diagnostic = $this->diagnostics_model->get_diagnostics($this->clang);

        $this->data['diagnostic'] = $diagnostic;
        $this->data['page'] = $page;
        //Header с фото на фоне
        $this->data['bg_img'] = 1;
        $this->loadOGImgData($page);
        $this->_load_main_page($page);

        $this->_render();
    }

}
