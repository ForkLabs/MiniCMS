<?php require(PROTECT);
	
	class Productmanager extends Controller {
		function productmanager() {
			# We can load other resources here
			parent::controller();
			$this->products = $this->model('products_model');
			header("HTTP/1.1 200 OK");
		}
		
		function index() {
			echo "works";
		}
		
		function list_products($limit=null, $start=null) {
			$return = array();

			if(is_null($limit))
				$limit = 15;
			if(is_null($start))
				$start = 0;

			if($start != 0) {
				$start = ($start - 1);
			}
			
			echo json_encode($this->products->get_products($limit, $start));
		}

		function count_products() {
			echo $this->products->get_num_products();
		}

		function test($var1, $var2, $var3) {
			echo "Test Controller ".$var1.", ".$var2.", and ".$var3;
		}

		function create_product() {
			$product_data = array(
				'product_name' 			=> $_POST['product_name'],
				'product_tags' 			=> $_POST['product_tags'],
				'product_description' 	=> $_POST['product_description'],
				'product_show_markdown' => $_POST['product_show_markdown'],
				'product_markdown'		=> $_POST['product_markdown'],
				'product_price'			=> $_POST['product_price']
			);
			
			if($product_data['product_show_markdown'] == 'true')
				$product_data['product_show_markdown'] = 1;
			else
				$product_data['product_show_markdown'] = 0;
			
			$json_return = array();
			$return = $this->products->create_item($product_data);
			
			if($return['success']) {
				$json_return['product_id'] = $return['product_id'];
				$json_return['success'] = true;
			} else {
				$json_return['success'] = false;
			}
			
			echo json_encode($json_return);
		}
		
		function edit_product() {
			$product_data = array(
				'product_name' 			=> $_POST['product_name'],
				'product_tags' 			=> $_POST['product_tags'],
				'product_description' 	=> $_POST['product_description'],
				'product_show_markdown' => $_POST['product_show_markdown'],
				'product_markdown'		=> $_POST['product_markdown'],
				'product_price'			=> $_POST['product_price'],
				'product_id'			=> $_POST['product_id']
			);
			
			if($product_data['product_show_markdown'] == 'true')
				$product_data['product_show_markdown'] = 1;
			else
				$product_data['product_show_markdown'] = 0;
			
			$return = $this->products->edit_product($product_data);
			
			$json_return = array();
			
			if($return) {
				$json_return['product_id'] = $_POST['product_id'];
				$json_return['success'] = true;
			} else {
				$json_return['success'] = false;
			}
			
			echo json_encode($json_return);
		}
		
		# This function creates catagories
		function create_category() {
			$category_data = array();
			
			$catagory['category_name'] = $_POST['category_name'];
			$catagory['category_tags'] = $_POST['category_tags'];
			
			$return = $this->products->create_category($category_data);
			$json_return = array();
			
			if($return['success']) {
				$json_return['success'] = true;
				$json_return['alert'] = "SUCCESS! Category successfully created";
			} else {
				$json_return['success'] = false;
				$json_return['alert'] = "FAILURE! Category was not created. Contact your Server Administrator.";
			}
			
			echo json_encode($json_return);
		}
		
		function photo_upload() {
			#print_r($_FILES);
			$product_id = $_POST['product_id'];
			$product_photo = $_FILES['product_photo'];
			
			$product_photo['name'] = time().'_'.$product_photo['name'];
			$product_tmp_location = $product_photo['tmp_name'];
			
			
			$new_photo_url = '/assets/product_img/'.$product_photo['name'];
			$new_folder = '/home/webmaster/www/tss82vape.com/public_html'.$new_photo_url;
			
			if(move_uploaded_file($product_tmp_location, $new_folder)) {
				if($this->products->add_product_image($new_photo_url, $product_id)) {
					echo 'SUCCESS';
				} else {
					echo 'FAILURE';
				}
			} else {
				echo "File not uploaded.";			
			}
		}
		
		function delete_product() {
			$product_id = $_POST['product_id'];
			
			$return = $this->products->delete_product($product_id);
			
			# # Were we successful?
			if($return) {
				echo "SUCCESS";
			} else {
				echo "FAILURE";
			}
		}
		
		function create_template() {
			$json_return = array();
			$description = array();
		
			$template['content'] = $_POST['template_content'];
			$template['name'] = $_POST['template_name'];
			
			$return = $this->products->create_template($template);
			
			if($return) {
				$json_return['status'] = "SUCCESS";
			} else {
				$json_return['status'] = "FAILURE";
			}
			
			echo json_encode($json_return);
		}
		
		function get_template($template_name) {
			# Lets retrieve the template
			#echo 'hi';
			$template_name = preg_replace('/\%20/', ' ', $template_name);
			$return = $this->products->get_template($template_name);
			
			echo $return['template_content'];
		}
		
		function get_templates() {
			$templates = $this->products->get_templates();
			
			foreach($templates as $template) {
				echo '<option value="'.$template['template_name'].'">'.$template['template_name'].'</option>';
			}
		}
	}