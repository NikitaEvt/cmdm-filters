<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(realpath('application') . '/third_party/vendor/autoload.php');

use JasonGrimes\Paginator;

class Parts extends FrontEndController
{
    private $page_id;
    private $per_page;

    public function __construct()
    {
        parent:: __construct();
        $this->page_id = 4;
        $this->per_page = 30;
        $this->load->model('parts_model');
        $this->load->model('categories_model');
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
        // start pagination
        $pagination_nr = @$_GET['page'];
        if (empty($pagination_nr) || $pagination_nr < 1) $pagination_nr = 1;
        $start = ($pagination_nr - 1) * $this->per_page;
        $parts_all = $this->parts_model->get_parts_all();
        $parts = $this->parts_model->get_parts_pag($this->clang, $start, $this->per_page);

        $count = count($parts_all);

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
        $this->data['parts'] = $parts;

        $categories = $this->categories_model->get_categories_all($this->clang);
        $categories = array_categories_parse($categories);
        $this->data['categories'] = $categories;

        $this->loadOGImgData($page);
        $this->_load_main_page($page);
        $this->data['lang_urls'] = array(
            'ru' => $page->uriRU,
            'ro' => $page->uriRO,
//            'en' => '/'.$page->uriEN,
        );

        $this->data['inner_view'] = 'pages/parts/index';
        $this->_render();
    }

    public function category()
    {
        $page = $this->menu_model->get_page_data_by_id($this->page_id, $this->clang);
        if (empty($page)) throw_on_404();
        $url = $_SERVER['REQUEST_URI'];
        $a = explode('/', $url);
        $category_uri = $a[3];
        $category_uri = strtok($category_uri, '?');
        $category = $this->categories_model->get_categories_by_uri($this->clang, $category_uri);
        if (empty($category)) throw_on_404();
        $categories[$category->step] = $category;
        $this->tree_category($category, $categories);
        $categories_arr = $this->categories_model->get_categories_arr($category->id);

        // start pagination
        $pagination_nr = @$_GET['page'];
        if (empty($pagination_nr) || $pagination_nr < 1) $pagination_nr = 1;
        $start = ($pagination_nr - 1) * $this->per_page;
        $parts_all = $this->parts_model->get_parts_category_all($categories_arr);

        $parts = $this->parts_model->get_parts_category_pag($this->clang, $start, $this->per_page, $categories_arr);
        $count = count($parts_all);

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
        $this->data['parts'] = $parts;

        $categories = $this->categories_model->get_categories_all($this->clang);
        $categories = array_categories_parse($categories);
        $this->data['categories'] = $categories;
        $this->data['view_category'] = $category;
        $this->data['lang_urls'] = array(
            'ru' => $page->uriRU . '/' . $category->uriRU,
            'ro' => $page->uriRO . '/' . $category->uriRO,
//            'en' => $page->uriEN.'/'.$category->uriEN,
        );
        $this->loadOGImgData($category);
        $this->_load_main_page($category);

        $this->data['inner_view'] = 'pages/parts/category';
        $this->_render();
    }

    public function item()
    {
        $page = $this->menu_model->get_page_data_by_id($this->page_id, $this->clang);
        if (empty($page)) throw_on_404();
        $url = $_SERVER['REQUEST_URI'];
        $a = explode('/', $url);
        $category_uri = $a[3];
        $category_uri = strtok($category_uri, '?');
        $part_uri = $a[4];
        $part_uri = strtok($part_uri, '?');
        $category = $this->categories_model->get_categories_by_uri($this->clang, $category_uri);
        if (empty($category)) throw_on_404();
        $categories[$category->step] = $category;
        $this->tree_category($category, $categories);
        $part = $this->parts_model->get_parts_uri($this->clang, $part_uri);
        if (empty($part)) throw_on_404();
        $part->images = $this->db->where('parts_id', $part->id)->order_by('sorder ASC, id DESC')->get('parts_img')->result();
        if ($this->clang == 'RU') {
            $condition = ['1' => 'Новое', '2' => 'Аналог', '3' => 'БУ'];
        } elseif ($this->clang == 'RO') {
            $condition = ['1' => 'Nou', '2' => 'Analogic', '3' => 'La mana a doua'];
        } else {
            $condition = ['1' => 'New', '2' => 'Analogue', '3' => 'Use'];
        }
        $part->condition = $condition[$part->condition];
        $part->part_number = explode(',', $part->part_number);
        $part->part_number = $part->part_number[0];
        $this->data['part'] = $part;

        $models = $this->db->where('parts_id', $part->id)->get('parts_model')->result();
        $this->data['models'] = $models;
        $this->data['category'] = $category;

        $this->load->helper('cookie');
        $response['result'] = get_cookie('produse_views');
        $response['status'] = 'ok';
        if (strpos($response['result'], $part->id) !== false) {
        } else {
            $response['result'] = $response['result'] . ", " . $part->id;
            $cookie = array(
                'name' => 'produse_views',
                'value' => $response['result'],
                'expire' => 3600 * 24 * 7
            );
            set_cookie($cookie);
            $response['status'] = 'ok';
        }
        $produse_views = explode(', ', $response['result']);
        $produse_views = array_reverse($produse_views);
        $product_views = array();
        $i = 0;
        foreach ($produse_views as $view) {
            if (!empty($view)) {
                $product_views[] = $this->parts_model->get_parts_by_id($this->clang, $view);
                if ($i == 6) {
                    break;
                }
                $i = $i + 1;
            }
        }
        $this->data['parts_views'] = $product_views;
        $this->data['lang_urls'] = array(
            'ru' => $page->uriRU . '/' . $category->uriRU . '/' . $part->uriRU,
            'ro' => $page->uriRO . '/' . $category->uriRO . '/' . $part->uriRO,
//            'en' => $page->uriEN.'/'.$category->uriEN.'/'.$part->uriRU,
        );
        $this->loadOGImgData($part);
        $this->_load_main_page($part);
        $this->data['inner_view'] = 'pages/parts/item';
        $this->_render();
    }

    function tree_category($category, $categories)
    {
        if ($category->parent_id != 0) {
            $category = $this->categories_model->get_categories_by_id($this->clang, $category->parent_id);
            $categories[$category->step] = $category;
            $this->tree_category($category, $categories);
        }
        if ($category->parent_id == 0) {
            $categories = array_reverse($categories);
            $this->data['tree_categories'] = $categories;
        }
    }

}
