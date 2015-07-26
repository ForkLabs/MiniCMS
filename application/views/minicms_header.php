<?php require(PROTECT);?>
<?php 
	if(!$this->vars->title) {
		$this->vars->title = "";
	}  else {
		$this->vars->title = $this->vars->title . ' | ';
	}

	#print_r($this->vars);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="robots" content="noindex" />

		<title><?=$this->vars->title?>TSS82 | MiniCMS</title>
		<link rel="stylesheet" type="text/css" href="/assets/css/global.css" />

		<script type="text/javascript" src="/assets/js/jquery-1.11.2.min.js"></script>
	</head>
	<body>
		<div id="content">

		<?php require(VIEWS."minicms_sidebar.php"); ?>

		<div id="minicms_canvas">
			<!-- Momentarily, we will just have the product management panel here -->