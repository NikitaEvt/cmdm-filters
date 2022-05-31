<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('newthumbs')) {
	function newthumbs($photo = '', $dir = '', $width = 0, $height = 0, $zc = 0)
	{
		require_once(realpath('application') . '/third_party/imres/phpthumb.class.php');

		$result = is_dir(realpath('public/' . $dir) . '/thumbs');
		if ($result) {
			$prevdir = $dir . '/thumbs';
		} else {
			if (mkdir(realpath('public/' . $dir) . '/thumbs', 0755, true)) {
				$prevdir = $dir . '/thumbs';
			} else {
				return 'error 1';
			}
		}

		$timg = realpath('public/' . $dir) . '/' . $photo;
		//return $timg;
		if (!is_file($timg)) {
			$source = realpath('public/i') . '/null.png';
			$dest = realpath('public/i') . '/no_image_' . $width . '_' . $height . '_' . $zc . '.jpg';
			//return $dest;
			$dest2 = '/public/i/no_image_' . $width . '_' . $height . '_' . $zc . '.jpg';
			if (is_file($dest)) return $dest2;
			$phpThumb = new phpThumb();
			$phpThumb->setSourceFilename($source);
			if (!empty($width)) $phpThumb->setParameter('w', $width);
			if (!empty($height)) $phpThumb->setParameter('h', $height);
			$phpThumb->setParameter('q', 100);
			$phpThumb->setParameter('f', 'png');
			if (!empty($zc)) {
				$phpThumb->setParameter('zc', '1');
			}
			$img = '';
			if ($phpThumb->GenerateThumbnail()) {
				if ($phpThumb->RenderToFile($dest)) {
					return $dest2;
				}
			}
		}

		$version = $width . 'x' . $height . 'x' . $zc;

		if (!empty($version)) {
			$result = is_dir(realpath('public/' . $dir) . '/thumbs/version_' . $version);
			if ($result) {
				$prevdir = $dir . '/thumbs/version_' . $version;
			} else {
				if (mkdir(realpath('public/' . $dir) . '/thumbs/version_' . $version)) {
					$prevdir = $dir . '/thumbs/version_' . $version;
				} else {
					return 'error 1';
				}
			}
		}
		$va1 = explode('.', $photo);
		$ext = end($va1);

		$timg = realpath('public/' . $dir) . '/' . $photo;
		$catimg = realpath('public/' . $prevdir) . '/' . $photo;

		if (is_file($timg) && !is_file($catimg)) {
			$opath1 = realpath('public/' . $dir) . '/';
			$opath2 = realpath('public/' . $prevdir) . '/';
			$dest = $opath2 . $photo;
			$source = $opath1 . $photo;

			$phpThumb = new phpThumb();
			$phpThumb->setSourceFilename($source);

			if (!empty($width)) $phpThumb->setParameter('w', $width);
			if (!empty($height)) $phpThumb->setParameter('h', $height);
			if (!empty($height)) $phpThumb->setParameter('q', 100);
			if ($ext == 'png') $phpThumb->setParameter('f', 'png');
			if (!empty($zc)) {
				$phpThumb->setParameter('zc', '1');
			}
			$phpThumb->setParameter('q', 100);
			if ($phpThumb->GenerateThumbnail()) {
				if ($phpThumb->RenderToFile($dest)) {
					$img = '/public/' . $prevdir . '/' . $photo;
				} else {
					return 'error 3';
				}
			}

		} elseif (is_file($catimg)) {
			$img = '/public/' . $prevdir . '/' . $photo;
		} else {
            $img = '/public/i/null.png';
		}

		return $img;
	}
}

