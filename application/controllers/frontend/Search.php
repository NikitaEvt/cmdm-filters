<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(realpath('application') . '/third_party/vendor/autoload.php');

use JasonGrimes\Paginator;

class Search extends FrontEndController
{
    private $page_id;
    private $per_page;

    public function __construct()
    {
        parent:: __construct();
        $this->page_id = 5;
        $this->per_page = 99;
        $this->load->model('products_model');
        $this->load->model('brands_model');
        $this->load->model('products_images_model');
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

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $index => $post_data) {
                $post[$index] = $this->input->post($index, true);
            }
        } else {
            $post['search'] = '';
        }

        $response =
        // start pagination
        $pagination_nr = @$_GET['page'];
        if (empty($pagination_nr) || $pagination_nr < 1) $pagination_nr = 1;
        $start = ($pagination_nr - 1) * $this->per_page;

        $products = $this->products_model->get_products_search_pag( $this->clang, $start, $this->per_page, $post['search']);
        $count = 99;

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
        if (!empty($products)) {
            $product_img = array();
            foreach ($products as $item) {
                if (!empty($item->discount_price)) $item->sale = 100 - (($item->discount_price * 100) / $item->price);
                $product_img = $this->products_images_model->getImages($item->id);
                if (!empty($product_img)) $item->img = $product_img->img; else $item->img = 'null.png';
                $item->category = $this->categories_model->get_categories_by_id($this->clang, $item->category_id);
            }
        }
        $this->data['products'] = $products;
        $this->data['search'] = $post['search'];


        $categories = $this->categories_model->get_list_categories('EN');
        $this->data['categories'] = $categories;

        $this->loadOGImgData($page);
        $this->_load_main_page($page);
        $this->data['inner_view'] = 'pages/search/index';
        $this->_render();
    }

    public function search()
    {
        check_if_POST();
        foreach ($_POST as $index => $post_data) {
            $post[$index] = $this->input->post($index, true);
        }
        $output = '';
        $response = [];
        $s = $post['search'];
        if (strlen($s) >= 3) {
            $response = $this->products_model->search_get_products($s);
            if (!empty($response)) {
                $output .= '<ul class="search__list">';
                foreach ($response as $item) {
                    $output .= '<a href="/catalog/'.$item->categoryUri.'/'.$item->uriEN.'">';
                    $output .= '<li class="search__item">'.$item->titleEN.'</li>';
                    $output .= '</a>';
                }
                $output .= '</ul>';
            } else {
//                $output = 1;
                // insert this word into search table
                $output .= '<ul class="search__list">';
                $output .= '<li class="search__item">Product not found</li>';
                $output .= '</ul>';
            }
        } else {
            $output .= '<ul class="search__list">';
            $output .= '<li class="search__item">Please enter more than 3 characters</li>';
            $output .= '</ul>';
        }
        echo $output;

    }


}
