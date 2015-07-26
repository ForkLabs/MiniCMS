<div id="app-product_manager-header" class="app-header">
	<div id="app-product_manager-page_title" class="app-header-page_title">
		<h1><?=PRODUCT_MANAGER_TITLE?></h1>
	</div>
	<div id="app-product_manager-search" class="app-header-search">
		<form action="/apps/product_manager/search" method="post" id="app-product_manager-search_form" class="app-header-search_form">
			<input type="text" name="product_search_query" id="app-product_manager-search_field" class="app-header-search_field" />
			<input type="submit" id="app-product_manager-search_submit" class="app-header-search_submit" value="Submit" />
		</form>
	</div>
</div>

<script type="text/javascript" src="/assets/js/product_manager.js"></script>