if (!function_exists('array_categories_parse')) {
    function array_categories_parse(&$objects, $parent = 0)
    {
        $category_tree = array();
        foreach ($objects as $object) {
            if ($object->parent_id == $parent) {
                $children = array_categories_parse($objects, $object->id);

                $category_tree[] = [
                    'id' => $object->id,
                    'title' => $object->title,
                    'uri' => $object->uri,
                    'children' => $children,
                ];

            }
        }
        return $category_tree;
    }
}
if (!function_exists('categories_tree_parts')) {
    function categories_tree_parts($bd ,$categories_tree, $categories_arr){
        foreach ($categories_tree as $item){
            $bd->select("id, parent_id");
            $bd->where('parent_id', $item->id);
            $bd->where('isShown', 1);
            $categories = $bd->get('categories')->result();
            $categories_arr[] = $item->id;
            if (!empty($categories)){
                $categories_arr = categories_tree_parts($bd, $categories, $categories_arr);
            }
        }
        return $categories_arr;
    }
}

if (!function_exists('init_load_img')) {
	function init_load_img($dir)
	{
		if (!is_dir(realpath('public') . '/' . $dir)) {
			mkdir(realpath('public') . '/' . $dir);
		}
		$CI =& get_instance();
		$config['upload_path'] = realpath("public") . '/' . $dir;
		$config['allowed_types'] = 'jpg|jpeg|gif|png|pdf|doc';
		$config['encrypt_name'] = TRUE;
		$CI->load->library('upload', $config);
		$CI->load->initialize($config);
	}
}

if (!function_exists('init_load_files')) {
	function init_load_files($dir)
	{
		if (!is_dir(realpath('public') . '/' . $dir)) {
			mkdir(realpath('public') . '/' . $dir);
		}
		$CI =& get_instance();
		$config['upload_path'] = realpath("public") . '/' . $dir;
		$config['allowed_types'] = 'pdf|doc|docx';
		$config['encrypt_name'] = TRUE;
		$CI->load->library('upload', $config);
	}
}

if (!function_exists('dump')) {
	function dump($data, $continue = false)
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		if (!$continue) {
			die();
		}
		return true;
	}
}

if (!function_exists('throw_on_404')) {
	function throw_on_404()
	{
		header("HTTP/1.0 404 Not Found");
		show_404();
		exit();
	}
}

if (!function_exists('check_if_POST')) {
	function check_if_POST()
	{
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			throw_on_404();
		}
	}
}

if (!function_exists('check_if_GET')) {
	function check_if_GET()
	{
		if (empty($_GET)) {
			throw_on_404();
		}
	}
}

