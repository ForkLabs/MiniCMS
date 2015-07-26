<?php require(PROTECT);
	
	class Controller {
		public function controller() {
			$this->auth = new Authlib();
			$this->view = new view();
		}

		public function model($model_name) {
			return Model::load($model_name);
		}
	}
