<div id="app-product_manager-addimage_form-container">
	<h1 id="app-product_manager-addimage_form-title">Upload Product Photo</h1>
	
		<div id="app-product_manager-compress">
		High-Definition photos can take up to 1 hour to upload. Please use <a target="_blank" href="http://www.imageoptimizer.net/Pages/Home.aspx">ImageOptimizer</a> to compress them before uploading.
	</div>
	
	<form id="app-product_manager-addimage_form" action="/productmanager/add_photo" method="post" enctype="multipart/form-data">
			<input type="hidden" id="app-products_manager-form-product_id" value="" name="product_id" />
			<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000" />
			<input type="file" id="app-product_manager-form-fileselect" name="product_photo-file" />
	</form>
	<div id="app-product_manager-disable_overlay">
		<p id="app-product_manager-disable_overlay-statement">
			To upload a Product Photo, please Submit the above form first.
		</p>
	</div>
</div>