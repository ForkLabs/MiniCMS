<?php require(PROTECT);
	
	# Our Apps System
	# This is what MiniCMS will use to manage Apps.

	class Apps extends Controller {
		function apps() {
			# We can load other resources here
			parent::controller();
		

			$this->products = $this->model('products_model');
		}
		
		function test($val1, $val2, $val3, $val4) {
			echo $val1 . " , " . $val2 . " , " . $val3 . " , " . $val4;
		}
		function index() {
			# Lets start off by showing a list of installed apps
			$this->view->load('minicms_header');
			$this->view->load('apps_list');
			$this->view->load('minicms_footer');
			
			$this->header_vars = new stdClass();

		}
		
		function product_manager($page=null, $function=null, $value1=null) {
			$product_manager_vars = new stdClass();
			
			error_reporting(E_ERROR);
			$this->header_vars->title = "Product Manager";
			
			$page = strtolower($page);
			$json_pages = array('search', 'create', 'retrieve', 'submit');
			
			if(in_array($json_pages, $page)) {
				# This section is for HTTP requests

				header('HTTP/1.1 200 OK');
				switch($page) {
					case 'search':
						# We receive get data from here somehow
						$search_query = $function;

						# Lets just bring in a model here
						$search_result = $this->products->search($search_query);

						$this->products->print_search($search_result);
					break;
					case 'create':
						# This is for creating new items
						if(strtolower($function) == 'submit')

						$description = "
							IGH:40CM

							1PCS/BUBBLE GLFT BOX

							12PCS/CTN

							Includes:  All Available Hookah Accessories
						";
						
						$item_data = array(
								'product_name' => 'Green Chinese Hookah',
								'product_description' => $description,
								'product_quantity'	=>	1000,
								'product_time'	=>	time(),
								'product_price'	=> 45,
								'product_markdown'	=> 75,
								'product_show_markdown'	=> 1,
								'product_tags'	=> "'hookah', 'chinese', 'chinese hookah', 'hookahsandpipes'",
							);

						if($this->products->create_item($item_data)) {
							echo 'SUCCESS';
						} else {
							echo 'FAILURE';
						}
					break;
					case 'retrieve':
						# This retrieves pagination

					break;
					case 'submit':
						# This is for editing
						$product_id = $function;

						$description = "
							IGH:40CM

							1PCS/BUBBLE GLFT BOX

							12PCS/CTN

							Includes:  Hose,Bowl,Tray,Tongs
						";
						
						$item_data = array(
								'product_name' => 'Chinese Hookah',
								'product_description' => $description,
								'product_quantity'	=>	1000,
								'product_time'	=>	time(),
								'product_price'	=> 45,
								'product_markdown'	=> 75,
								'product_show_markdown'	=> 1,
								'product_tags'	=> "hookah,chinese,chinese hookah,hookahsandpipes"
							);

						if($this->products->edit_item($product_id, $item_data)) {
							echo 'SUCCESS';
						} else {
							echo 'FAILURE';
						}
					break;
					default:
						die("Somethings not right. Idk how you got here. ):");
				}
			} else {
				# Lets output a page
				$this->view->load('minicms_header', $this->header_vars);
				
				switch($page) {
					case 'edit':
						$product_id = $function;
						$this->edit_vars = $this->products->get_product_data($product_id);
						#print_r($this->edit_vars);
						$this->view->load('product_manager/product_manager_edit', $this->edit_vars);
					break;
					case 'addproduct':
					case 'add':
					case 'new':
						$this->view->load('product_manager/product_manager_create');
					break;
					case 'browse':
					default:
						$this->view->load('product_manager/product_manager_browse');

				}

				$this->view->load('minicms_footer');
			}
		}	
	}

	
