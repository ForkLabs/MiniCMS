<?php require(PROTECT);

	class Auth extends Controller {
		function auth() {
			# We can load other resources here
			parent::controller();
			
			# Pre-Auth Check
			$this->auth_data = $this->auth->is_authenticated();
			$this->token_data = $this->auth_data['token_data'];

			
			if($this->auth_data['is_authenticated'] == 0)
				$this->is_authenticated = 0;
			else
				$this->is_authenticated = 1;
		}
		
		function index() {
			if($this->is_authenticated == 0) {
				$this->view->load('login_screen');
			} else {
				YU_redirect('home');
			}
		}

		function login() {
			# Set the headers
			#header('Content-type: application/json');
			$json_return = array();

			# This is a post method
			$username = $_POST['username'];
			$password = $_POST['password'];
			$token = $_POST['token'];
			
			# Are we already logged in?
			if(!$this->is_authenticated) {
				# Lets go ahead and do the login thing
				$authenticate_return = $this->auth->authenticate(array('username' => $username, 'password' => $password, 'token' => $token));
				if($authenticate_return['status'] == 1) {
					# We successfully authenticated, the front end will redirect to the home page
						$json_return['status'] = 'SUCCESS';
						$json_return['cookie'] = 'token='.$token;
				} else {
					# We did not successfully authenticate, lets return some json
					$json_return['status'] = 'FAILURE';

					$json_return['reason'] = $authenticate_return['reason'];
				}
			} else {
				# We are already authenticated, redirect them to the home page
				YU_redirect('home');
			}

			echo json_encode($json_return);
		}

		function logout() {
			if(!$this->is_authenticated) {
				YU_redirect('auth');
			} else {
				$this->auth->destroy_session();
				YU_redirect('auth');
			}
		}

		function test() {
			
		}
	}