if (!function_exists('get_prefered_lang')) {
	function get_prefered_lang()
	{
		$CI = &get_instance();
		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
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
}

if (!function_exists('get_lang')) {
	function get_lang($up = FALSE)
	{
		return ($up) ? strtoupper($_SESSION['lang']) : strtolower($_SESSION['lang']);
	}
}

if (!function_exists('select_language')) {
    function select_language($lang = FALSE, $langs_array = FALSE)
    {
        if (empty($lang) || empty($langs_array)) {
            throw_on_404();
        }
        $CI = &get_instance();
        $protocol = (isset($_SERVER['HTTPS']) ? "https" : "http");
        $host = '://' . $_SERVER['HTTP_HOST'];
        $get_data = $_SERVER['QUERY_STRING'];
        $current_lang = strtolower($lang);
        $lang_title = array();
        foreach ($langs_array as $lang => $item) {

            switch ($lang) {
                case 'ru':
                    $name = 'Ru';
                    break;
                case 'ro':
                    $name = 'Ro';
                    break;
                case 'en':
                    $name = 'En';
                    break;
            }
            $lang_title[$lang] = $name;
        }

        $CI->load->view('layouts/pages/langs',
            array('langs_array' => $langs_array,
                'protocol' => $protocol,
                'host' => $host,
                'get_data' => $get_data,
                'lang_title' => $lang_title,
                'current_lang' => $current_lang));
    }
}

if (!function_exists('reArrayFiles')) {
	function reArrayFiles($file)
	{
		$file_ary = array();
		$file_count = count($file['name']);
		$file_key = array_keys($file);

		for ($i = 0; $i < $file_count; $i++) {
			foreach ($file_key as $val) {
				if (isset($file[$val][$i])) {
					$file_ary[$i][$val] = $file[$val][$i];
				}
			}
		}
		return $file_ary;
	}
}

if (!function_exists('transliteration')) {
	function transliteration($str)
	{
        $tr = array(
            "А" => "A", "Б" => "B", "В" => "V", "Г" => "G",
            "Д" => "D", "Е" => "E", "Ё" => "E", "Ж" => "J", "З" => "Z", "И" => "I",
            "Й" => "Y", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N", 'ă' => 'a', 'Ă' => 'A', 'ţ' => 't', 'Ţ' => 'T', 'ş' => 's', 'Ş' => 'S',
            "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T",
            "У" => "U", "Ф" => "F", "Х" => "H", "Ц" => "TS", "Ч" => "CH", "î" => "i", "Î" => "I", "," => "", "№" => "", "ț" => "t", "Ț" => "T", "ș" => "s", "Ș" => "S",
            "Ш" => "SH", "Щ" => "SCH", "Ъ" => "", "Ы" => "YI", "Ь" => "",
            "Э" => "E", "Ю" => "YU", "Я" => "YA", "а" => "a", "б" => "b",
            "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ё" => "e", "ж" => "j",
            "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
            "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
            "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
            "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y", "?" => "", "+" => '',
            "ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya", " " => "_", "(" => "", ")" => "", "*" => "_", "°" => "_grade",
            "." => "", "!" => "", "\\" => "", "/" => "-", "'" => "", "»" => "", "«" => "", "&quot;" => "", "'" => "", "\"" => "", "&" => "i", "%" => "",
            "$" => 'usd', "€" => 'eur', '#' => ''
        );
        $str = strtolower(strtr($str, $tr));
        $str = mb_convert_encoding($str, 'UTF-8','auto');
        return $str;
	}
}

if (!function_exists('get_url_pattern')) {
	function get_url_pattern()
	{
		$url = preg_replace('/\&page=.*/', '', $_SERVER["REQUEST_URI"]);
		/* Заносим переменную page в ГЕТ */
		if (!preg_match('/\?/', $_SERVER["REQUEST_URI"])) {
			$urlPattern = $url . '?&page=(:num)';
		} else {
			$urlPattern = $url . '&page=(:num)';
		}
		return $urlPattern;
	}
}

if (!function_exists('is_assoc')) {
	function is_assoc($var)
	{
		return is_array($var) && array_diff_key($var, array_keys(array_keys($var)));
	}
}

if (!function_exists('get_youtube_id')) {
	function get_youtube_id($url)
	{
		preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
		$youtube_id = $match[1];
		return $youtube_id;
	}
}

if (!function_exists('formatSizeUnits')) {
	function formatSizeUnits($bytes)
	{
		if ($bytes >= 1073741824) {
			$bytes = number_format($bytes / 1073741824, 2) . ' GB';
		} elseif ($bytes >= 1048576) {
			$bytes = number_format($bytes / 1048576, 2) . ' MB';
		} elseif ($bytes >= 1024) {
			$bytes = number_format($bytes / 1024, 2) . ' KB';
		} elseif ($bytes > 1) {
			$bytes = $bytes . ' bytes';
		} elseif ($bytes == 1) {
			$bytes = $bytes . ' byte';
		} else {
			$bytes = '0 bytes';
		}

		return $bytes;
	}
}

if (!function_exists('numberFormat')) {
	function numberFormat($number, $zecimal = 2)
	{
		return number_format((float)$number, $zecimal, '.', ' ');
	}
}


if (!function_exists('codCrypt')) {
	function codCrypt($string, $action = true)
	{
		// Инициализируем даныне
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = '0jWLPvrk%|(4~OglNl;+Z+GL_UpWi:TWzV33C@l>4m0bASR}AC)mW!g6w<C[LgMz';
		$secret_iv = 'dq+5F`P>MW+y!TA].P~@h&{f-gc-dB-Wa8R61(`UKgxu1GYmglVk#Gu#~;{PzN:,';
		// Преобразуем данные
		$key = hash('sha256', $secret_key);
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		// Основной скрипт
		if ($action) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		} else {
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
		return $output;
	}
}

if (!function_exists('isJson')) {
	function isJson($string)
	{
		json_decode($string);
		return (json_last_error() == JSON_ERROR_NONE);
	}
}

if (!function_exists('generatePassword')) {
	function generatePassword()
	{
		return str_shuffle(bin2hex(openssl_random_pseudo_bytes(4)));
	}
}

if (!function_exists('uri')) {
	function uri($num)
	{
		$CI = &get_instance();
		return clear($CI->uri->segment($num));
	}
}

if (!function_exists('clear')) {
	function clear($str, $type = '0')
	{
		$str = trim($str);
		if ($type == 'email') {
			if (filter_var($str, FILTER_VALIDATE_EMAIL) === false) {
				$str = "";
			}
		} else if ($type == 1 or $type == 'int') {
			$str = intval($str);
		} else if ($type == 2 or $type == 'float') {
			$str = str_replace(",", ".", $str);
			$str = floatval($str);
		} else if ($type == 3 or $type == 'regx') {
			$str = preg_replace("/[^a-zA-ZА-Яа-я0-9.,!\s]/", "", $str);
		} else if ($type == 'alias') {
			$str = preg_replace("/[^a-zA-Z0-9_,!\s]/", "", $str);
		} else if ($type == 4 or $type == 'text') {
			$str = str_replace("'", "&#8242;", $str);
			$str = str_replace("\"", "&#34;", $str);
			$str = stripslashes($str);
			$str = htmlspecialchars($str);
		} else {
			$str = strip_tags($str);
			$str = str_replace("\n", " ", $str);
			$str = str_replace("'", "&#8242;", $str);
			$str = str_replace("\"", "&#34;", $str);
			$str = preg_replace('!\s+!', ' ', $str);
			$str = stripslashes($str);
			$str = htmlspecialchars($str);
		}
		return $str;
	}
}

if (!function_exists('getRealCatChilds')) {
	function getRealCatChilds($id_parent)
	{
		$CI =& get_instance();
		$dataset = $CI->db->select('id, parent_id')->get('category')->result_array();
		$dataset = key_to_id($dataset);
		$ids = array();
		foreach ($dataset as $id => &$node) {
			if ($id_parent == $id) {
				$ids[] = $id;
				$id_parent = $id;
			} else {
				$dataset[$node['parent_id']]['childs'][$id] =& $node;
				if ($id_parent == $node['parent_id'] or in_array($node['parent_id'], $ids)) {
					$ids[] = $id;
					$id_parent = $id;
				}
			}
		}
		return $ids;
	}
}

if (!function_exists('key_to_id')) {
	function key_to_id($array)
	{
		if (empty($array)) {
			return array();
		}
		$new_arr = array();
		foreach ($array as $id => &$node) {
			$new_arr[$node['id']] =& $node;
		}
		return $new_arr;
	}
}

if (!function_exists('getRealIpAddr')) {
	function getRealIpAddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) // Определяем IP
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
}

