<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients_model extends BaseModel
{
    protected $tblname = 'clients';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_clients($lang)
    {
        if (empty($lang)) return false;
        $lower = strtolower($lang);
        $this->db->select("
            id as id,
            name as name,
            email as email,
            password as password,
            phone as phone,
            active as active,
        ");
        $this->db->where('isShown', 1);
        $this->db->order_by('id DESC');
        return $this->db->get($this->tblname)->result();
    }

    public function check_email($email){
        $this->db->select(" id ");
        $this->db->where('email', $email);
        return $this->db->get($this->tblname)->row();
    }

    public function recovery($email){
        $this->db->select(" id ");
        $this->db->where('email', $email);
        return $this->db->get($this->tblname)->row();
    }

    public function login($email, $password){
        $this->db->select("*");
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        return $this->db->get($this->tblname)->row();
    }

    public function get_client_order($lang, $id)
    {
        if (empty($lang)) return false;
        $this->db->select("
            id as id,
            total as total,
            delivery_price as delivery_price,
            added as added,
        ");
        $this->db->where('client_id', $id);
        $this->db->order_by('added DESC');
        $orders = $this->db->get('orders')->result();
        if (!empty($orders)) {
            foreach ($orders as $order) {
                $this->db->select("
            id as id,
            order_id as order_id,
            product_id as product_id,
            qty as qty,
            price as price,
            total as total,
        ");
                $this->db->where('order_id', $order->id);
                $this->db->order_by('id DESC');
                $order->products = $this->db->get('orders_products')->result();

                foreach ($order->products as $products) {
                    $this->db->select("
            id as id,
            title$lang as title,
            uri$lang as uri,
            category_id as category_id,
        ");
                    $this->db->where('id', $products->product_id);
                    $products->title = $this->db->get('products')->row();
                }
            }
        }
        return $orders;

    }

    public function get_client_login($email,$password)
    {
        $this->db->select("
            id as id,
            name as name,
            email as email,
            password as password,
            phone as phone,
            active as active,
        ");
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        return $this->db->get($this->tblname)->row();
    }

    public function get_client_login_id($id)
    {
        $this->db->select("
            id as id,
            name as name,
            surname as surname,
            email as email,
            phone as phone,
            active as active,
        ");
        $this->db->where('id', $id);
        return $this->db->get($this->tblname)->row();
    }

    public function get_clients_log($post, $lang)
    {
        $pass = $post["password"];
        $email = $post["email"];
        $this->db->select("
            id as id,
            name as name,
            email as email,
            password as password,
            phone as phone,
            active as active,
        ");
        $this->db->where('password', $pass);
        $this->db->where('email', $email);
        $this->db->where('active', 1);
        $client = $this->db->get($this->tblname)->row();
        if (empty($client)) {
            $pass = $post["password"];
            $phone = substr($post["email"], -8);
            $this->db->select("
            id as id,
            name as name,
            email as email,
            password as password,
            phone as phone,
            active as active,
        ");

            $this->db->or_like('phone', $phone);
            $this->db->where('password', $pass);
            $this->db->where('active', 1);
            return $this->db->get($this->tblname)->row();
        } else {
            return $client;
        }
    }

    public function get_client($id = null)
    {
        if ($id == null) return false;
        $this->db->where('id', $id);
        $this->db->where('active', 1);
        return $this->db->get($this->tblname)->row();
    }

    public function clients_error_email($email)
    {
        if (empty($email)) return false;
        $this->db->select("
            id as id,
            email as email,
            phone as phone,
        ");
        $this->db->where('email', $email);
        return $this->db->get($this->tblname)->row();
    }

    public function clients_error_phone($phone)
    {
        if (empty($phone)) return false;
        $this->db->select("
            id as id,
            email as email,
            phone as phone,
        ");
        $this->db->or_like('phone', $phone);
        return $this->db->get($this->tblname)->row();
    }

    public function clients_addres($id)
    {
        if (empty($id)) return false;
        $this->db->select("
            id as id,
            address as address,
            home as home,
            appart as appart,
            floor as floor,
            entrance as entrance,
            code as code,
            client_id as client_id,
        ");
        $this->db->where('client_id', $id);
        $this->db->order_by('id DESC');
        return $this->db->get('clients_addresses')->row();
    }

}