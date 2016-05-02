<?php


class Auth extends CI_Controller {

	function __construct() {

		parent::__construct();

		/*
		* Since we're using CI it's a good idea to place our keys inside
		* a config file.
		*/
		$this->load->config('eveauth');

		/*
		* Construct the array
		*/
		$app = [
			'callback'		=> $this->config->item('callback'),
			'clientID'		=> $this->config->item('clientID'),
			'clientSecret'	=> $this->config->item('clientSecret')
		];

		/*
		* Load the library. Eveauth.php must be placed inside the
		* libraries folder in order for this to work.
		*/
		$this->load->library('Eveauth', $app);

	}

	function login() {

		/*
		* Redirect the user
		*/
		$link = $this->eveauth->getEVELink();
		redirect($link);

	}

	public function sso() {

		/*
		* This where the callback url must be pointing to.
		* Once the user selects his character, he will be redirected
		* here with 'code' as a GET parameter.
		*/
		$code = $_GET['code'];

		/*
		* Pass the code as a parameter. Make sure the check wheter is
		* set or not.
		*/
		$tokenData = $this->eveauth->obtainAccessToken($code);

		/*
		* Pass $tokenData as a parameter in order to exchange the
		* token for the actual character data.
		*/
		$characterData = $this->eveauth->getCharacterID($tokenData);

		/*
		* You migth want to do something like this
		*/
		$this->User->authenticate($characterData);

		redirect(base_url());

	}

	public function logout() {

		/*
		* How to logout someone for good :)
		*/
		$this->session->sess_destroy();
		redirect(base_url());

	}

}