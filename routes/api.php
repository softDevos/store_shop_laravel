<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SlarieController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CustomerController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

# employees [Employee]
Route::post('/employees', [EmployeeController::class, 'create']);
Route::get('/employees', [EmployeeController::class, 'read']);
Route::put('/employees/{id}', [EmployeeController::class, 'update']);
Route::delete('/employees/{id}', [EmployeeController::class, 'delete']);

# suppliers [Supplier]
Route::post('/suppliers', [SupplierController::class, 'create']);
Route::get('/suppliers', [SupplierController::class, 'read']);
Route::put('/suppliers/{id}', [SupplierController::class, 'update']);
Route::delete('/suppliers/{id}', [SupplierController::class, 'delete']);

# categories [Category]
Route::post('/categories', [CategoryController::class, 'create']);
Route::get('/categories', [CategoryController::class, 'read']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'delete']);

# brands [Brands]
Route::post('/brands', [BrandController::class, 'create']);
Route::get('/brands', [BrandController::class, 'read']);
Route::put('/brands/{id}', [BrandController::class, 'update']);
Route::delete('/brands/{id}', [BrandController::class, 'delete']);

# products [Product]
Route::post('/products', [ProductController::class, 'create']);
Route::get('/products', [ProductController::class, 'read']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'delete']);

# expenses [Expense]
Route::post('/expenses', [ExpenseController::class, 'create']);
Route::get('/expenses', [ExpenseController::class, 'read']);
Route::put('/expenses/{id}', [ExpenseController::class, 'update']);
Route::delete('/expenses/{id}', [ExpenseController::class, 'delete']);

# customers [Customer]
Route::post('/customers', [CustomerController::class, 'create']);
Route::get('/customers', [CustomerController::class, 'read']);
Route::post('/customers/{id}', [CustomerController::class, 'update']);
Route::delete('/customers', [CustomerController::class, 'delete']);

# slaries [Slary]
Route::post('/slaries', [SlarieController::class, 'create']);
Route::get('/slaries', [SlarieController::class, 'read']);
Route::put('/slaries/{id}', [SlarieController::class, 'update']);
Route::delete('/slaries/{id}', [SlarieController::class, 'delete']);

# orders [Order]
Route::post('/orders', [OrderController::class, 'create']);
Route::get('/orders', [OrderController::class, 'read']);
Route::put('/orders/{id}', [OrderController::class, 'update']);
Route::delete('/orders/{id}', [OrderController::class, 'delete']);

# order_details [OrderDetails]
Route::post('/order_details', [OrderDetailsController::class, 'create']);
Route::get('/order_details', [OrderDetailsController::class, 'read']);
Route::put('/order_details/{id}', [OrderDetailsController::class, 'update']);
Route::delete('/order_details/{id}', [OrderDetailsController::class, 'delete']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});