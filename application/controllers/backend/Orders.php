<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Orders extends BackEndController
	{
		protected $add;
		protected $index_title;
		protected $title;
		protected $success_add;
		protected $success_update_order;
		protected $success_edit;
		protected $success_delete;

		public function __construct()
		{
			parent::__construct(__CLASS__);

			$this->add = 'Добавить заказ';
			$this->index_title = 'Заказы';
			$this->success_add = 'Вы успешно добавили новый заказ!';
			$this->success_update_order = 'Вы успешно обновили порядок отображения!';
			$this->success_edit = 'Вы успешно обновили заказ!';
			$this->success_delete = 'Вы успешно удалили заказ!';

			$this->data['title'] = $this->index_title;
			$this->data['add'] = $this->add;
			$this->load->model('orders_model');
			$this->orders_model->changeTable('orders');
		}

		public function index()
		{
			init_load_img($this->main_page);

			$objects = $this->orders_model->find();

			$this->data['inner_view'] = $this->index_view;
			$this->data['objects'] = $objects;
			$this->load->vars($this->data);
			$this->load->view($this->main_layout);
		}

		public function put()
		{
			check_if_POST();

			$post = array();

			init_load_img($this->main_page);

			try {
				foreach ($_POST as $index => $item) {
					$post[$index] = $this->input->post($index, TRUE);
				}

				if (!$this->orders_model->put($post)) {
					throw new Exception('Ошибка записи данных в таблицу: ' . $this->main_page);
				}

				$_SESSION['success'] = $this->success_add;
			} catch (Exception $e) {
				log_message('error', $e->getMessage());
				$errors[] = 'Выброшено исключение : ' . $e->getMessage();
				$_SESSION['error'] = $errors;
			}

			redirect($this->path);
		}

		public function update_order()
		{
			check_if_POST();

			try {
				$post = $this->input->post('so');

				if (empty($post) || !is_array($post)) {
					throw new Exception('Ошибка в полученных данных!');
				}

				if (!$this->orders_model->update_sorder($post)) {
					throw new Exception('Ошибка записи данных в таблицу: ' . $this->main_page);
				}

				$_SESSION['success'] = $this->success_update_order;
			} catch (Exception $e) {
				$errors[] = 'Выброшено исключение : ' . $e->getMessage();
				$_SESSION['error'] = $errors;
			}

			redirect($this->path);
		}

		public function item($id = 0)
		{
			$id = (int)$id;

			init_load_img($this->main_page);

			$item = $this->orders_model->findFirst($id);
			if (empty($item)) throw_on_404();

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				try {
					foreach ($_POST as $index => $post_data) {
						$post[$index] = $this->input->post($index, TRUE);
					}
                    $post['updated'] = date('Y-m-d H:i:s', strtotime('+2 hours'));
					if (isset($post['products'])) {
						foreach ($post['products'] as $key => $product) {
							if ($product['price'] == 0)
								$this->db->where('id', $key)->delete('orders_products');
							else
								$products[] = ['id' => $key, 'qty' => $product['qty'], 'total' => $product['qty']*$product['price']];
						}

						$this->db->update_batch('orders_products', $products, 'id');
						$this->db->where('id', $id)->update('orders', ['updated' => date('Y-m-d H:i:s')]);
					}

					unset($post['products']);

					if (!empty($post))
						if (!$this->orders_model->update($post, $id)) {
							throw new Exception('Ошибка записи данных в таблицу: ' . $this->main_page);
						}

					$_SESSION['success'] = $this->success_edit;
				} catch (Exception $e) {
					log_message('error', $e->getMessage());
					$errors[] = 'Выброшено исключение : ' . $e->getMessage();
					$_SESSION['error'] = $errors;
				}

				$item = $this->orders_model->findFirst($id);
			}

			$this->data['inner_view'] = $this->item_view;
			$this->data['title'] = 'Заказ #' .$item->id;
			$this->data['parent_url'] = $this->path;
			$this->data['parent_title'] = $this->index_title;
			$this->data['item'] = $item;
			$this->data['products'] = $this->orders_model->orderProducts($item->id, 'EN');
			$this->load->vars($this->data);
			$this->load->view($this->main_layout);
		}

		public function delete($id = false)
		{
			$id = (int)$id;

			$item = $this->orders_model->findFirst($id);

			if (empty($item)) throw_on_404();

			try {
				if (!$this->orders_model->delete($id)) {
					throw new Exception('Ошибка удаления данных из таблицы: ' . $this->main_page);
				}
				$_SESSION['success'] = $this->success_delete;
			} catch (Exception $e) {
				$errors[] = 'Выброшено исключение : ' . $e->getMessage();
				$_SESSION['error'] = $errors;
			}

			redirect($this->path);
		}
	}