if (!function_exists('GUID')) {
	function GUID()
	{
		if (function_exists('com_create_guid') === true) {
			return trim(com_create_guid(), '{}');
		}

		return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}
}

if (!function_exists('recDirSearch')) {
	function recDirSearch($path, $file)
	{
		global $pathArray;
		foreach (new DirectoryIterator($path) as $fileInfo) {
			if ($fileInfo->isDot()) continue;
			if ($fileInfo->isDir()) {
				recDirSearch($fileInfo->getPathname(), $file);
				continue;
			}

			if (strpos($fileInfo->getFilename(), $file) !== false) {
				$pathArray[] = $fileInfo->getPathname();
			};
		}
		return $pathArray;
	}
}

if (!function_exists('categories_tree')) {
	function categories_tree($objects, $e_path, $del_path, $parentID = 0, $on_footer = true)
	{
		foreach ($objects as $item) {
			if ($item->parent_id == $parentID) {
				$cmod = (!empty($item->isShown)) ? 'checked' : '';
				$home_views = (!empty($item->home_views)) ? 'checked' : '';
				$cmod_footer = (!empty($item->onFooter)) ? 'checked' : '';
				$self_class = 'treegrid-' . $item->id;
				$parent_class = ($parentID != 0) ? 'treegrid-parent-' . $parentID : '';
				$title = (isset($item->titleRU)) ? $item->titleRU : $item->title;
				echo '
                    <tr class="' . $self_class . ' ' . $parent_class . '" style="height: 51px;">
                        <td class="align-middle td-flex">
	                        <input style="width:50px;margin-right:15px" type="text" onkeyup="this.value=this.value.replace(/[^\d]/,\'\')" min="1"
	                        class="form-control text-center sorder display-inline" value="' . $item->sorder . '"
	                        name="so[' . $item->id . ']">
	                        <a style="font-weight: 900;"
	                            href="' . $e_path . $item->id . '">' . $title . '</a>
                        </td>
                        ';
				if ($on_footer)
				echo '
                        <td class="align-middle" >
                            <label class="mt-checkbox mt-checkbox-outline">
                                <input type="checkbox" ' . $home_views . ' value="' . $item->id . '" data-table="categories" data-col="home_views"
                                class="mine_change_check">Показать на Главной
                                <span></span>
                            </label>
                        </td>
                        <td class="align-middle" >
                            <label class="mt-checkbox mt-checkbox-outline">
                                <input type="checkbox" ' . $cmod . ' value="' . $item->id . '" data-table="categories" data-col="isShown"
                                class="mine_change_check">Показать на сайте
                                <span></span>
                            </label>
                        </td>
                        <td class="align-middle">
                            <a href="' . $e_path . $item->id . '/' . '"
                            class="btn btn-xs default btn-editable green-stripe">
                                <i class="glyphicon glyphicon-edit"></i> Редактировать
                            </a>
                                <a href="' . $del_path . $item->id . '/' . '"
                                class="btn btn-xs default btn-editable red-stripe mine_delete_row">
                                    <i class="glyphicon glyphicon-remove-circle"></i> Удалить
                                </a>
                        </td>
                    </tr>';
				categories_tree($objects, $e_path, $del_path, $item->id, $on_footer);
			}
		}
	}
}

