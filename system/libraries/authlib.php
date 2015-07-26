<?php require(PROTECT);

class Authlib extends Libraries {
	function authlib() {
		parent::libraries();
		$this->db = new Database();
		$this->handler = $this->db->handler;

		# Lets retrieve the token
		$this->token = $_COOKIE['token'];
		if(!$this->token) {
			$this->token = 0;
		}
	}

	function is_authenticated() {
		# The return array
		$return = array();

		# Get the cookie
		if(!$this->token) {
			$return['is_authenticated'] = 0;
			$return['error_reason'] = '<br>token cookie not set!<br>';
		} else {
			# Check the token against database
			$sql = 'SELECT * FROM minicms_sessions WHERE session_token = "'.$this->token.'"';
			
			$sth = $this->handler->query($sql);
			$result = $sth->fetch(PDO::FETCH_ASSOC);
			$token_expiry = $result['session_time_expiration'];

			if($token_expiry == 1) {
				# Our session has expired
				$return['is_authenticated'] = 0;
				$return['error_reason'] = 'Not Authenticated';
			} else {
				# Our session is active, so we're going to use it
				$return['is_authenticated'] = 1;
				$return['token_data'] = $result;

			}
		}

		return $return;
	}

	function authenticate($login_details) {
		$return_array = array();

		if(is_array($login_details)) {
			# Lets see if our username and passwords match a user
			$username = $login_details['username'];
			$password = $login_details['password'];
			$token = $login_details['token'];

			$sql = 'SELECT * FROM minicms_users WHERE username LIKE "'.$username.'" AND user_password = "'.$password.'"';
			$sth = $this->handler->query($sql);
			$result = $sth->fetch(PDO::FETCH_ASSOC);

			if($result) {
				# Lets create the session on the database table
				$sql = 'INSERT INTO minicms_sessions (
						session_token,
						session_user,
						session_ip,
						session_useragent,
						session_admin,
						session_time_initiated,
						session_time_expiration
					) VALUES (
						"'.$token.'",
						'.$result['user_id'].',
						"'.$_SERVER['REMOTE_ADDR'].'",
						"'.$_SERVER['HTTP_USER_AGENT'].'",
						1,
						'.time().',
						0
					)';
					
					$sth = $this->handler->query($sql);


				$return_array['status'] = 1;
				$return_array['result'] = $result;
				$return_array['test'] = $result['user_id'];

			} else {
				# Reasons; 1 = wrong info
				$return_array['status'] = 0;
				$return_array['reason'] = 1;
			}
		} else {
			$return_array['status'] = 0;
			$return_array['reason'] = 2; # Reasons; 2 = internal error (login_details not array)
		}

		return $return_array;
	}

	function test() {
		echo "<br>Auth Library Works!";
	}

	function destroy_session() {
		$token_id = $this->token;
		$expiry = time() - 100;
		$sql = 'UPDATE minicms_sessions SET session_time_expiration = 1 WHERE session_token = "'.$token_id.'"';
		$sth = $this->handler->query($sql);
		echo "token=;expires=Thu, 01 Jan 1970 00:00:00 UTC";
	}

}
