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
|	http://codeigniter.com/user_guide/general/routing.html
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

/*
| ------------
| # Auth Route
| ------------
*/
$route['login']['get'] = 'AuthController/index';
$route['auth/login']['post'] = 'AuthController/login';

/*
|------------------
| # Users Route
|------------------
*/
$route['users']['get'] = 'UsersController/index';

$route['users/listing']['post']  = 'UsersController/listing/';
$route['users/listing']['get']  = 'UsersController/listing/';

$route['users/delete/(:num)']['delete']  = 'UsersController/delete/$1';
$route['users/delete']['post']  = 'UsersController/delete';

$route['users/add']['post']  = 'UsersController/add';

$route['users/edit/(:num)']['post']  = 'UsersController/edit/$1';
$route['users/update/(:num)']['post']  = 'UsersController/update/$1';

$route['users/import']['get']  = 'UsersController/import';
$route['users/import']['post']  = 'UsersController/import';

$route['users/export']['get']  = 'UsersController/export';
$route['users/export']['post']  = 'UsersController/export';

/*
| -----------------
| # Dashboard Route
| -----------------
*/
$route['dashboard'] = 'PageController/index';

/*
| ----------------
| # Contacts Route
| ----------------
*/
$route['contacts']['get'] = 'ContactsController/index';

$route['contacts/listing']['post']  = 'ContactsController/listing/';
$route['contacts/listing']['get']  = 'ContactsController/listing/';

$route['contacts/delete/(:num)']['delete']  = 'ContactsController/delete/$1';
$route['contacts/delete']['post']  = 'ContactsController/delete';

$route['contacts/add']['post']  = 'ContactsController/add';

$route['contacts/edit/(:num)']['post']  = 'ContactsController/edit/$1';
$route['contacts/update/(:num)']['post']  = 'ContactsController/update/$1';

$route['contacts/import']['get']  = 'ContactsController/import';
$route['contacts/import']['post']  = 'ContactsController/import';

$route['contacts/export']['get']  = 'ContactsController/export';
$route['contacts/export']['post']  = 'ContactsController/export';

/*
| ----------------
| # Groups Route
| ----------------
*/
$route['groups']  = 'GroupsController/index';

$route['groups/listing']['post']  = 'GroupsController/listing';

$route['groups/delete/(:num)']['delete']  = 'GroupsController/delete/$1';
$route['groups/delete']['post']  = 'GroupsController/delete';

$route['groups/add']['post']  = 'GroupsController/add';

$route['groups/edit/(:num)']['post']  = 'GroupsController/edit/$1';
$route['groups/update/(:num)']['post']  = 'GroupsController/update/$1';

$route['groups/import']['get']  = 'GroupsController/import';
$route['groups/export']['get']  = 'GroupsController/export';

/*
|-----------------
| # Levels Route
|-----------------
*/
$route['levels']  = 'LevelsController/index';

$route['levels/listing']['post']  = 'LevelsController/listing';

$route['levels/delete/(:num)']['delete']  = 'LevelsController/delete/$1';
$route['levels/delete']['post']  = 'LevelsController/delete';

$route['levels/add']['post']  = 'LevelsController/add';

$route['levels/edit/(:num)']['post']  = 'LevelsController/edit/$1';
$route['levels/update/(:num)']['post']  = 'LevelsController/update/$1';

$route['levels/import']['get']  = 'LevelsController/import';
$route['levels/export']['get']  = 'LevelsController/export';

/*
|-----------------
| # Types Route
|-----------------
*/
$route['types']  = 'TypesController/index';

$route['types/listing']['post']  = 'TypesController/listing';

$route['types/delete/(:num)']['delete']  = 'TypesController/delete/$1';
$route['types/delete']['post']  = 'TypesController/delete';

$route['types/add']['post']  = 'TypesController/add';

$route['types/edit/(:num)']['post']  = 'TypesController/edit/$1';
$route['types/update/(:num)']['post']  = 'TypesController/update/$1';

$route['types/import']['get']  = 'TypesController/import';
$route['types/export']['get']  = 'TypesController/export';

/*
| ---------------
| # Migration
| ---------------
*/
// $route['migrate/(:num)'] = 'migrate/index/$1';
$route['migrate/(:any)'] = 'migrate/$1';

// $route['(:any)'] = 'PageController/view/$1';

$route['default_controller'] = 'PageController/index';
$route['404_override'] = 'Error404Controller';
$route['translate_uri_dashes'] = FALSE;
