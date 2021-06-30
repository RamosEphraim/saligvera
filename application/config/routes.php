<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['Developer/Status/(:any)/(:any)'] = 'DeveloperController/Status/$1/$2';
$route['Developer/Edit/(:any)'] = 'DeveloperController/Edit/$1';
$route['Developer/Account/(:any)'] = 'DeveloperController/Add/$1';
$route['Developer/AccountSettings'] = 'DeveloperController/AccountSettings';
$route['Developer/Change/Password/(:any)'] = 'DeveloperController/Password/$1';
$route['Developer/Change/General/(:any)'] = 'DeveloperController/General/$1';
$route['Developer'] = 'DeveloperController';
$route['Developer/Logout'] = 'DeveloperController/logout';


$route['Accounting/Deny/(:any)'] = 'AccountingController/Deny/$1';
$route['Accounting/Verify/(:any)'] = 'AccountingController/Verify/$1';
$route['Accounting/pprint'] = 'AccountingController/Print';
$route['Accounting/Report'] = 'AccountingController/Report';
$route['Accounting/AccountSettings'] = 'AccountingController/AccountSettings';
$route['Accounting/Change/Password/(:any)'] = 'AccountingController/Password/$1';
$route['Accounting/Change/General/(:any)'] = 'AccountingController/General/$1';
$route['Accounting'] = 'AccountingController';
$route['Accounting/Logout'] = 'AccountingController/logout';
$route['Accounting/Print'] = 'AccountingController/Print_data';
$route['EA/AccountSettings'] = 'EAController/AccountSettings';
$route['EA/Change/Password/(:any)'] = 'EAController/Password/$1';
$route['EA/Change/General/(:any)'] = 'EAController/General/$1';
$route['EA/Photos'] = 'EAController/Photos';
$route['EA/Project/(:any)'] = 'EAController/Project/$1';
$route['EA/Uploads/Project/(:num)'] = 'EAController/UploadPhoto/$1';
$route['EA'] = 'EAController';
$route['EA/Logout'] = 'EAController/logout';

$route['Purchasing/DeclineSupply/(:any)/(:any)'] = 'PurchasingController/DeclineSupply/$1/$2';
$route['Purchasing/RejectRequest/(:any)/(:any)'] = 'PurchasingController/RejectRequest/$1/$2';
$route['Purchasing/ConfirmedRequest/(:any)/(:any)'] = 'PurchasingController/ConfirmedRequest/$1/$2';
$route['Purchasing/SendSupply/(:any)/(:any)'] = 'PurchasingController/SendSupply/$1/$2';
$route['Purchasing/SendOrder/(:any)/(:any)'] = 'PurchasingController/SendOrder/$1/$2';
$route['Purchasing/CheckStocks/(:any)/(:any)'] = 'PurchasingController/checkStocks/$1/$2';
$route['Purchasing/AccountSettings'] = 'PurchasingController/AccountSettings';
$route['Purchasing/Change/Password/(:any)'] = 'PurchasingController/Password/$1';
$route['Purchasing/Change/General/(:any)'] = 'PurchasingController/General/$1';
$route['Purchasing'] = 'PurchasingController';
$route['Purchasing/Logout'] = 'PurchasingController/logout';


$route['Warehouse/Deny/(:any)'] = 'WarehouseController/Deny/$1';
$route['Warehouse/Verify/(:any)'] = 'WarehouseController/Verify/$1';
$route['Warehouse/Supply/Edit/(:any)/(:any)'] = 'WarehouseController/Update/$1/$2';
$route['Warehouse/Supply/Edit/(:any)'] = 'WarehouseController/Edit/$1';
$route['Warehouse/Supply/(:any)'] = 'WarehouseController/Add/$1';
$route['Warehouse/Order'] = 'WarehouseController/Order';
$route['Warehouse/Print'] = 'WarehouseController/Print_data';
$route['Warehouse/Report'] = 'WarehouseController/Report';
$route['Warehouse/AccountSettings'] = 'WarehouseController/AccountSettings';
$route['Warehouse/Change/Password/(:any)'] = 'WarehouseController/Password/$1';
$route['Warehouse/Change/General/(:any)'] = 'WarehouseController/General/$1';
$route['Warehouse'] = 'WarehouseController';
$route['Warehouse/Logout'] = 'WarehouseController/logout';

$route['Technical/Checklist/(:any)/(:any)'] = 'TechnicalController/addCheck/$1/$2';
$route['Technical/Project/Checklist/(:any)'] = 'TechnicalController/Checklist/$1';
$route['Technical/Project/Status/(:any)/(:any)'] = 'TechnicalController/UpdateStatus/$1/$2';
$route['Technical/Project/Checklist/(:any)/(:any)'] = 'TechnicalController/UpdateChecklist/$1/$2';
$route['Technical/Project/Private/(:any)'] = 'TechnicalController/Add_/$1';
$route['Technical/Project/Public/(:any)'] = 'TechnicalController/Add/$1';
$route['Technical/Project/Update'] = 'TechnicalController/UpdateProjects';
$route['Technical/Public/Edit/(:any)'] = 'TechnicalController/Edit/$1';
$route['Technical/Private/Edit/(:any)'] = 'TechnicalController/Edit_/$1';
$route['Technical/AccountSettings'] = 'TechnicalController/AccountSettings';
$route['Technical/Change/Password/(:any)'] = 'TechnicalController/Password/$1';
$route['Technical/Change/General/(:any)'] = 'TechnicalController/General/$1';
$route['Technical'] = 'TechnicalController';
$route['Technical/Logout'] = 'TechnicalController/logout';

$route['HR/Record/(:any)/(:any)'] = 'HRController/UpdateWorker/$1/$2';
$route['HR/Worker/Edit/(:any)'] = 'HRController/EditWorker/$1';
$route['HR/Worker/(:any)'] = 'HRController/Workeradd/$1';
$route['HR/Status/(:any)/(:any)'] = 'HRController/Status/$1/$2';
$route['HR/Edit/(:any)'] = 'HRController/Editacc/$1';
$route['HR/Account/(:any)'] = 'HRController/Add/$1';
$route['HR/Accounts'] = 'HRController/Accounts';
$route['HR/Project/Apply/(:any)'] = 'HRController/Apply/$1';
$route['HR/Projects'] = 'HRController/Project';
$route['HR/AccountSettings'] = 'HRController/AccountSettings';
$route['HR/Change/Password/(:any)'] = 'HRController/Password/$1';
$route['HR/Change/General/(:any)'] = 'HRController/General/$1';
$route['HR'] = 'HRController';
$route['HR/Logout'] = 'HRController/logout';


$route['Head/Status/(:any)/(:any)'] = 'HeadController/Status/$1/$2';
$route['Head/Edit/(:any)'] = 'HeadController/Edit/$1';
$route['Head/Account/(:any)'] = 'HeadController/Add/$1';
$route['Head/Accounts'] = 'HeadController/Accounts';
$route['Head/AccountSettings'] = 'HeadController/AccountSettings';
$route['Head/Change/Password/(:any)'] = 'HeadController/Password/$1';
$route['Head/Change/General/(:any)'] = 'HeadController/General/$1';
$route['Head/Project/(:any)'] = 'HeadController/View/$1';
$route['Head'] = 'HeadController';
$route['Head/Logout'] = 'HeadController/logout';




$route['login/(:any)'] = 'LoginController/loginUser/$1';
$route['login'] = 'LoginController';
$route['default_controller'] = 'LoginController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
