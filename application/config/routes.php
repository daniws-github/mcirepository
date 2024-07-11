<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Rute untuk get-login
$route['get-login'] = 'login/get_login';

// Rute untuk view document
$route['view-document/(:any)'] = 'document/view/$1';
$route['remove/(:any)'] = 'document/remove/$1';


// Rute untuk ai-assistant
$route['assistant'] = 'chat/index';
$route['chatbot'] = 'chat/chatbot';

// Rute untuk log tracking
$route['log-history'] = 'login/login_history';

// Rute untuk users management
$route['user-management'] = 'users/index';
$route['add-permission'] = 'users/view_add_permission';
$route['process-permission'] = 'users/process_add_permission';

// Rute untuk settings
$route['under-development'] = 'errors/index';
