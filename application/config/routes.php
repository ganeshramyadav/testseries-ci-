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

$route['default_controller'] = "login";
$route['404_override'] = 'error_404';
$route['translate_uri_dashes'] = FALSE;
// $route['translate_uri_dashes'] = TRUE;

$route['testing'] = 'login/testing';
$route['login'] = 'login/login';
$route['register'] = 'login/register';
$route['registration'] = 'login/registration';



/*********** USER DEFINED ROUTES *******************/

$route['registerMe'] = 'login/registerMe';
$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'user';
$route['logout'] = 'user/logout';


$route['userListing'] = 'user/userListing';
$route['userListing/(:num)'] = "user/userListing/$1";
$route['addNew'] = "user/addNew";
$route['addNewUser'] = "user/addNewUser";
$route['editOld'] = "user/editOld";
$route['editOld/(:num)'] = "user/editOld/$1";
$route['editUser'] = "user/editUser";
$route['deleteUser'] = "user/deleteUser";
$route['profile'] = "user/profile";
$route['profile/(:any)'] = "user/profile/$1";
$route['profileUpdate'] = "user/profileUpdate";
$route['profileUpdate/(:any)'] = "user/profileUpdate/$1";

$route['loadChangePass'] = "user/loadChangePass";
$route['changePassword'] = "user/changePassword";
$route['changePassword/(:any)'] = "user/changePassword/$1";
$route['pageNotFound'] = "user/pageNotFound";
$route['checkEmailExists'] = "user/checkEmailExists";
$route['login-history'] = "user/loginHistoy";
$route['login-history/(:num)'] = "user/loginHistoy/$1";
$route['login-history/(:num)/(:num)'] = "user/loginHistoy/$1/$2";

$route['forgotPassword'] = "login/forgotPassword";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";

/* End of file routes.php */

$route['subcat/(:num)'] = 'studymaterial/getSubCatById/$1';


/* Routes */

$route['study_material'] = "common/Listing";
$route['study_material/(:num)'] = "common/Listing/$1";

$route['current_affairs'] = "common/Listing";
$route['current_affairs/(:num)'] = "common/Listing/$1";

$route['video'] = "common/Listing";
$route['video/(:num)'] = "common/Listing/$1";

$route['study_material/new'] = "common/add";
$route['current_affairs/new'] = "common/add";
$route['video/new'] = "common/add";

$route['study_material/new/addNew'] = "common/addNew";
$route['current_affairs/new/addNew'] = "common/addNew";
$route['video/new/addNew'] = "common/addNew";

// $route['study_material/edit'] = "common/editOld";
$route['study_material/edit/(:num)'] = "common/edit/$1";
$route['current_affairs/edit/(:num)'] = "common/edit/$1";
$route['video/edit/(:num)'] = "common/edit/$1";

$route['study_material/edit'] = "common/update";
$route['current_affairs/edit'] = "common/update";
$route['video/edit'] = "common/update";

$route['addToCart/(:num)'] = "common/addToCart/$1";
$route['myCart'] = "common/CartListing";

$route['favorite'] = "common/favoriteListing";
$route['favorite/(:num)'] = "common/favoriteListing/$1";

$route['shoppingCart'] = "common/shoppingCartListing";
$route['order'] = "common/placeOrder";

$route['add'] = "common/ajaxAdd";
$route['delete'] = "common/delete";
$route['invoice/(:any)'] = "common/invoice/$1";

/* Question's */
/* $route['questions'] = "common/questions";
$route['questionsList'] = "common/questionsList"; */

$route['questions'] = "common/questionsListing";
$route['questions/(:num)'] = "common/questionsListing/$1";

/* $route['questionsListing'] = "common/questionsListing";
$route['questionsListing/(:num)'] = "common/questionsListing/$1"; */

$route['questions/new'] = "common/questionsNew";
$route['questions/new/addNew'] = "common/questionAdd";

/* Category */
$route['category'] = "picklist/List";
$route['category/(:num)'] = "picklist/List/$1";
$route['category/edit/(:num)'] = "picklist/edit/$1";
$route['category/edit'] = "picklist/update";
$route['category/new'] = "picklist/new";
$route['category/new/addNew'] = "picklist/addNew";

/* Sub Category */
$route['subcategory'] = "picklist/List";
$route['subcategory/(:num)'] = "picklist/List/$1";
$route['subcategory/edit/(:num)'] = "picklist/edit/$1";
$route['subcategory/edit'] = "picklist/update";
$route['subcategory/new'] = "picklist/new";
$route['subcategory/new/addNew'] = "picklist/addNew";

/* Exam Category */
$route['examcategory'] = "picklist/List";
$route['examcategory/(:num)'] = "picklist/List/$1";
$route['examcategory/edit/(:num)'] = "picklist/edit/$1";
$route['examcategory/edit'] = "picklist/update";
$route['examcategory/new'] = "picklist/new";
$route['examcategory/new/addNew'] = "picklist/addNew";

/* Exam SubCategory */
$route['examsubcategory'] = "picklist/List";
$route['examsubcategory/(:num)'] = "picklist/List/$1";
$route['examsubcategory/edit/(:num)'] = "picklist/edit/$1";
$route['examsubcategory/edit'] = "picklist/update";
$route['examsubcategory/new'] = "picklist/new";
$route['examsubcategory/new/addNew'] = "picklist/addNew";

$route['examsubcat/(:num)'] = 'picklist/getSubCatById/$1';

/* Exam */
$route['exam'] = "exam/List";
$route['exam/(:num)'] = "exam/List/$1";
$route['exam/edit/(:num)'] = "exam/edit/$1";
$route['exam/edit'] = "exam/update";
$route['exam/new'] = "exam/new";
$route['exam/new/addNew'] = "exam/addNew";

$route['selectedquestion'] = "exam/questionList";
$route['selectedquestion/(:num)'] = "exam/questionList/$1";
$route['addquestion'] = "exam/addquestions";
$route['addquestion/(:num)'] = "exam/addquestions/$1";

$route['exam/question/new/addNew'] = "exam/addExamQuestion";
$route['exam/question/delete'] = "exam/deleteExamQuestion";

$route['testseries'] = "exam/seriesList";
$route['testseries/(:num)'] = "exam/seriesList/$1";
$route['testseries/edit/(:num)'] = "exam/seriesEdit/$1";
$route['testseries/edit'] = "exam/seriesUpdate";
$route['testseries/new'] = "exam/seriesNew";
$route['testseries/new/addNew'] = "exam/seriesAddNew";

$route['selectedexam'] = "exam/examList";
$route['selectedexam/(:num)'] = "exam/examList/$1";
$route['addexam'] = "exam/addexam";
$route['addexam/(:num)'] = "exam/addexam/$1";

$route['testseries/exam/new/addNew'] = "exam/addSeriesExam";
$route['testseries/exam/delete'] = "exam/deleteSeriesExam";

/* Location: ./application/config/routes.php */
