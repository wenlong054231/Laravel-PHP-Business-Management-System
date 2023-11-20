<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WhatsAppController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::post('/login', [UserController::class, 'loginUser'])->name('user.loginUser');
});

Route::get('/login', [UserController::class, 'login'])->name('user.login');
Route::get('/register', [UserController::class, 'register'])->name('user.register');
Route::post('/register', [UserController::class, 'registerUser'])->name('user.registerUser');



Route::post('/forgotpassword', [UserController::class, 'sendPasswordResetEmail'])->name('user.requestpasswordreset');
Route::get('/resetpassword',[UserController::class, 'passwordResetEmail'])->name('user.passwordResetEmail');
Route::post('/update-password', [UserController::class, 'updatePassword'])->name('user.updatepassword');
Route::get('/password/reset/{token}', [UserController::class, 'showResetForm'])->name('user.passwordreset');


Route::middleware('session.expiration')->group(function () {
    Route::get('/home', [UserController::class, 'home'])->name('staff.home');
    Route::get('/view/{tableName}', [TableController::class, 'showCustomerTable'])->name('staff.client');
    Route::get('/add', [UserController::class, 'clientadd'])->name('customer.add');
    Route::post('/add', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/edit/{id}', [UserController::class, 'clientedit'])->name('customer.edit');
    Route::post('/edit/{id}', [CustomerController::class, 'update'])->name('customer.editpost');
    Route::post('/edit/{id}', [CustomerController::class, 'update'])->name('customer.editpost');

    Route::get('/view/customers/{tableName}', [TableController::class, 'showCustomerPoliciesTable'])->name('customers.policy');
    Route::get('/add/policy/{id}', [UserController::class, 'policyadd'])->name('policy.add');
    Route::post('/add/policy/{id}', [PolicyController::class, 'store'])->name('policy.store');
    Route::get('/edit/policy/{id}', [UserController::class, 'policyedit'])->name('policy.edit');
    Route::post('/edit/policy/{id}', [PolicyController::class, 'update'])->name('policy.editpost');

    Route::get('/view/companies/{tableName}', [TableController::class, 'showCompaniesPoliciesTable'])->name('companies.policy');
    Route::get('/add/company_policy', [UserController::class, 'company_policy_add'])->name('company_policy.add');
    Route::post('/add/company_policy', [PolicyController::class, 'company_policy_store'])->name('company_policy.store');
    Route::get('/edit/company_policy/{id}', [UserController::class, 'company_policy_edit'])->name('company_policy.edit');
    Route::post('/edit/company_policy/{id}', [PolicyController::class, 'company_policy_update'])->name('company_policy.editpost');
    Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
});

Route::middleware('admin')->group(function () {
    Route::get('/view/utilities_1/{tableName}', [TableController::class, 'showSalesTable'])->name('admin.sales');
    Route::get('/edit/sales/{id}', [AdminController::class, 'sales_edit'])->name('sales.edit');   
    Route::post('/edit/sales/{id}', [AdminController::class, 'sales_update'])->name('sales.editpost');


    Route::get('/view/utilities_2/{tableName}', [TableController::class, 'showExpensesTable'])->name('admin.expenses');
    Route::get('/add/expenses', [AdminController::class, 'expenses_add'])->name('expenses.add');
    Route::post('/add/expenses', [AdminController::class, 'expenses_store'])->name('expenses.store');
    Route::get('/edit/expenses/{id}', [AdminController::class, 'expenses_edit'])->name('expenses.edit');
    Route::post('/edit/expenses/{id}', [AdminController::class, 'expenses_update'])->name('expenses.editpost');

    Route::get('/view/utilities_3/{tableName}', [TableController::class, 'showUsersTable'])->name('admin.users');
    Route::get('/edit/users/{id}', [AdminController::class, 'users_edit'])->name('users.edit');
    Route::post('/edit/users/{id}', [AdminController::class, 'users_update'])->name('users.editpost');
    Route::delete('/delete/{id}', [AdminController::class, 'users_delete'])->name('users.delete');

});

Route::post('/send-whatsapp-message/{id}', [WhatsAppController::class, 'sendWhatsAppMessage'])->name('customer.notify');

Route::get('/forgot-password', function () {
    return view('user.forgotpassword');
})->name('user.forgotpassword');




// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
 
//     return redirect()->route('admin.dashboard');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
 
//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');