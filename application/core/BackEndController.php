<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(realpath('application') . '/third_party/vendor/autoload.php');

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging\CloudMessage;

class BackEndController extends CI_Controller
{
    protected $site_url;
    protected $main_page;
    protected $main_layout;
    protected $index_view;
    protected $item_view;
    protected $view;
    protected $path;
    protected $a_path;
    protected $e_path;
    protected $o_path;
    protected $del_path;
    protected $data;
    protected $langs = array('RU','RO');

    private function _is_logged_in()
    {
        $admin_id = @$_SESSION['admin_id'];
        $login = @$_SESSION['login'];
        $key = @$_SESSION['admin_key'];

        if (empty($admin_id) || empty($login) || empty($key)) {
            if (uri(1) != 'backend' || uri(2) != 'login') {
                redirect("/backend/login/");
                exit();
            }
        }
    }

    private function admin_is_valid()
    {

        if (uri(1) == 'backend' && uri(2) == 'logout') {
            return false;
        }
        $admin_id = (int)@$_SESSION['admin_id'];
        $login = @$_SESSION['login'];
        $key = @$_SESSION['admin_key'];

        if (!empty($admin_id) && !empty($login) && !empty($key)) {
            try {
                $admin = $this->db->where('ID', $admin_id)->get('admins')->row();

                if (empty($admin)) {
                    throw new Exception('Admin ERROR');
                }

                if ($login != $admin->login) {
                    throw new Exception('Login ERROR');
                }

                $key_check = hash('sha512', $admin->login . $admin->password);

                if ($key != $key_check) {
                    throw new Exception('Key ERROR');
                }
                $this->data['admin_type'] = $admin->admin_type;
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                redirect("/backend/logout/");
                exit();
            }
        }
    }

    public function __construct($class)
    {
        parent::__construct();

        @session_start();

        header('Content-type: text/html; charset=utf-8');

        $this->_is_logged_in();

        $this->admin_is_valid();



        $this->data['langs'] = $this->langs;

        $this->output->set_header('X-XSS-Protection: 1; mode=block');

        $this->output->set_header('X-Frame-Options: DENY');

        $this->output->set_header('X-Content-Type-Options: nosniff');

        $this->site_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'] . '/ru/';
        $this->main_page = strtolower($class);
        $this->main_layout = 'backend/index';
        $this->folder = 'backend/' . $this->main_page . '/';
        $this->path = '/' . ADM_CONTROLLER . '/' . $this->main_page . '/';
        $this->index_view = $this->folder . 'index';
        $this->item_view = $this->folder . 'item';

        $this->a_path = $this->path . 'put/';
        $this->e_path = $this->path . 'item/';
        $this->o_path = $this->path . 'update_order/';
        $this->del_path = $this->path . 'delete/';

        $this->data['path'] = $this->path;
        $this->data['a_path'] = $this->a_path;
        $this->data['e_path'] = $this->e_path;
        $this->data['o_path'] = $this->o_path;
        $this->data['del_path'] = $this->del_path;
        $this->data['site_url'] = $this->site_url;
        $this->data['table'] = $this->main_page;
    }

}