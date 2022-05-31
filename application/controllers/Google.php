<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Google extends CI_Controller
{
    private $page_id;

    public function __construct()
    {
        parent:: __construct();
    }

    public function index()
    {
        echo 'google-site-verification: googledb754420032b174e.html';
    }


}
