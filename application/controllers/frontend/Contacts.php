<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends FrontEndController
{
    private $page_id;

    public function __construct()
    {
        parent:: __construct();
        $this->page_id = 8;
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
        $this->data['header'] = "layouts/header/header";
        $this->data['footer'] = "layouts/footer/footer";
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

        $this->loadOGImgData($page);
        $this->_load_main_page($page);

        $this->data['lang_urls'] = array(
            'ru' => '/'.$page->uriRU,
            'ro' => '/'.$page->uriRO,
        );
        $this->data['inner_view'] = 'pages/contacts/index';
        $this->_render();
    }

    public function send()
    {
        check_if_POST();
        foreach ($_POST as $index => $post_data) {
            $post[$index] = $this->input->post($index, true);
        }

        // trimitem datele in email
        $tx = 'Name:'.$post['name'].'<br>';
        $tx .= 'Email:'.$post['email'].'<br>';
        $tx .= 'Massage:'.$post['massage'].'<br>';
        //            EMAIL TO SERVER
        $this->load->library('email');
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('no-reply@' . $_SERVER['HTTP_HOST'], $_SERVER['HTTP_HOST']);
//         $this->email->to('igori-melnik@mail.ru');
        $this->email->to(EMAIL);
        $this->email->subject('FORM CONTACTS');
        $this->email->message($tx);
        if ($this->email->send()) {
            echo SEND_SUCCESS;
        } else {
            echo SEND_ERROR;
        }
    }

}
