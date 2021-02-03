<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');
// ******************* created by mateen masood **************************
// ********************* controller name Product\ProductController ********
// ************************** Prdouct controller route ********************

// ************** view all product inside datatable product-list.view

Route::get('/products/datatable', 'Products\ProductController@datatable');
Route::get('/products/select2-products', 'Products\ProductController@select2Products');
// ******************************* for upload product image ******************
Route::post('/products--image-upload', 'Products\ProductController@fileUpload');
Route::resource('/products', 'Products\ProductController');

// ************************** Enquiry controller route ********************
Route::post('/enquiries/mature-enquiry', 'Enquiries\EnquiryController@matureEnquiry');
Route::post('/enquiries/cancel-enquiry', 'Enquiries\EnquiryController@cancel');
Route::get('/enquiries/datatable', 'Enquiries\EnquiryController@datatable');
Route::resource('/enquiries', 'Enquiries\EnquiryController');

// ******************************* Bank controller route ********************
Route::get('/banks/select2-banks', 'Banks\BankController@select2Products');
Route::get('/banks/datatable', 'Banks\BankController@datatable');
Route::post('/banks-logo-upload', 'Banks\BankController@logoUpload');
Route::resource('/banks', 'Banks\BankController');

// ******************************* bank branches controller routes ***************
Route::get('/bank-branches/datatable', 'Banks\BankBranches\BankBranchController@datatable');
Route::get('/bank-branches/select2-bank-branches', 'Banks\BankBranches\BankBranchController@select2BankBranches');
Route::resource('/bank-branches', 'Banks\BankBranches\BankBranchController');


// ******************************* Dealer controller route ********************

Route::get('/dealers/datatable', 'Dealers\DealerController@datatable');
Route::get('/bank-branch-dealers/select2-bank-branch-dealers', 'Dealers\DealerController@select2BankBranchDealers');
Route::resource('/dealers', 'Dealers\DealerController');

// ********************** hold products ***************************

Route::get('/product-hold/datatable', 'Products\HoldProductController@datatable');
Route::post('/product-hold/inventory-status', 'Products\HoldProductController@inventoryStatus');
Route::post('/product-hold/putUpForSale', 'Products\HoldProductController@putUpForSale');
Route::resource('/product-hold', 'Products\HoldProductController');



// ************************** Product Version Model by Product controller route ********************

Route::get('/product/versions-models', 'Products\ProductsMiscellaneous\ProductsRelatedSelect2Controller@select2ProductVersionModel');



// ************************** Enquiry controller route ********************
Route::get('/enquiries/datatable', 'Enquiries\EnquiryController@datatable');
Route::resource('/enquiries', 'Enquiries\EnquiryController');

/* ---------------- Branches ----------------*/
Route::get('branches/datatable', 'Branches\BranchController@datatable');
Route::get('branches/select2-branches', 'Branches\BranchController@select2Branches');
Route::resource('/branches','Branches\BranchController');



/* ---------------- Product Prices ----------------*/


    Route::get('products-prices/datatable', 'Products\ProductsPrices\ProductsPricesController@datatable');
    Route::get('products-prices/select2-products-prices', 'Products\ProductsPrices\ProductsPricesController@select2ProductsPrices');
    Route::get('/products-prices/product-invoice-price', 'Products\ProductsPrices\ProductsPricesController@productInvoicePrice');
    Route::resource('/products-prices','Products\ProductsPrices\ProductsPricesController');


/* ---------------- Inventory ----------------*/
Route::post('/inventories/inventory-status', 'Inventories\InventoryController@changeInventoryStatus');
Route::get('/inventories/datatable', 'Inventories\InventoryController@datatable');
Route::get('/inventories/select2-inventory-items-type-allocation', 'Inventories\InventoryController@select2InventoryItemsTypeAllocation');
Route::get('/inventories/inventory-item-engine-chasis', 'Inventories\InventoryController@getInventoryItemEngineChasis');
Route::resource('/inventories', 'Inventories\InventoryController');



