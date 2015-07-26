<?php require(PROTECT);?>

<div id="app-product_manager">
	
	<?php
	define('PRODUCT_MANAGER_TITLE', 'Add Product');
	require(VIEWS.'product_manager/product_manager_header.php'); 
	?>
	
		<div id="app-product_manager-toolbar" class="app-toolbar">
		<a id="app-product_manager-toolbar-add_product" style="display: ;" class="product_manager-toolbar-button">
			EDIT PRODUCT NOW
		</a>
	</div>
	
	<input id="app_product_manager-product_id" type="hidden" value="" />
	<div id="alert_banner">
		<div id="alert_banner_text">
			Alert
		</div>
	</div>
	<div id="app-product_manager-additem_form-wrap">
		<form id="app-product_manager-additem_form" action="/apps/product_manager/create/submit" method="post">
			<div class="app-product_manager-additem_form-line">
				<label for="product_name">Product Name:</label>
				<input type="text" id="app-product_manager-additem_form-input-productname" class="app-product_manager-additem_form-input" name="product_name" value="ex: Chinese Hookah (Green)" />
			</div>

			<div class="app-product_manager-additem_form-line">
				<label for="product_tags">Search Tags:</label>
				<input type="text" id="app-product_manager-additem_form-input-producttags" class="app-product_manager-additem_form-input" name="product_tags" value="ex: hookahs, chinese hookah, green" />
			</div>

			<div class="app-product_manager-additem_form-line">
				<label for="product_price">Product Price:</label>
				<span class="app-product_manager-additem_form-dollarsign">$</span><input type="text" id="app-product_manager-additem_form-input-productprice" class="app-product_manager-additem_form-input" name="product_price" value="xxxx.xx" />
			</div>


			<div id="app-product_manager-additem_form-showMarkdown-container" class="app-product_manager-additem_form-line">
				<label for="product_show_markdown">Show Markdown Price?:</label>
				<input type="checkbox" id="app-product_manager-additem_form-input-productshowmarkdown" class="app-product_manager-additem_form-checkbox" name="product_show_markdown" onClick="$('#app-product_manager-additem_form-showMarkdown_price-container').toggle('slow');" />
			</div>

			<div id="app-product_manager-additem_form-showMarkdown_price-container" style="display: none;" class="app-product_manager-additem_form-line">
				<label for="product_markdown_price">Markdown Price:</label>
				<span class="app-product_manager-additem_form-dollarsign">$</span><input type="text" id="app-product_manager-additem_form-input-productmarkdownprice" class="app-product_manager-additem_form-input" name="product_markdown_price" value="xxxx.xx" />
			</div>
			<div id="app-product_manager-description_template-wrap">
				<div id="app-product_manager-description_template-label">
					PRESETS
				</div>
				<div id="app-product_manager-description_template-select-container">
					<select id="app-product_manager-description_template-select" name="description_template">
						<option value="null">Select a Template</option>
						<optgroup id="app-product_manager-description_template-select_data">
						
						</optgroup>
						<option disabled>──────────</option>
						<option value="save" disabled>Overwrite Template</option>
						<option value="new">Save As New Template</option>
					</select>
				</div>
				<script>
					products.loadTemplates();
				</script>
				<a onClick="products.doTheThing();">Do The Thing!</a>
			</div>
			<div id="app-product_manager-additem_form-line-description" class="app-product_manager-additem_form-line">
				<textarea id="app_product_manager-additem_form-input-description" name="product_description">A simple description.</textarea>
			</div>
			<div id="output_div" style="display: none;"></div>
			<div id="app-product_manager-additem_form-line-submit" class="app-product_manager-additem_form-line">
				<input type="button" value="Submit Product" onClick="products.submitProduct('create');" id="app_product_manager-submit" />
			</div>
		</form>
	</div>
<?php include(VIEWS.'product_manager/product_photo_form.php'); ?>
</div>