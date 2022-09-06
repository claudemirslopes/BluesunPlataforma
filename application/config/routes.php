<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'custom_error_404';
$route['translate_uri_dashes'] = FALSE;

//Rota para formas de pagamento
$route['modulo'] = 'Formas_pagamentos/index';
$route['modulo/add'] = 'Formas_pagamentos/add';
$route['modulo/edit/(:num)'] = 'Formas_pagamentos/edit/$1';
$route['modulo/del/(:num)'] = 'Formas_pagamentos/del/$1';

//Rota para ordem de serviços
$route['os'] = 'Ordem_servicos/index';
$route['os/add'] = 'Ordem_servicos/add';
$route['os/edit/(:num)'] = 'Ordem_servicos/edit/$1';
$route['os/del/(:num)'] = 'Ordem_servicos/del/$1';
$route['os/imprimir/(:num)'] = 'Ordem_servicos/imprimir/$1';
$route['os/pdf/(:num)'] = 'Ordem_servicos/pdf/$1';

//Rota para relatórios de Contas a Pagar e Receber
$route['relatorios/receber'] = 'Relatorios/receber';
$route['relatorios/pagar'] = 'Relatorios/pagar';

//Rota para avisos
$route['avisos'] = 'Avisados/index';
$route['avisos/add'] = 'Avisados/add';
$route['avisos/edit/(:num)'] = 'Avisados/edit/$1';
$route['avisos/del/(:num)'] = 'Avisados/del/$1';

//Rota para Base de Conhecimento
$route['kb'] = 'Base_conhecimento/index';
$route['kb/add'] = 'Base_conhecimento/add';
$route['kb/edit/(:num)'] = 'Base_conhecimento/edit/$1';
$route['kb/del/(:num)'] = 'Base_conhecimento/del/$1';
$route['kb/view/(:num)'] = 'Base_conhecimento/view/$1';

//Rota para Base de Conhecimento - Franquias
$route['orcamentos/kb'] = 'orcamentos/Base_conhecimento/index';
$route['orcamentos/kb/add'] = 'orcamentos/Base_conhecimento/add';
$route['orcamentos/kb/edit/(:num)'] = 'orcamentos/Base_conhecimento/edit/$1';
$route['orcamentos/kb/del/(:num)'] = 'orcamentos/Base_conhecimento/del/$1';
$route['orcamentos/kb/view/(:num)'] = 'orcamentos/Base_conhecimento/view/$1';