if (!function_exists('categories_tree_with_products')) {
	function categories_tree_with_products($categories, $objects, $e_path, $del_path, $parentID = 0)
	{
		foreach ($categories as $item) {
			if ($item->parent_id == $parentID) {
				$self_class = 'treegrid-' . $item->id;
				$parent_class = ($parentID != 0) ? 'treegrid-parent-' . $parentID : '';
				echo '
                    <tr class="' . $self_class . ' ' . $parent_class . '">
                        <td colspan="7" class="align-middle"><span class="caption-subject bold font-grey-gallery uppercase">' . $item->titleEN . '</span>';
				$object = json_decode(json_encode($objects), true);
				if (in_array($item->id, array_column($object, 'category_id'))) {
					echo '
                            <a style="float:right" data-id="' . $item->id . '" class="category_ajax" href="/"><i class="fa fa-plus"></i>&nbsp;<span>Показать товары</span></a>
                        ';
				}
				echo '
                            <table class="table table-hover table-hide" style="margin-top:10px;">
                                <tr>
                                    <th class="no-padding"> Название</th>
                                    <th width="100" class="mine-center-item">На главной (новые)</th>
                                    <th width="100" class="mine-center-item">На главной (акции)</th>
                                    <th width="40" class="mine-center-item"><i class="fa fa-eye"></i></th>
                                    <th width="80" class="mine-center-item"> <i class="fa fa-cog"></i></th>
                                </tr>';

				foreach ($objects as $object) {
					$cmod1 = (!empty($object->isShown)) ? 'checked' : '';
					$cmod2 = (!empty($object->main_new)) ? 'checked' : '';
					$cmod3 = (!empty($object->main_promo)) ? 'checked' : '';
					if ($object->category_id == $item->id) {
						echo '<tr>
                                        <td class="align-middle no-padding td-flex" style="padding-left: 0">
                                        <input style="width:50px;margin-left: 0;margin-right: 15px;" type="text" onkeyup="this.value=this.value.replace(/[^\d]/,\'\')" min="1"
                                                class="form-control text-center sorder" value="' . $object->sorder . '"
                                                name="so[' . $object->id . ']">
                                        <a style="font-weight: 900;"
                                            href="' . $e_path . $object->id . '">' . $object->title . '</a></td>
                                            <td class="align-middle">
                                                <label class="mt-checkbox mt-checkbox-outline">
                                                    <input data-col="main_new" data-table="products" type="checkbox" ' . $cmod2 . ' value="' . $object->id . '"
                                                        class="mine_change_check">&nbsp;
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td class="align-middle">
                                                <label class="mt-checkbox mt-checkbox-outline">
                                                    <input data-col="main_promo" data-table="products" type="checkbox" ' . $cmod3 . ' value="' . $object->id . '"
                                                        class="mine_change_check">&nbsp;
                                                    <span></span>
                                                </label>
                                            </td>
                                        <td class="align-middle">
                                                <label class="mt-checkbox mt-checkbox-outline">
                                                    <input data-col="isShown" data-table="products" type="checkbox" ' . $cmod1 . ' value="' . $object->id . '"
                                                        class="mine_change_check">&nbsp;
                                                    <span></span>
                                                </label>
                                            </td>
                                        <td width="165" class="align-middle">
                                            <a href="' . $e_path . $object->id . '/' . '"
                                                class="btn btn-xs default btn-editable green-stripe">
                                                <i class="glyphicon glyphicon-edit"></i>
                                            </a>
                                                <a href="' . $del_path . $object->id . '/' . '"
                                                    class="btn btn-xs default btn-editable red-stripe mine_delete_row">
                                                    <i class="glyphicon glyphicon-remove-circle"></i>
                                                </a>
                                            <a href="/backend/products/copy/'.$object->id.'"
                                            class="btn btn-xs default btn-editable blue-stripe">
                                                <i class="glyphicon glyphicon-copy"></i>
                                            </a>
                                        </td>
                                    </tr>';
					}
				}
				echo '
                            </table>

                        </td>
                    </tr>';

				categories_tree_with_products($categories, $objects, $e_path, $del_path, $item->id);
			}
		}
	}
}

