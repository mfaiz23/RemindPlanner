<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Google extends BaseConfig
{
    public $clientID     = '';
    
    public $clientSecret = 'G';
    
    public $redirectUri  = 'http://localhost:8080/auth/googleCallback'; 
}
