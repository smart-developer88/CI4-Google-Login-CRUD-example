<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Google extends BaseConfig
{
    public $clientId = '235877801742-f33ecrivtdh4rd061sqv93i89s4isq5l.apps.googleusercontent.com'; //add your client id
    public $clientSecret = 'zyeJ4LTwE4xkMPI9mn_o0pKb'; //add your client secret
    public $redirectUri = 'http://dev.reports.paghs.ca'; //add your redirect uri
    public $apiKey = ''; //add your api key here
    public $applicationName ='PAGHS'; //application name for the api
}

?>
