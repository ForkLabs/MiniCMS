/* -----------------
 *	Product Manager.JS
 * -----------------
 *
 * Author: 	Devontrae M. Walls
 * Company: ForkLabs, LLC | http://forklabsllc.com
 * Contact: contact@devontrae.com
 * For:		Tobacco Superstore #82
 *
 * --------------- */

var files;

var ProductManager = function() {
 	// The constructor
 	this.pm_url = '/productmanager/';
 	this.browser_pages = 0;
 	this.curr_browser_page = 1;
 	this.products_per_page = 15;
};

// This method loads the products on page load
ProductManager.prototype.load_products = function(page_num) {
	if(page_num == null) {
		page_num = 1;
	}

	$.get(this.pm_url+'list_products/'+this.products_per_page+'/'+page_num, function(data) {
		console.log(data);
		var li_html = '';
		for(x=0;(x<data.length);x++) {
			var product = data[x];
			var markdown_container = '<div class="app-product_manager-product_list-product_price-markdown" style="background: #696969"></div>';
			
			if(product.product_img_path == '') {
				product.product_img_path = '/assets/product_img/photo_not_available.png';
			}
			if(product.product_show_markdown == 1) {
				markdown_container = '<div class="app-product_manager-product_list-product_price-markdown">$'+product.product_markdown+'</div>';
			}
			
			li_html = li_html+'<li id="app-product_manager-products_list-product-id-'+product.product_id+'" class="app-product_manager-products_list-product"><a href="/apps/product_manager/edit/'+product.product_id+'"><div class="app-product_manager-product_list-product_wrap"><div class="app-product_manager-product_list-product_image_wrap"><img src="http://tss82vape.com'+product.product_img_path+'" class="app-product_manager-product_list-product_image" alt="http://tss82vape.com/assets/img/products/1.png" /></div><div class="app-product_manager-product_list-product_name">'+product.product_name+'</div><div class="app-product_manager-product_list-product_price">'+markdown_container+'<div class="app-product_manager-product_list-product_price-finalprice">$'+product.product_price+'</div></div></div></a></li>';
		}

		$('#app-product_manager-products_list-result_products').html(li_html);
		products.curr_browser_page = page_num;
	}, 'json');
	
	// Build the paginator
	this.buildPaginator();
};

ProductManager.prototype.changePage = function(page_num) {
	if(page_num == "next" || page_num == "back") {
		var next_page = 0;

		if(page_num == "next") {
			var next_page = this.curr_browser_page + 1;
		} else {
			var next_page = this.curr_browser_page - 1;
		}

		page_num = next_page;
	}

	this.load_products(page_num);
	this.buildPaginator();
};

// This function rebuilds our paginator element
ProductManager.prototype.buildPaginator = function() {
	var per_page = this.products_per_page;
	var that = this;
	// How many items do we have?
	$.get(this.pm_url+'count_products', function(data) {
		var num_products = parseInt(data);
		
		// Lets see how many pages we have
		var x = per_page;
		var pages = (num_products / x);
		var pages_rounded = parseInt(pages);

		if(pages_rounded < pages) {
			pages = pages_rounded + 1;
		}

		// Lets hide the next or back pages
		$('#app-product_manager-pagination-next').fadeIn();
		$('#app-product_manager-pagination-back').fadeIn();
		if(that.curr_browser_page == pages) {
			$('#app-product_manager-pagination-next').fadeOut();
		}
		if(that.curr_browser_page == 1) {
			$('#app-product_manager-pagination-back').fadeOut();
		}

		$('#numpagesretrieved').html(pages);
		$('#numitemsperpage').html(num_products);
		console.log(pages + ' pages fetched...');

		var li_html = '';
		// Lets create the page numbers
		for(x=1;x<(pages + 1);x++) {
			if(that.curr_browser_page == x) {
				var className = 'app-pagination_list-page_active';
			} else {
				var className = '';
			}

			var li_html = li_html + '<li id="app-product_manager-pagination-list-page-'+x+'" class="app-product_manager-pagination-list-li app-pagination_list-page '+className+'"><a onClick="products.changePage('+x+');">'+x+'</a></li>';
		}

		// Lets put it in the pages lol
		$('#app-product_manager-pagination-list').html(li_html);
	});
};

