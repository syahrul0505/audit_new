<?php

use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\DepartementController;
use App\Http\Controllers\backend\HistoryLogController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\FilterController;
use App\Http\Controllers\backend\AbsenController;
use App\Http\Controllers\backend\ReportController;
use App\Http\Controllers\backend\EmployeeController;
use App\Http\Controllers\backend\MaterialController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\InventoryProductController;
use App\Http\Controllers\backend\StockInProductController;
use App\Http\Controllers\backend\StockOutProductController;
use App\Http\Controllers\backend\InventoryMaterialController;
use App\Http\Controllers\backend\StockInMaterialController;
use App\Http\Controllers\backend\StockOutMaterialController;
use App\Http\Controllers\backend\ForecastController;
use App\Http\Controllers\backend\ReportInventoryMaterialController;
use App\Http\Controllers\backend\ReportInventoryProductController;
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

// =================================================================================================================================
// ======================================================BACKEND ROUTE==============================================================
// =================================================================================================================================
    Route::get('/', function () {
        $data['page_title'] = "Login";
        return view('backend.auth.login', $data);
    })->name('user.login');

    // Route::get('/', function () {
    //     return view('frontend.welcome');
    // })->name('home');

    Route::middleware('auth:web')->group(function () {

        Route::prefix('admin/')->name('backend.')->group(function ()  {
 
            // Dashboard
            // Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');

            // Master Data Prefix
            Route::prefix('master-data')->group(function () {

                // Master Data
                Route::get('/', function () {
                    $data['page_title'] = 'Master Data';
                    $data['breadcumb'] = 'Master Data';
                    return view('backend.master-data.index', $data);
                })->name('master-data.index');

                // Inventory
                Route::get('/inv', function () {
                    $data['page_title'] = 'Inventory';
                    $data['breadcumb'] = 'Inventory';
                    return view('backend.inventory.index', $data);
                })->name('inventory.index');

                
                // Departement
                Route::resource('departements', DepartementController::class);
                
                // Employee
                Route::resource('employee', EmployeeController::class);

                // Material
                Route::resource('material', MaterialController::class);
                
                // Product
                Route::resource('product', ProductController::class);
                
                
                // Users
                Route::patch('change-password', [UserController::class, 'changePassword'])->name('users.change-password');
                Route::resource('users', UserController::class)->except([
                    'show'
                ]);;
            });
            
            // inventory Product
            Route::resource('inventory_product', InventoryProductController::class);
            
            // Product Stock In
            Route::resource('stock_in_product', StockInProductController::class);
            Route::get('stok-product',[StockInProductController::class, 'getStockById'])->name('inventory-product.get-stock');
            
            // Product Stock Out
            Route::resource('stock_out_product', StockOutProductController::class);
            Route::get('stok-out-product',[StockOutProductController::class, 'getStockById'])->name('stock-out-product.get-stock');
            
            // inventory Material
            Route::resource('inventory_material', InventoryMaterialController::class);

            // Stock In Material
            Route::resource('stock_in_material', StockInMaterialController::class);
            Route::get('stok-material',[StockInMaterialController::class, 'getStockById'])->name('inventory-material.get-stock');

             // Stock Out Material
             Route::resource('stock_out_material', StockOutMaterialController::class);
            
            // Forecast
            Route::resource('forecast', ForecastController::class);
            Route::get('get-gramasi',[ForecastController::class, 'getGramasiById'])->name('product.get-gramasi');

            // absen
            Route::resource('absen', AbsenController::class);


            // Report
            Route::get('report', [ReportController::class, 'index'])->name('report.index');
            Route::get('/report-absen-export', [ReportController::class, 'ReportExport'])->name('report-absen-export');

            // Report Inventory Material
            Route::get('report-inventory-material', [ReportInventoryMaterialController::class, 'index'])->name('report-inventory-material.index');
            Route::get('/report-inventory-material-export', [ReportInventoryMaterialController::class, 'ReportExport'])->name('report-inventory-material-export');

            // Report Inventory Product
            Route::get('report-inventory-product', [ReportInventoryProductController::class, 'index'])->name('report-inventory-product.index');
            Route::get('/report-inventory-product-export', [ReportInventoryProductController::class, 'ReportExport'])->name('report-inventory-product-export');


            // Filter
            Route::resource('filter', FilterController::class);

            // History Log
            Route::resource('history-log', HistoryLogController::class)->except([
                'show', 'create', 'store', 'edit', 'update'
            ]);;
        });
    });
// =================================================================================================================================
// ==================================================END BACKEND ROUTE==============================================================
// =================================================================================================================================

// ---------------------------------------------------------------------------------------------------------------------------------

// =================================================================================================================================
// =====================================================FRONTEND ROUTE==============================================================
// =================================================================================================================================






// =================================================================================================================================
// =====================================================END FRONTEND ROUTE==========================================================
// =================================================================================================================================

