<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends BaseModel
{
    protected $tblname = 'products';
    protected $shop_type = 'shop_type';
    protected $shop_feature = 'shop_feature';
    protected $feature_items = 'shop_feature_values';

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(['mine']);
    }

    public function findFirst($id)
    {
        $id = (int)$id;
        $this->db->select("* , 
        (SELECT categories.uriRU FROM categories WHERE products.category_id=categories.id) as categoryUri, ");
        $query = $this->db->where('id', $id)->get($this->tblname);

        return $query->row();
    }

    public function findFirstCart($id)
    {
        $id = (int)$id;
        $item = $this->db->select('id, SKU, category_id, titleEU, uriEN, price, discount_price')->where('id', $id)->get($this->tblname)->row();
        $img_product = $this->db->where('product_id', $id)->order_by('sorder ASC, id DESC')->get('products_img')->row();
        if (!empty($img_product)) {
            $item->img = $img_product->img;
        } else {
            $item->img = 'null';
        }
        return $item;
    }

    public function search_get_products($search)
    {
        $this->db->select("* , 
        (SELECT categories.uriRU FROM categories WHERE products.category_id=categories.id) as categoryUri, ");
        if (!empty($search)) {
            $this->db->or_like('titleRO', $search);
            $this->db->or_like('titleRU', $search);
            $this->db->or_like('SKU', $search);
        }
        $this->db->order_by('titleRO ASC, id DESC');
        return $this->db->get($this->tblname)->result();
    }

    public function inCategory($id = 0)
    {
        if ($id != 0) {
            $this->db->select("
            id as id,
        ");
            $this->db->where('parent_id', $id);
            $category = $this->db->get('categories')->result();
            if (!empty($category)) {
                $this->db->group_start();
                foreach ($category as $cat) {
                    $this->db->or_where('category_id', $cat->id);
                }
                $this->db->group_end();
            } else {
                $this->db->where('category_id', $id);
            }
        }
        return $this;
    }

    public function get_product_by_alternative($id){
        if (empty($id)) {
            return false;
        }
        $this->db->select("
            products_alt as products_alt,
        ");
        $this->db->where('product_id', $id);
        return $this->db->get('products_alternative')->result();
    }

    public function gat_products_alt($id)
    {
        if (empty($id)) {
            return false;
        }
        $this->db->select("
            id as id,
            product_id as product_id,
            products_alt as products_alt,
            titleRU as title,
            SKU as SKU,
            sorder as sorder,
        ");
        $this->db->where('product_id', $id);
        return $this->db->get('products_alternative')->result();
    }

    public function pagination($limit, $current = 1)
    {
        $offset = ($current * $limit) - $limit;

        $query = $this->db->order_by('sorder ASC, id DESC')->from($this->tblname);

        $total = clone $query;
        $total = $total->count_all_results();
        $query->select("* , 
        (SELECT categories.uriRU FROM categories WHERE products.category_id=categories.id) as categoryUri, ");
        $items = $query->limit($limit)->offset($offset)->get()->result();

        return ['data' => $items, 'count' => $total];
    }

    public function product_alt($sku)
    {
        if (empty($sku)) {
            return false;
        }
        $this->db->select("
            id as id,
            titleRU as title,
            SKU as SKU,
        ");
        $this->db->where('isShown', 1);
        $this->db->where('SKU', $sku);
        return $this->db->get($this->tblname)->row();
    }

    public function delete_characteristics_id($id)
    {
        $this->db->where('product_id', $id);
        return $this->db->delete('products_characteristics');
    }
    public function insert_characteristics_id($product_id,$characteristics_id)
    {
        $data = array(
            'product_id' => $product_id,
            'characteristics_id' => $characteristics_id,
        );
        return $this->db->insert('products_characteristics', $data);
    }
    public function get_prod_characteristics($type_id){
        if (empty($type_id)) return false;

        $this->db->select("
            $this->shop_type.name as type_name,
            
            $this->shop_feature.id as feature_id,
            $this->shop_feature.name_RU as feature_name,
            $this->shop_feature.sorder as feature_sorder,
            $this->shop_feature.type as feature_type,
            
            $this->feature_items.id as item_id,
            $this->feature_items.feature_id as value_feature_id,
            $this->feature_items.name_RU as item_name,
            $this->feature_items.color as color,
        ");

        $this->db->join("$this->shop_feature", "$this->shop_type.id=$this->shop_feature.type_id");
        $this->db->join("$this->feature_items", "$this->shop_feature.id=$this->feature_items.feature_id");
        $this->db->where("$this->shop_type.id", $type_id);
        $this->db->order_by("$this->shop_feature.sorder ASC, $this->shop_feature.id DESC");
        $this->db->order_by("$this->feature_items.sorder ASC, $this->feature_items.id DESC");
        return $this->db->get("$this->shop_type")->result();
    }

    public function get_front_products_home($lang)
    {
        if (empty($lang)) {
            return false;
        }
        $this->db->select("
            id,
            title$lang as title,
            uri$lang as uri,
            text$lang as text,
            SKU,
            category_id,
            brand_id,
            type_id,
            discount_price,
            price,
            best,
        ");
        $this->db->where('isShown', 1);
        $this->db->where('best', 1);
        $this->db->order_by("sorder ASC, id DESC");
        return $this->db->get($this->tblname)->result();
    }
    public function get_product_by_id($lang, $id)
    {
        $this->db->select("
            id as id,
            title$lang as title,
            uri$lang as uri,
            text$lang as text,
            SKU as SKU,
            price as price,
            discount_price as discount_price,
            category_id as category_id
        ");
        $this->db->where('isShown', 1);
        $this->db->where('on_stock >', 0);
        $this->db->where('id', $id);
        return $this->db->get($this->tblname)->row();
    }
    public function get_product_by_alternative_id($lang, $id)
    {
        $this->db->select("
            id as id,
            title$lang as title,
            uri$lang as uri,
            text$lang as text,
            SKU as SKU,
            price as price,
            discount_price as discount_price,
            category_id as category_id
        ");
        $this->db->where('isShown', 1);
        $this->db->where('on_stock >', 0);
        $this->db->where_in('id', $id);
        return $this->db->get($this->tblname)->result();
    }

    public function get_product_by_uri($lang, $url)
    {
        if (empty($lang)) {
            return false;
        }
        $this->db->select("
            id,
            title$lang as title,
            uri$lang as uri,
            uriRU as uriRU, 
            uriRO as uriRO,
            text$lang as text,
            desc$lang as desc,
            SKU,
            category_id,
            brand_id,
            type_id,
            discount_price,
            price,
            on_stock,
            dosage,
            active_substance,
            pharmaceutical_form,
            quantity_per_box,
            youtube,
            acceleration,
            is_new,
            seoTitle$lang as otitle,
            seoKeywords$lang as keywords,
            seoDesc$lang as description,
        ");
        $this->db->where('isShown', 1);
        $this->db->where('uri' . $lang, $url);
        return $this->db->get($this->tblname)->row();
    }

    public function get_products_pag($lang,$offset,$limit)
    {
        if (empty($lang)) {
            return false;
        }
        $this->db->select("
            id,
            title$lang as title,
            uri$lang as uri,
            text$lang as text,
            SKU,
            category_id,
            brand_id,
            type_id,
            discount_price,
            price,
            best,
        ");
        $this->db->where('isShown', 1);
        $this->db->where('on_stock >', 0);
        $this->db->offset($offset);
        $this->db->limit($limit);
        $this->db->order_by("sorder ASC, id DESC");
        return $this->db->get($this->tblname)->result();
    }

    public function get_products_search_pag($lang,$offset,$limit,$search)
    {
        if (empty($lang)) {
            return false;
        }
        $this->db->select("
            id,
            title$lang as title,
            uri$lang as uri,
            text$lang as text,
            SKU,
            category_id,
            brand_id,
            type_id,
            discount_price,
            price,
            best,
        ");
        if (!empty($search)) {
            $this->db->or_like('titleEN', $search);
            $this->db->or_like('SKU', $search);
        }
        $this->db->where('isShown', 1);
        $this->db->where('on_stock >', 0);
        $this->db->offset($offset);
        $this->db->limit($limit);
        $this->db->order_by("sorder ASC, id DESC");
        return $this->db->get($this->tblname)->result();
    }

    public function get_front_all_products()
    {
        $this->db->select("id, type_id");
        $this->db->where('isShown', 1);
        $this->db->where('on_stock >', 0);
        $this->db->order_by("sorder ASC, id DESC");
        return $this->db->get($this->tblname)->result();
    }

    public function get_products_pag_category($lang,$offset,$limit,$category_id)
    {
        if (empty($lang)) {
            return false;
        }
        $this->db->select("
            id,
            title$lang as title,
            uri$lang as uri,
            SKU,
            category_id,
            brand_id,
            type_id,
            discount_price,
            price,
            best,
        ");
        $this->db->where('isShown', 1);
        $this->db->where('on_stock >', 0);
        $this->db->where_in('category_id', $category_id);
        $this->db->offset($offset);
        $this->db->limit($limit);
        $this->db->order_by("sorder ASC, id DESC");
        return $this->db->get($this->tblname)->result();
    }
    public function get_front_all_products_category($category_id)
    {
        $this->db->select("id");
        $this->db->where('isShown', 1);
        $this->db->where('on_stock >', 0);
        $this->db->where_in('category_id', $category_id);
        $this->db->order_by("sorder ASC, id DESC");
        return $this->db->get($this->tblname)->result();
    }

    public function get_products_pag_brand($lang,$offset,$limit,$brand_id)
    {
        if (empty($lang)) {
            return false;
        }
        $this->db->select("
            id,
            title$lang as title,
            uri$lang as uri,
            text$lang as text,
            SKU,
            category_id,
            brand_id,
            type_id,
            discount_price,
            price,
            best,
        ");
        $this->db->where('isShown', 1);
        $this->db->where('on_stock >', 0);
        $this->db->where('brand_id', $brand_id);
        $this->db->offset($offset);
        $this->db->limit($limit);
        $this->db->order_by("sorder ASC, id DESC");
        return $this->db->get($this->tblname)->result();
    }
    public function get_front_all_products_brand($brand_id)
    {
        $this->db->select("id");
        $this->db->where('isShown', 1);
        $this->db->where('brand_id', $brand_id);
        $this->db->where('on_stock >', 0);
        $this->db->order_by("sorder ASC, id DESC");
        return $this->db->get($this->tblname)->result();
    }

    public function get_products_best($lang)
    {
        if (empty($lang)) {
            return false;
        }
        $this->db->select("
            id,
            title$lang as title,
            uri$lang as uri,
            SKU,
            category_id,
            brand_id,
            type_id,
            discount_price,
            price,
            best,
        ");
        $this->db->where('isShown', 1);
        $this->db->where('best', 1);
        $this->db->order_by("sorder ASC, id DESC");
        $this->db->limit(10);
        return $this->db->get($this->tblname)->result();
    }

    public function get_products_alternative($id)
    {
        $this->db->select("
            products_alt as products_alt,
        ");
        $this->db->where('product_id', $id);
        return $this->db->get('products_alternative')->result();
    }
}