if (!function_exists('user_is_logged_in')) {
	function user_is_logged_in()
	{
		$user_id = @$_SESSION['user_id'];
		$name = @$_SESSION['user_name'];
		$key = @$_SESSION['user_key'];

		$lang = strtolower($_SESSION['lang']);
		if (empty($user_id) || empty($name) || empty($key)) {
			unset($_SESSION['user_id']);
			unset($_SESSION['user_name']);
			unset($_SESSION['user_key']);
			return false;
		}
		return true;
	}
}

if (!function_exists('categories_map')) {
	function categories_map($objects, $parent = 0, $type = 'class')
	{
		$result = array();
		foreach ($objects as $object) {
			$object = (object)$object;
			if ($object->parent_id == $parent) {
				$result[$object->id]['id'] = $object->id;
				$result[$object->id]['title'] = $object->title;
				if (isset($object->step))
					$result[$object->id]['step'] = $object->step;
				if (isset($object->uri))
					$result[$object->id]['uri'] = $object->uri;
				$result[$object->id]['parent_id'] = $object->parent_id;
				if (isset($object->count))
					$result[$object->id]['count'] = $object->count;
				$result[$object->id]['children'] = categories_map($objects, $object->id, $type);
			}
		}

		return $result;
	}
}

if (!function_exists('parse_categories')) {
	function parse_categories($data, $before, $checked = 0)
	{
		foreach ($data as $datum) {
			$datum = (array)$datum;
			$separator = 1 + $before;
			echo $separator;
			?>
            <option <?= ($checked == $datum['id']) ? 'selected' : '' ?> value="<?= $datum['id'] ?>">
                &nbsp;&nbsp;<?= str_pad($datum['title'], $separator, '-') ?></option>
			<?
			if (!empty($datum['children']))
				parse_categories($datum['children'], $separator, $checked);
		}
	}
}