/* ---------------- Orders ----------------*/

Route::get('/orders/datatable', 'Orders\OrderController@datatable');
Route::get('/orders/invoice/{order}', 'Orders\OrderController@invoice');
Route::post('/orders/files-upload', 'Orders\OrderController@UploadDocs');
Route::resource('/orders', 'Orders\OrderController');

// ************************ rback routes *************************

// ***************** roles **************************

Route::post('/roles/assign-permissions-to-role', 'Rback\Roles\RoleController@assignPermissionToRole');
Route::get('/roles/assign-permissions-show/{id}', 'Rback\Roles\RoleController@assignPermissionsShow');
Route::get('/roles/select2-roles', 'Rback\Roles\RoleController@select2Roles');
Route::get('/roles/datatable', 'Rback\Roles\RoleController@datatable');
Route::resource('/roles', 'Rback\Roles\RoleController');

// ************************ permissions *******************

Route::get('/permissions/datatable', 'Rback\Permissions\PermissionController@datatable');
Route::resource('/permissions', 'Rback\Permissions\PermissionController');

// ***************** Users ******************************************
Route::get('/users/datatable', 'Users\EmployeeController@datatable');
Route::resource('/users', 'Users\EmployeeController');

// ************************** profile controller *******************

Route::post('/user-profile/change-password', 'Users\Profile\ProfileController@changePassword');
Route::resource('/user-profile', 'Users\Profile\ProfileController');


// ******************** corporate routes **********

Route::get('/corporates/datatable', 'Corporates\CorporateController@datatable');
Route::get('/corporates/select2-corporates', 'Corporates\CorporateController@select2Corporates');
Route::resource('/corporates', 'Corporates\CorporateController');
/* ---------------- Add Ons ----------------*/

/* ---------------- Extended Warranty Program ----------------*/

Route::get('/extended-warranties/datatable', 'AddOns\ExtendedWarrantyController@datatable');
Route::get('/extended-warranties/extended-warranty-plan', 'AddOns\ExtendedWarrantyController@extendedWarrantyPlan');
Route::resource('/extended-warranties', 'AddOns\ExtendedWarrantyController');

/* ---------------- Insurance Program ----------------*/

Route::get('/insurance-programs/datatable', 'AddOns\InsuranceProgramController@datatable');
Route::get('/insurance-programs/insurance-plan', 'AddOns\InsuranceProgramController@insurancePlan');
Route::resource('/insurance-programs', 'AddOns\InsuranceProgramController');

/* ---------------- Tax Amounts ----------------*/

Route::get('/tax-amounts/datatable', 'AddOns\TaxAmountController@datatable');
Route::get('/tax-amounts/tax-amount', 'AddOns\TaxAmountController@taxAmount');
Route::resource('/tax-amounts', 'AddOns\TaxAmountController');


/* ---------------- Registration Fee ----------------*/

Route::get('/registration-fee/datatable', 'AddOns\RegistrationFeeController@datatable');
Route::get('/registration-fee/registration-fee', 'AddOns\RegistrationFeeController@registrationFee');
Route::resource('/registration-fee', 'AddOns\RegistrationFeeController');

// ******************************* add insurance company *************
Route::get('/insurance-comapny/datatable', 'AddOns\InsuranceCompany\InsuranceCompanyController@datatable');
Route::resource('/insurance-comapny', 'AddOns\InsuranceCompany\InsuranceCompanyController');

// ******************************* Departments Controller route *************
Route::get('/departments/select2-departments', 'Departments\DepartmentController@select2Department');
Route::get('/departments/datatable', 'Departments\DepartmentController@datatable');
Route::resource('/departments',  'Departments\DepartmentController');


Auth::routes(['register' => false]);

// Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/logout', 'Auth\LogoutController');
