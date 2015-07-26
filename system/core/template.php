<?php require(PROTECT);
	class YU_Template {
		
		function load($template, $data=NULL, $datas) {
			if(file_exists(TEMPLATES . $template . '.php'))
			{
				
				define('TEMPLATE_DATA', $data);
				define('ALLDATA', serialize($datas));
				require TEMPLATES . $template . '.php';
			}
			else
			{
				echo "template ".$template." not found.";
			}
		}
	}