if (!function_exists('admin_categories_map')) {
	function admin_categories_map($objects, $parent = 0)
	{

		$result = '';
		foreach ($objects as $object) {

			if ($object->parent_id == $parent) {
				$child = admin_categories_map($objects, $object->id);
				$result .= "{title:'" . $object->titleEN . "', value:" . $object->id . ", child:[" . json_encode($child, true) . "]},";
				/* $result['value'] = $object->id;
				$result['title'] = $object->titleRO;
				$result['child'] = admin_categories_map($objects, $object->id); */
			}
		}

		$result = str_replace('"', '', $result);
		$result = str_replace('\\', '', $result);

		return $result;
	}
}

if (!function_exists('admin_categories_cat_names')) {
	function admin_categories_cat_names($objects, $id = 0)
	{

		$result = array();
		foreach ($objects as $object) {

			if ($object->id == $id && $id != 0) {
				echo ' <-- ' . $object->titleEN;
				admin_categories_cat_names($objects, $object->parentID);
			}
		}
	}
}

if (!function_exists('get_submenu_with_img')) {
	function get_submenu_with_img($lang, $objects, $level_max = 999, $parent_id = 0, $current_level = 0, $parent_url = false)
	{
		if (empty($objects)) return false;

		echo '<ul>';
		foreach ($objects as $object) {
			if ($object['parentID'] == $parent_id) {
				$class = ($object['parentID'] == 0) ? 'title' : '';
				$uri = ($parent_url != false) ? $parent_url . '/' . $object['uri'] : $object['uri'];
				$src = newthumbs($object['img'], 'categories', 190, 190, '190x190x0', 0);
				if ($object['parentID'] == 0) {
					echo '<li><img class="parent-' . $object['id'] . '" src="' . $src . '" alt=""></li>';
					echo '<li data-img="' . $src . '" data-parent="' . $object['id'] . '" class="subitem ' . $class . '"><a href="/' . $lang . '/catalog/' . $uri . '">' . $object['title'];
				} else {
					echo '<li data-img="' . $src . '" data-parent="' . $object['parentID'] . '" class="subitem ' . $class . '"><a href="/' . $lang . '/catalog/' . $uri . '">' . $object['title'];
				}
				if ($current_level < $level_max && !empty($object['children'])) {
					get_submenu_with_img($lang, $object['children'], $level_max, $object['id'], ($current_level + 1), $object['uri']);
				}
				echo '</a></li>';
			}
		}
		echo '</ul>';
	}
}

if (!function_exists('get_submenu')) {
	function get_submenu($lang, $objects, $level_max = 999, $parent_id = 0, $current_level = 0, $parent_url = false)
	{
		if (empty($objects)) return false;

		echo '<ul>';
		foreach ($objects as $object) {
			if ($object['parentID'] == $parent_id) {
				$class = ($object['parentID'] == 0) ? 'title' : '';
				$uri = ($parent_url != false) ? $parent_url . '/' . $object['uri'] : $object['uri'];
				echo '<li class="' . $class . '"><a href="/' . $lang . '/catalog/' . $uri . '">' . $object['title'];
				if ($current_level < $level_max && !empty($object['children'])) {
					get_submenu($lang, $object['children'], $level_max, $object['id'], ($current_level + 1), $object['uri']);
				}
				echo '</a></li>';
			}
		}
		echo '</ul>';
	}
}

if (!function_exists('getCountryByIp')) {
	function getCountryByIp($arr = false)
	{
		require_once 'application/third_party/vendor/geoip2/vendor/autoload.php';
		require_once 'application/third_party/vendor/geoip2/vendor/maxmind-db/reader/src/MaxMind/Db/Reader.php';
		$reader = new Reader('application/third_party/vendor/geoip2/GeoLite2-Country.mmdb');

		$ip = (getRealIpAddr() == '127.0.0.1') ? '188.237.130.215' : getRealIpAddr();
		$record = $reader->get($ip);
		if (empty($record)) {
			return;
		}

		if (!empty($arr)) {
			return $record;
		}
		return $record['country']['iso_code'];
	}
}