// This function creates the item on the database
ProductManager.prototype.submitProduct = function(method) {
	// The variables that will be passed
	var product_data = {
		product_name: $('#app-product_manager-additem_form-input-productname').val(),
		product_tags: $('#app-product_manager-additem_form-input-producttags').val(),
		product_price: $('#app-product_manager-additem_form-input-productprice').val(),
		product_show_markdown: $('#app-product_manager-additem_form-input-productshowmarkdown').is(':checked'),
		product_markdown: $('#app-product_manager-additem_form-input-productmarkdownprice').val(),
		product_description: $('#app_product_manager-additem_form-input-description').val()
	};
	
	if(method == "create") {
		var api_method = "create_product";
	} else if(method == "edit") {
		var api_method = "edit_product";
		product_data['product_id'] = $('#app_product_manager-product_id').val();
	} else {
		alert('Invalid method');
	}
	
	$.post(this.pm_url+api_method, product_data, function(data) {
		// Are we successful?
		if(data.success) {
			if(api_method == 'create_product') {
				// If we are successful, render the alert, and show the Photo box
				$('#app-products_manager-form-product_id').val(data.product_id);
				$('#app-product_manager-disable_overlay').hide();
				
				$('#alert_banner').css('background-color', 'rgb(138, 184, 91)');
				$('#alert_banner_text').html('SUCCESS! The Product was created. Edit the product to upload Photo!');
				$('#alert_banner').fadeIn();
				
				$('#app-product_manager-toolbar-add_product').attr('href', 'http://cms.tss82vape.com/apps/product_manager/edit/'+data.product_id);
			} else {
				$('#alert_banner').css('background-color', 'rgb(138, 184, 91)');
				$('#alert_banner_text').html('SUCCESS! The Product Information was changed.');
				$('#alert_banner').fadeIn();
			}
		} else {
			$('#alert_banner').css('background-color', 'red');
			$('#alert_banner_text').html('FAILURE: The server encountered an error. Please contact your Server Administrator.');
			$('#alert_banner').fadeIn();
		}
	}, 'json');
};

// This function deletes the product
ProductManager.prototype.delete_product = function(product_id) {
	var conf = window.confirm("Are you sure you want to delete this product?");
	
	if(conf == true) {
		$.post(this.pm_url+'delete_product', { product_id: product_id }, function(data) {
			if(data == "SUCCESS") {
				$('#alert_banner').css('background-color', 'rgb(138, 184, 91)');
				$('#alert_banner_text').html('You have deleted this product.');
				$('#alert_banner').fadeIn();
			} else {
				$('#alert_banner').css('background-color', 'red');
				$('#alert_banner_text').html('The product was not deleted.');
				$('#alert_banner').fadeIn();
			}
		});
	} else {
	
	}
};

ProductManager.prototype.templateSave = function(method) {
	switch(method) {
		case 'save':
			var conf = window.confirm("Are you sure you want to overwrite the current template?");
			
			if(conf) {
				
			}
		break;
		case 'new':
			var name = window.prompt("What will you name this new Template?", "New Template");
			var template_content = $('#app_product_manager-additem_form-input-description').val();
			
			// Lets send the data to server
			$.post(this.pm_url+'create_template', { template_name: name, template_content: template_content }, function(data) {
				if(data.status == 'SUCCESS') {
					alert('Template Created');
				} else {
					alert('Error in creating template! Template not saved.');
				}
			}, 'json');
		break;
	}
	
	prototype.loadTemplates();
};

ProductManager.prototype.loadTemplate = function(template_name) {
	// load the thing
	$.get(this.pm_url+'get_template/'+template_name, function(response) {
		$('#app_product_manager-additem_form-input-description').val(response);
	});
};

ProductManager.prototype.doTheThing = function() {
	// What is the value of the select box?
	var action = $('#app-product_manager-description_template-select').val();
	
	switch(action) {
		case 'save':
			products.templateSave('save');
		break;
		case 'new':
			products.templateSave('new');
		break;
		default:
			// Load template
			products.loadTemplate(action);
	}
	
	console.log(action);
};

ProductManager.prototype.loadTemplates = function() {
	$.get(this.pm_url+'get_templates', function(response) {
		$('#app-product_manager-description_template-select_data').html(response);
		conole.log(response);
	});
};

var request = new XMLHttpRequest();

ProductManager.prototype.uploadProductImage = function() {
	alert('Starting Upload.. Do not close this page until upload is complete..');
	
	var form = new FormData();
	var product_id = $('#app-products_manager-form-product_id').val();
	
	// create the form
	form.append("product_id", product_id);
	form.append("product_photo", document.getElementById('app-product_manager-form-fileselect').files[0]);
	
	request.open("POST", this.pm_url+"photo_upload");
	request.send(form);
	
	window.setTimeout(function() {
		if(request.readyState == 4) {
			if(request.response == 'SUCCESS') {
				alert('Photo Uploaded succesfully!');
			} else {
				alert('Photo not uploaded..');
			}
			console.log(request);
		}
	}, 500);
};

var products = new ProductManager();