<?php require(PROTECT);
    	
	class Model {

		public $db;

		public function model() {
			# This is the parent Model method
			$this->db = new Database();
		}

		public static function load($model_name) {
			# Lets require our model
			require(MODELS . strtolower($model_name) . '.php');

			$model_obj_name = ucfirst($model_name);
			$model_obj = new $model_obj_name();

			return $model_obj;
		}
	}
	
