<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * EVE Authenticator
 * =================
 * EVE Authenticator is a Codeigniter library which allows users to 
 * authenticate using their EVE Online account & character. 
 *
 */
class Eveauth
{
    
	protected $EVEApplication = [];
    
	function __construct($EVEApplication)
	{
        
		if ( ! is_array($EVEApplication)) {
			throw new Exception("EVE Auth expects array");
		}
        
		$this->EVEApplication = $EVEApplication;
	}
	
	/**
	* Generate the EVE SSO link based on the credentials provided
	* and return is as a string
	*/    
	public function getEVELink() {
        
		$callback = $this->EVEApplication['callback'];
		$clientID = $this->EVEApplication['clientID'];
		$EVELoginLink =  "https://login.eveonline.com/oauth/authorize/?response_type=code";
		$EVELoginLink .= "&redirect_uri=$callback";
		$EVELoginLink .= "&client_id=$clientID";
		$EVELoginLink .= "&scope=&state=" . uniqid();
        
		return (string) $EVELoginLink;
        
	}
	
	/**
	* Based on the authorization code given to us by EVE we will have to
	* execute a POST request and exchange that code for an access token
	* which will allow us to request the chracter's info later on.
	*/
	public function obtainAccessToken($authorizationCode) {
        
		$request = $this->_makeCURLRequest([
			'url' 		=> 'https://login.eveonline.com/oauth/token',
			'method'	=> 'POST',
			'headers' 	=> [
				'Authorization: Basic ' . base64_encode($this->EVEApplication['clientID'] . ':' . $this->EVEApplication['clientSecret']),
			],
			'fields' 	=> [
				'grant_type'	=> 'authorization_code',
				'code'			=> $authorizationCode
			]
		]);
		if ( ! $request) {
			throw new Exception("Something went wrong.");
		}
		
		return $request;	

	}   
	
	/**
	* Now that we got an access token we can authorize a request and ask
	* the server for the character data.
	*/
    public function getCharacterID($tokenRequestData) {	
			
		$request = $this->_makeCURLRequest([
			'url'		=> 'https://login.eveonline.com/oauth/verify',
			'method'	=> 'GET',
			'headers'	=> [
				'Authorization: Bearer ' . $tokenRequestData->access_token
			]
		]);
	
		if ( ! $request) {
            throw new Exception("Something went wrong.");
        }
        return $request;

	}
	/**
	* Nothing very important. This method carries out POST and GET requsts
	*/
	protected function _makeCURLRequest($payload) {
		
		$curlObject = curl_init();
    
		curl_setopt($curlObject, CURLOPT_URL, $payload['url']);
		curl_setopt($curlObject, CURLOPT_HTTPHEADER, $payload['headers']);
		curl_setopt($curlObject, CURLOPT_RETURNTRANSFER, true );
		if( $payload['method'] == 'POST' ) {
			$fieldsAsString = '';
        	foreach($payload['fields'] as $key => $val) {
            	$fieldsAsString .= $key.'='.$val.'&';
        	}
			curl_setopt($curlObject, CURLOPT_POST, 1);
			curl_setopt($curlObject, CURLOPT_POSTFIELDS, $fieldsAsString);
		}
		$curlResult = curl_exec($curlObject);
		curl_close($curlObject);
	
		return json_decode($curlResult);
		
	}
}