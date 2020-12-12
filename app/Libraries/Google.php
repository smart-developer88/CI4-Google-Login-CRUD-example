<?php namespace App\Libraries;

/*
 * Login with Google for Codeigniter
 *
 * Library for Codeigniter4 to authenticate users through Google OAuth 2.0 and get user profile info
 *
 * @authors     Jinzhe Cui
 */

class Google {
	public function __construct()
	{
		$config = new \Config\Google();
		$this->session = \Config\Services::session();

		$this->client = new \Google\Client();
        $this->client->setApplicationName($config->applicationName);

        $this->client->setClientId($config->clientId);
        $this->client->setClientSecret($config->clientSecret);
        $this->client->setRedirectUri($config->redirectUri);
        $this->client->setDeveloperKey($config->apiKey);

        $this->client->addScope('https://www.googleapis.com/auth/userinfo.email');
        $this->client->setAccessType('offline');

		$this->loggedIn = false;

		if($this->session->accessToken!=null)
		{
			$this->client->setAccessToken($this->session->accessToken);
			if($this->client->isAccessTokenExpired())
			{
				$accessToken = $this->client->getAccessToken();
	
				if($accessToken!=null)
				{
					$this->client->revokeToken($accessToken);
				}
			} else {				
				$this->loggedIn = true;
			}
		}
	}

	public function isLoggedIn()
	{
		return $this->loggedIn;
	}

	public function getLoginUrl()
	{
		return $this->client->createAuthUrl();
	}

	public function setAccessToken()
	{
		$this->client->authenticate($_GET['code']);

		$accessToken = $this->client->getAccessToken();
		$this->client->setAccessToken($accessToken);

		$this->session->set('accessToken', $accessToken);
		$this->loggedIn = true;
	}

	public function getUserInfo()
	{
		$service = new \Google_Service_Oauth2($this->client);

		return $service->userinfo->get();
	}

	public function logout()
	{
		unset($this->session->refreshToken);

		$accessToken = $this->client->getAccessToken();

		if($accessToken!=null)
		{
			$this->client->revokeToken($accessToken);
		}
	}
}

?>