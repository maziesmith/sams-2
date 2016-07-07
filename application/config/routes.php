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
$route['logout']['get'] = 'AuthController/logout';

/*
|------------------
| # Users Route
|------------------
*/
$route['users']['get'] = 'UsersController/index';

$route['users/listing']['post']  = 'UsersController/listing';
$route['users/listing']['get']  = 'UsersController/listing';

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
| -------------------
| # Privileges Routes
| -------------------
*/
$route['privileges']['get'] = 'PrivilegesController/index';

$route['privileges/listing']['post']  = 'PrivilegesController/listing';
$route['privileges/listing']['get']  = 'PrivilegesController/listing';

$route['privileges/trash']['get']  = 'PrivilegesController/trash';
$route['privileges/remove']['post']  = 'PrivilegesController/remove';
$route['privileges/remove/(:num)']['post']  = 'PrivilegesController/remove/$1';
$route['privileges/restore/(:num)']['post']  = 'PrivilegesController/restore/$1';

$route['privileges/delete/(:num)']['delete']  = 'PrivilegesLevelsController/delete/$1';
$route['privileges/delete']['post']  = 'PrivilegesController/delete';

$route['privileges/add']['post']  = 'PrivilegesController/add';

$route['privileges/edit/(:num)']['post']  = 'PrivilegesController/edit/$1';
$route['privileges/update/(:num)']['post']  = 'PrivilegesController/update/$1';

/*
|---------------------------
| # Privileges Levels Routes
|---------------------------
*/
$route['privileges-levels']['get'] = 'PrivilegesLevelsController/index';

$route['privileges-levels/listing']['post']  = 'PrivilegesLevelsController/listing';
$route['privileges-levels/listing']['get']  = 'PrivilegesLevelsController/listing';

$route['privileges-levels/trash']['get']  = 'PrivilegesLevelsController/trash';
$route['privileges-levels/remove']['post']  = 'PrivilegesLevelsController/remove';
$route['privileges-levels/remove/(:num)']['post']  = 'PrivilegesLevelsController/remove/$1';
$route['privileges-levels/restore/(:num)']['post']  = 'PrivilegesLevelsController/restore/$1';

$route['privileges-levels/delete/(:num)']['delete']  = 'PrivilegesLevelsController/delete/$1';
$route['privileges-levels/delete']['post']  = 'PrivilegesLevelsController/delete';

$route['privileges-levels/add']['post']  = 'PrivilegesLevelsController/add';

$route['privileges-levels/edit/(:num)']['post']  = 'PrivilegesLevelsController/edit/$1';
$route['privileges-levels/update/(:num)']['post']  = 'PrivilegesLevelsController/update/$1';

/*
|------------------
| # Modules Routes
|------------------
*/
$route['modules']['get'] = 'ModulesController/index';
$route['modules/listing']['post']  = 'ModulesController/listing';
$route['modules/listing']['get']  = 'ModulesController/listing';

$route['modules/trash']['get']  = 'ModulesController/trash';
$route['modules/remove']['post']  = 'ModulesController/remove';
$route['modules/remove/(:num)']['post']  = 'ModulesController/remove/$1';
$route['modules/restore/(:num)']['post']  = 'ModulesController/restore/$1';

$route['modules/delete']['post']  = 'ModulesController/delete';
$route['modules/delete/(:num)']['delete']  = 'ModulesController/delete/$1';

$route['modules/add']['post']  = 'ModulesController/add';

$route['modules/edit/(:num)']['post']  = 'ModulesController/edit/$1';
$route['modules/update/(:num)']['post']  = 'ModulesController/update/$1';

$route['modules/import']['get']  = 'ModulesController/import';
$route['modules/import']['post']  = 'ModulesController/import';

$route['modules/export']['get']  = 'ModulesController/export';
$route['modules/export']['post']  = 'ModulesController/export';

/*
| -----------------
| # Dashboard Route
| -----------------
*/
$route['dashboard'] = 'PageController/index';

/*
|-----------------
| # Members Route
|-----------------
*/
$route['members']['get'] = 'MembersController/index';
$route['members/listing']['post']  = 'MembersController/listing';
$route['members/listing']['get']  = 'MembersController/listing';

$route['members/trash']['get']  = 'MembersController/trash';
$route['members/remove']['post']  = 'MembersController/remove';
$route['members/remove/(:num)']['post']  = 'MembersController/remove/$1';
$route['members/restore/(:num)']['post']  = 'MembersController/restore/$1';

$route['members/delete']['post']  = 'MembersController/delete';
$route['members/delete/(:num)']['delete']  = 'MembersController/delete/$1';

$route['members/add']['post']  = 'MembersController/add';

$route['members/edit/(:num)']['post']  = 'MembersController/edit/$1';
$route['members/update/(:num)']['post']  = 'MembersController/update/$1';

$route['members/import']['get']  = 'MembersController/import';
$route['members/import']['post']  = 'MembersController/import';

$route['members/export']['get']  = 'MembersController/export';
$route['members/export']['post']  = 'MembersController/export';

/*
|-----------------
| # Group Members
|-----------------
*/
// $route['group-members/update/(:num)']['post']  = 'GroupMembersController/update/$1';

/*
| ----------------
| # Contacts Route
| ----------------
*/
$route['contacts']['get'] = 'ContactsController/index';

$route['contacts/listing']['post']  = 'ContactsController/listing';
$route['contacts/listing']['get']  = 'ContactsController/listing';

$route['contacts/trash']['get']  = 'ContactsController/trash';
$route['contacts/delete/(:num)']['delete']  = 'ContactsController/delete/$1';
$route['contacts/delete']['post']  = 'ContactsController/delete';
$route['contacts/remove']['post']  = 'ContactsController/remove';
$route['contacts/remove/(:num)']['post']  = 'ContactsController/remove/$1';

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

$route['groups/trash']['get']  = 'GroupsController/trash';
$route['groups/remove']['post']  = 'GroupsController/remove';
$route['groups/remove/(:num)']['post']  = 'GroupsController/remove/$1';
$route['groups/restore/(:num)']['post']  = 'GroupsController/restore/$1';

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
|----------------
| # Messaging
|----------------
*/
$route['messaging/inbox']['get'] = 'MessagesController/index';

/*
| ---------------
| # Migration
| ---------------
| This should be commented out in production mode
*/
$route['migrate/(:num)'] = 'migrate/index/$1';
$route['migrate/(:any)'] = 'migrate/$1';

/*
|----------------
| # Seeds
|----------------
*/
$route['seed/users'] = 'UsersController/seed';
$route['seed/modules'] = 'ModulesController/seed';

// $route['(:any)'] = 'PageController/view/$1';

/*
|----------------
| # Debugs
|----------------
*/
$route['debug'] = 'PageController/debug';

$route['default_controller'] = 'PageController/index';
$route['404_override'] = 'Error404Controller';
$route['translate_uri_dashes'] = FALSE;
