<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(realpath('application') . '/third_party/vendor/autoload.php');

use JasonGrimes\Paginator;
class News extends FrontEndController
{
    private $page_id;
    private $per_page;

    public function __construct()
    {
        parent:: __construct();
        $this->page_id = 6;
        $this->per_page = 8;
        $this->load->model('articles_model');
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

        // start pagination
        $pagination_nr = @$_GET['page'];
        if (empty($pagination_nr) || $pagination_nr < 1) $pagination_nr = 1;
        $start = ($pagination_nr - 1) * $this->per_page;
        $news_all = $this->articles_model->get_news_all();
        $news = $this->articles_model->get_news_pag($this->clang, $start, $this->per_page);

        $count = count($news_all);

        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
        $string = '';
        $urlPattern = $uri_parts[0] . '?' . $string . 'page=(:num)';
        $paginator = new Paginator(
            $count,
            $this->per_page,
            $pagination_nr,
            $urlPattern
        );
        $paginator->setMaxPagesToShow(5);
        $this->data['page_url'] = '/' . $this->uri1 . '/' . $this->uri2 . '/' . $this->uri3;
        $this->data['paginator'] = $paginator;
        // end pagination
        $this->data['news'] = $news;
        $this->data['lang_urls'] = array(
            'ru' => '/'.$page->uriRU,
            'ro' => '/'.$page->uriRO,
        );
        $this->loadOGImgData($page);
        $this->_load_main_page($page);

        $this->data['inner_view'] = 'pages/news/index';
        $this->_render();
    }

    public function item()
    {
        $page = $this->menu_model->get_page_data_by_id($this->page_id, $this->clang);
        if (empty($page)) throw_on_404();

        $url = $_SERVER['REQUEST_URI'];
        $a = explode('/', $url);
        $url_news = $a[3];
        $url_news = strtok($url_news, '?');
        $news = $this->articles_model->get_news_uri($this->clang, $url_news);
        if (empty($news)) throw_on_404();
        $this->data['news'] = $news;
        $news_alt = $this->articles_model->get_news_pag($this->clang, 0, 6);
        foreach ($news_alt as $key => $value){
            if ($value->id == $news->id){
                unset($news_alt[$key]);
            }
        }
        $this->data['news_alt'] = $news_alt;

        $this->data['lang_urls'] = array(
            'ru' => $page->uriRU.'/'.$news->uriRU,
            'ro' => $page->uriRO.'/'.$news->uriRO,
        );
        $this->loadOGImgData($news);
        $this->_load_main_page($news);

        $this->data['inner_view'] = 'pages/news/item';
        $this->_render();
    }

}