if (!function_exists('recDirSearch')) {
	function recDirSearch($path, $file)
	{
		global $pathArray;
		foreach (new DirectoryIterator($path) as $fileInfo) {
			if ($fileInfo->isDot()) continue;
			if ($fileInfo->isDir()) {
				recDirSearch($fileInfo->getPathname(), $file);
				continue;
			}
			if (strpos($fileInfo->getFilename(), $file) !== false) {
				$pathArray[] = $fileInfo->getPathname();
			};
		}

		return $pathArray;
	}
}

if (!function_exists('reorder')) {
	function reorder($tree)
	{
		$data = [];
		foreach ($tree as $value) {
			if (isset($value[3]))
				$data[$value[1]][$value[2]][] = $value[3];
		};
		return $data;
	}
}

if (!function_exists('jstree')) {
    function jstree($data, $parent = 0)
    {
        ?>
        <ul>
            <? foreach ($data as $item) {
                if ($item->parent_id == $parent) { ?>
                    <li data-jstree='{"id":"<?=$item->id?>","icon":"fa fa-folder", "selected":<?= isset($_GET['cat']) && $_GET['cat'] == $item->id ? "true" : "false" ?>, "opened":<?= isset($_GET['category_id']) && $_GET['category_id'] == $item->id ? "true" : "false" ?>}'
                        data-id="<?= $item->id ?>" data-parent_id="<?= $item->parent_id ?>">
                        <span><?= $item->title ?></span>
                        <?= jstree($data, $item->id) ?>
                    </li>
                    <?
                } ?>
                <?
            } ?>
        </ul>
        <?php
    }
}

if (!function_exists('options_categories')) {
    function options_categories($objects, $parent = 0)
    {
        $result = array();
        foreach ($objects as $object) {
            if ($object->parent_id == $parent) {
                $result[$object->id]['id'] = $object->id;
                $result[$object->id]['title'] = $object->title;
                $result[$object->id]['parent_id'] = $object->parent_id;
                $result[$object->id]['uri'] = $object->uri;
                $result[$object->id]['children'] = options_categories($objects, $object->id);
            }
        }
        return $result;
    }
}


if (!function_exists('options_categories_parse')) {
    function options_categories_parse(&$objects, $parent = 0, $i = 0, $current = 0)
    {
        $nbsp = [];
        for ($a = 0; $a <= $i; $a++)
            $nbsp[] = '- ';

        $nbsp = implode($nbsp);

        foreach ($objects as $object) {
            if ($object['parent_id'] == $parent) {
                $cmod = ($current == $object['id'])?'selected':'';
                echo '<option '.$cmod.' value="'.$object['id'].'">'.$nbsp.$object['titleEN'].'</option>';
                if (!empty($object['children']))
                    options_categories_parse($object['children']   , $object['id'], $a, $current);
            }
        }
    }
}

if (!function_exists('array_categories_parse_bk')) {
    function array_categories_parse_bk(&$objects, $parent = 0)
    {
        $category_tree = array();
        foreach ($objects as $object) {
            if ($object->parent_id == $parent) {
                $children = array_categories_parse_bk($objects, $object->id);
                $category_tree[] = [
                    'titleEN' => $object->titleEN,
                    'id' => $object->id,
                    'parent_id' => $object->parent_id,
                    'children' => $children,
                ];
            }
        }
        return $category_tree;
    }
}


if (!function_exists('update_counts')) {
    function update_counts($objects) {
        foreach ($objects as $key => $object) {
            foreach ($object['children'] as $child => $children) {
                if ($children['count'] != 0)
                    $objects[$key]['count'] += $children['count'];
                else
                    unset($objects[$key]['children'][$child]);
            }
        }

        return $objects;
    }
}

if (!function_exists('unique_characters')) {
    function unique_characters($data) {

        $characters = [];
        foreach ($data->characters as $key => $character) {
            foreach ($character['characters'] as $id => $item) {
                $characters[$key]['characters']->{$item->character_id}->title[] = $character->title;
                $characters[$key]['characters']->{$item->character_id}->character_title = $character->character_title;
            }
        }

        $data->characters = $characters;

        return $data;
    }
}
