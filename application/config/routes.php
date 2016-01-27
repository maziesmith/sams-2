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

$route['contacts/delete/(:num)']['delete']  = 'ContactsController/delete/$1';
$route['contacts/delete']['post']  = 'ContactsController/delete';

$route['contacts/listing']['post']  = 'ContactsController/listing/';
$route['contacts/listing/group/(:any)']['post']  = 'ContactsController/grouping/$1';

$route['contacts/add']['post']  = 'ContactsController/add';

$route['contacts/edit/(:num)']['post']  = 'ContactsController/edit/$1';
$route['contacts/update/(:num)']['post']  = 'ContactsController/update/$1';

$route['contacts/import']['get']  = 'ContactsController/import';
$route['contacts/export']['get']  = 'ContactsController/export';
$route['contacts/export']['post']  = 'ContactsController/postexport';

/*
| ----------------
| # Groups Route
| ----------------
*/
$route['groups']  = 'GroupsController/index';
// $route['groups/(:any)']  = 'GroupsController/$1';
$route['groups/(:num)']['delete']  = 'GroupsController/delete/$1';
$route['groups/delete/many']['post']  = 'GroupsController/delete_many/';
$route['groups/add']['post']  = 'GroupsController/add';
$route['groups/edit/(:num)']['post']  = 'GroupsController/edit/$1';
$route['groups/update/(:num)']['post']  = 'GroupsController/update/$1';
$route['groups/import']['get']  = 'GroupsController/import';
$route['groups/export']['get']  = 'GroupsController/export';

/*
| ---------------
| # Migration
| ---------------
*/
// $route['migrate/(:num)'] = 'migrate/index/$1';
// $route['migrate/(:any)'] = 'migrate/$1';

// $route['(:any)'] = 'PageController/view/$1';

$route['default_controller'] = 'PageController/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
