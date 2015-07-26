<?php require(PROTECT);
	class uri {
		function getURI($sector = NULL)
		{	
			
			//retrieve our basepath
			$path = YU_PATH;
			
			//take the initial PATH
			$url = $_SERVER['REQUEST_URI'];
			$url = str_replace($path, "", $url);
			
			//creates an array from the rest of the URL
			$array_tmp_uri = preg_split('[/]', $url, -1, PREG_SPLIT_NO_EMPTY);
			
			//here we will define what is what in the URL
			$this->uri = array();
			
			if(strtolower($array_tmp_uri[0]) == 'api') {
				# Lets reform
				$this->uri['page'] = (!empty($array_tmp_uri[1])) ? $array_tmp_uri[1] :DEFAULT_CONTROLLER;
				$this->uri['action'] = (!empty($array_tmp_uri[2])) ? $array_tmp_uri[2] :DEFAULT_METHOD;
				$this->uri['var'] = (!empty($array_tmp_uri[3])) ? $array_tmp_uri[3] :'';
			} else {
				$this->uri['page'] = (!empty($array_tmp_uri[0])) ? $array_tmp_uri[0] :DEFAULT_CONTROLLER;
				$this->uri['action'] = (!empty($array_tmp_uri[1])) ? $array_tmp_uri[1] :DEFAULT_METHOD; //a var
				$this->uri['var'] = (!empty($array_tmp_uri[2])) ? $array_tmp_uri[2] :'';
			}
			
			# Lets get the arguments
			$args = explode('/',$url);
			$arg_arr = array();
			
			foreach($args as $arg) {
				if($arg !== $this->uri['page'] || $arg !== $this->uri['action'])
					$arg_arr[] = $arg;	
			}
			
			switch($sector)
			{
				case 'page':
					return $this->uri['page'];
				break;
				case 'action':
					return $this->uri['action'];
				break;
				case 'var':
					return $this->uri['var'];
				break;
				case 'args':
					return $arg_arr;
				break;
				default:
					return $this->uri['var']."/".$uri['action']."/".$uri['var'];
			}
		}	
	}