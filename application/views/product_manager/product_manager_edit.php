<?php require(PROTECT);?>
<?php
	extract($this->vars);
	#echo $product_description;
?>
<div id="app-product_manager">
	
	<?php
	define('PRODUCT_MANAGER_TITLE', 'Edit Product');
	require(VIEWS.'product_manager/product_manager_header.php'); 
	?>
	<style type="text/css">
		#app-product_manager-toolbar-delete_product {
			background: rgb(216, 102, 102);
			right: 0px;
		}
	</style>
	<div id="app-product_manager-toolbar" class="app-toolbar">
		<a onClick="products.uploadProductImage();" id="app-product_manager-toolbar-add_product" class="product_manager-toolbar-button">
			FORCE PHOTO UPLOAD BUTTON
		</a>
		<a onClick="products.delete_product(<?=$product_id?>);" id="app-product_manager-toolbar-delete_product" class="product_manager-toolbar-button">
			Delete Product?
		</a>
	</div>
	<input id="app_product_manager-product_id" type="hidden" value="<?=$product_id?>" />
	<div id="alert_banner">
		<div id="alert_banner_text">
			Alert
		</div>
	</div>
	<div id="app-product_manager-additem_form-wrap">
		<form id="app-product_manager-additem_form" action="/apps/product_manager/edit/submit" method="post">
			<div class="app-product_manager-additem_form-line">
				<label for="product_name">Product Name:</label>
				<input type="text" id="app-product_manager-additem_form-input-productname" class="app-product_manager-additem_form-input" name="product_name" value="<?=$product_name?>" />
			</div>

			<div class="app-product_manager-additem_form-line">
				<label for="product_tags">Search Tags:</label>
				<input type="text" id="app-product_manager-additem_form-input-producttags" class="app-product_manager-additem_form-input" name="product_tags" value="<?=$product_tags?>" />
			</div>

			<div class="app-product_manager-additem_form-line">
				<label for="product_price">Product Price:</label>
				<span class="app-product_manager-additem_form-dollarsign">$</span><input type="text" id="app-product_manager-additem_form-input-productprice" class="app-product_manager-additem_form-input" name="product_price" value="<?=$product_price?>" />
			</div>

			<?php
				if($product_show_markdown == 1) {
					$checked = 'checked="checked"';
				} else {
					$checked = "";
				}
			?>
			<div id="app-product_manager-additem_form-showMarkdown-container" class="app-product_manager-additem_form-line">
				<label for="product_show_markdown">Show Markdown Price?:</label>
				<input type="checkbox" <?=$checked?> id="app-product_manager-additem_form-input-productshowmarkdown" class="app-product_manager-additem_form-checkbox" name="product_show_markdown" onClick="$('#app-product_manager-additem_form-showMarkdown_price-container').toggle('slow');" />
			</div>

			<div id="app-product_manager-additem_form-showMarkdown_price-container" style="display: none;" class="app-product_manager-additem_form-line">
				<label for="product_markdown_price">Markdown Price:</label>
				<span class="app-product_manager-additem_form-dollarsign">$</span><input type="text" id="app-product_manager-additem_form-input-productmarkdownprice" class="app-product_manager-additem_form-input" name="product_markdown_price" value="<?=$product_markdown?>" />
			</div>

			<script>
				function checkBoxCheck() {
					if($('#app-product_manager-additem_form-input-productshowmarkdown').is(':checked')) {
						atLeastOneIsChecked = true;
						$('#app-product_manager-additem_form-showMarkdown_price-container').show();
					} else {
						atLeastOneIsChecked = false;
						$('#app-product_manager-additem_form-showMarkdown_price-container').hide();
					}
				}

				checkBoxCheck();
			</script>

			<div id="app-product_manager-additem_form-line-description" class="app-product_manager-additem_form-line">
				<textarea id="app_product_manager-additem_form-input-description" name="product_description"><?=$product_description?></textarea>
			</div>
			<div id="output_div" style="display: none;"></div>
			<div id="app-product_manager-additem_form-line-submit" class="app-product_manager-additem_form-line">
				<input type="button" value="Submit Product" onClick="products.submitProduct('edit');" id="app_product_manager-submit" />
			</div>
		</form>
		
		<script>
		var input_textarea = '#app_product_manager-additem_form-input-description';
		var output_div = '#output_div';
		
		$(input_textarea).keyup( function() {
  		$(output_div).html( $( this ).val().replace(/\n/g, '<br />') );
  		//$(input_textarea).val($(output_div).html());
}); 
		</script>
		
		<?
			if($product_img_path == '')
				$photo_display = "display: none;";
		?>
		
		<div id="app-product_manager-curr_photo-wrap" style="<?=$photo_display?>">
			<img id="app-product_manager-curr_photo" src="http://www.tss82vape.com<?=$product_img_path?>" />
		</div>
		
		<?php include(VIEWS.'product_manager/product_photo_form.php'); ?>
		
		<script type="text/javascript">
			$('#app-product_manager-disable_overlay').hide();
			$('#app-products_manager-form-product_id').val('<?=$product_id?>');
			
			// Add events
			$('#app-product_manager-form-fileselect').change(function() {
				products.uploadProductImage();
			});
		</script>
	</div>
</div>