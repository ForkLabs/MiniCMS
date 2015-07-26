<?php require(PROTECT);?>

<div id="app-product_manager">
	
	<?php
	define('PRODUCT_MANAGER_TITLE', 'Browse Products');
	require(VIEWS.'product_manager/product_manager_header.php'); 
	?>

	<div id="app-product_manager-toolbar" class="app-toolbar">
		<a href="/apps/product_manager/add" id="app-product_manager-toolbar-add_product" class="product_manager-toolbar-button">
			Add Product
		</a>
	</div>

	<div id="app-product_manager-pagination" class="app-pagination">
		<div id="app-product_manager-pagination-back" class="app-product_manager-pagination-buttons">
			<a onClick="products.changePage('back');">
				Back
			</a>
		</div>
		<div id="app-product_manager-pagination-next" class="app-product_manager-pagination-buttons">
			<a onClick="products.changePage('next');">
				Next
			</a>
		</div>

		<ul id="app-product_manager-pagination-list" class="app-pagination_list">
			<!-- We dynamically load our page numbers -->
		</ul>
	</div>

	<div id="app-product_manager-products_list">
		<ul id="app-product_manager-products_list-ul">
			<div id="app-product_manager-products_list-noProducts">
				You have not added any products yet.
			</div>

			<div id="app-product_manager-products_list-result_details">
				Returned <b><span id="numitemsperpage">15</span></b> results. <span id="numpagesretrieved">0</span> pages
			</div>
			<div id="app-product_manager-products_list-result_products">
				<!-- Products are loaded here -->
				<script>
					products.load_products(1);
				</script>
			</div>
		</ul>
	</div>
</div>