<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Http\Controllers\CsvImportController;
use App\Http\Controllers\JobbetchController;
use App\Http\Controllers\RegistrationController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('importExportView', [MyController::class, 'importExportView']);
Route::get('export', [MyController::class, 'export'])->name('export');
// Route::post('import', [MyController::class, 'import'])->name('import');

Route::post('import', [MyController::class, 'import_with_batch'])->name('import');





Route::get('/view', [CsvImportController::class, 'impostCsv']);
// Route::post('/uploadFile',[CsvImportController::class,'uploadFile']);


// https://gist.github.com/Julian-Nash/e94e181621e41f002c5848e2787c3a36
Route::post('uploadFile',[CsvImportController::class,'uploadFile'])->name('uploadFile');





Route::get('/', [JobbetchController::class,'index'])->name('upload');
Route::post('/', [JobbetchController::class,'upload_csv_records']);



Route::get('/create-custom-log', function () {
  
    \Log::channel('errorLog')->info('hiiiiiii');
    dd('hello'); // create custom error log testing
     
});



Route::get('/create', [RegistrationController::class,'create'])->name('create');
Route::post('/store', [RegistrationController::class,'store'])->name('store');



Route::get('/data',function(){
    return 'hiiii';
})->middleware('throttle:custom_limit');