<?php require(PROTECT);

class Products_model Extends Model {
	function products_model() {
		parent::model();
		$this->handler = $this->db->handler;
		#echo 'Product Model Instantiated';
	}

	function test() {
		echo "<br>Products model works<br>";
		echo $this->db->test();
	}

	function get_products($limit, $start) {
		$start = ($start * 15);

		$sql = "SELECT * FROM tss82_products LIMIT ".$start.", ".$limit;

		#$sth = $this->handler->prepare($sql);
		#$sth->execute(array($limit));
		$sth = $this->handler->query($sql);

		return $sth->fetchAll();
	}

	function get_product_data($product_id) {
		$product_id = (int) $product_id;
		#echo $product_id;
		$sql = "SELECT * FROM tss82_products WHERE product_id = $product_id";
		$sth = $this->handler->query($sql);

		return $sth->fetch(PDO::FETCH_ASSOC);
	}

	function get_num_products() {
		$sql = "SELECT COUNT(*) FROM tss82_products";
		$sth = $this->handler->query($sql);
		
		$count = $sth->fetchColumn();

		return $count;
	}

	function create_item($product_data=null) {
		# Lets retrieve our variables
		
		$description = '[b]Height:[/b] 10 inches [br]	
[b]Includes:[/b] Stem, Base, Tongs, Tray, Hose, Bowl, Grommets [br]						[b]Tags:[/b] {TAGS} [br]

[b]Summary:[/b] 
[br]
[br]

The Khalil Mamoon "Ozomah" stands at 34 inches tall and will rock your socks off!

[br]
[br]

The Ozomah hookah has a two tone stem (gold and silver) and you can choose from either a green decorated glass base with matching green hose or a clear glass base with gold stripes with either a black or brown 74 inch signature KM hose (as seen in the picture)';

		
		$product_data = array(
			'product_name' => $product_data['product_name'],
			'product_description' => $product_data['product_description'],
			'product_quantity'	=>	1000,
			'product_time'	=>	time(),
			'product_price'	=> $product_data['product_price'],
			'product_markdown'	=> $product_data['product_markdown'],
			'product_show_markdown'	=> $product_data['product_show_markdown'],
			'product_tags'	=> $product_data['product_tags']
		);	

		$sql = "INSERT INTO tss82_products (
				product_name,
				product_description,
				product_quantity,
				product_time,
				product_price,
				product_markdown,
				product_show_markdown,
				product_tags
			) VALUES (
				:product_name,
				:product_description,
				:product_quantity,
				:product_time,
				:product_price,
				:product_markdown,
				:product_show_markdown,
				:product_tags
			)";

		$sth = $this->handler->prepare($sql);
		$execute_status = $sth->execute($product_data);
		#foreach($item_data as $key => $value) {
		#	$sth->bindParam(':'.$key, $value);
		#	echo '<b>:'.$key.'</b> bound as <b>'.$value.'</b>';
		#}
		#return true;

		#echo $product_tags;
		$return = array();
		
		if($execute_status) {
			# Our stuff worked.. Lets get the data now.
			$sql = "SELECT * FROM tss82_products ORDER BY product_id DESC";
			$sth = $this->handler->prepare($sql);
			$sth->execute();
			
			# Lets grab the row
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			
			# Lets return the product id
			$return['product_id'] = $row['product_id'];
			$return['success'] = true;
		} else {
			$return['success'] = false;
		}

		return $return;
	}
	
	function edit_product($product_data=null) {
		# Lets retrieve our variables
		$product_id = $product_data['product_id'];
		
		$product_data = array(
			'product_name' => $product_data['product_name'],
			'product_description' => $product_data['product_description'],
			'product_price'	=> $product_data['product_price'],
			'product_markdown'	=> $product_data['product_markdown'],
			'product_show_markdown'	=> $product_data['product_show_markdown'],
			'product_tags'	=> $product_data['product_tags'],
			'product_id'	=> $product_id
		);	

		$sql = "UPDATE tss82_products 
				SET
					product_name = :product_name,
					product_description = :product_description,
					product_price = :product_price,
					product_markdown = :product_markdown,
					product_show_markdown = :product_show_markdown,
					product_tags = :product_tags
				WHERE product_id = :product_id";

		$sth = $this->handler->prepare($sql);
		$execute_status = $sth->execute($product_data);
	
		
		return $execute_status;
	}
	
	function delete_product($product_id) {
		$sql = 'DELETE FROM tss82_products
				WHERE product_id = '.$product_id;
		$sth = $this->handler->prepare($sql);
		$execute_status = $sth->execute();
		
		return $execute_status;
	}
	
	function create_category($category_data) {
		$sql = 'INSERT INTO tss82_product_categories (
		
		) VALUES (
			
		
		)';
	}
	
	function add_product_image($product_image_url, $product_id) {
		# The SQL
		$sql = 'UPDATE tss82_products
				SET product_img_path = "'.$product_image_url.'"
				WHERE product_id = '.$product_id;
		
		$sth = $this->handler->prepare($sql);
		return $sth->execute();
	}
	
	function create_template($template_data) {
		$template_name = $template_data['name'];
		$template_content = $template_data['content'];
		
		$sql = 'INSERT INTO tss82_templates (
					template_name,
					template_content,
					template_time
				) VALUES (
					"'.$template_name.'",
					:template_content,
					'.time().'
				)';
		
		$sth = $this->handler->prepare($sql);
		$execute_status = $sth->execute(array('template_content' => $template_content));
		
		return $execute_status;
	}
	
	function get_template($template_name) {
		$sql = 'SELECT * FROM tss82_templates
				WHERE template_name LIKE "'.$template_name.'"
		';
		
		$sth = $this->handler->query($sql);
		$return = $sth->fetch();
		
		return $return;
	}
	
	function get_templates() {
		$sql = "SELECT * FROM tss82_templates";
		$sth = $this->handler->query($sql);
		$return = $sth->fetchAll();
		return $return;
	}
}