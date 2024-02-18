<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/password-change', [App\Http\Controllers\Password::class, 'index']);
Route::post('/passchange-submit', [App\Http\Controllers\Password::class, 'submit']);

//Admin
Route::get('/admin_dashboard', [App\Http\Controllers\Admin\AdminDashboard::class, 'index'])->middleware('role:admin');

//Baglog
Route::get('/admin/baglog', [App\Http\Controllers\Admin\AdminDashboard::class, 'baglog'])->middleware('role:admin');
Route::get('/admin/baglog/CalcRecipe', [App\Http\Controllers\Admin\BaglogController::class, 'CalcRecipe'])->middleware('role:admin');
Route::post('/admin/baglog/recipe-submit', [App\Http\Controllers\Admin\BaglogController::class, 'BaglogRecipe'])->middleware('role:admin');
Route::get('/admin/baglog/datarecipe', [App\Http\Controllers\Admin\BaglogController::class, 'show'])->middleware('role:admin');
Route::get('/admin/baglog/update-recipe/{NoRecipe}', [App\Http\Controllers\Admin\BaglogController::class, 'updaterecipe'])->middleware('role:admin')->name('UpdateRecipe');
Route::post('/admin/baglog/submit-update-recipe/{NoRecipe}', [App\Http\Controllers\Admin\BaglogController::class, 'submitupdaterecipe'])->middleware('role:admin')->name('SubmitUpdateRecipe');
Route::get('/admin/baglog/delete/{NoRecipe}', [App\Http\Controllers\Admin\BaglogController::class, 'deleterecipe'])->middleware('role:admin')->name('DeleteRecipe');
Route::get('/admin/baglog/assignform/{NoRecipe}', [App\Http\Controllers\Admin\BaglogController::class, 'assignform'])->middleware('role:admin')->name('Assign');
Route::post('/admin/baglog/submitassign/{NoRecipe}', [App\Http\Controllers\Admin\BaglogController::class, 'submitmixing'])->middleware('role:admin')->name('SubmitAssign');
Route::get('/admin/baglog/report', [App\Http\Controllers\Admin\BaglogController::class, 'report'])->middleware('role:admin');
Route::post('/admin/baglog/report-edit', [App\Http\Controllers\Admin\BaglogController::class, 'EditKartuKendali'])->middleware('role:admin');
Route::get('/admin/baglog/report-delete/{id}', [App\Http\Controllers\Admin\BaglogController::class, 'DeleteKartuKendali'])->middleware('role:admin');
Route::get('/admin/baglog/report/export-data', [App\Http\Controllers\Admin\BaglogController::class, 'exportdata'])->middleware('role:admin');
Route::get('/admin/baglog/report/baglog-making-report', [App\Http\Controllers\Admin\BaglogController::class, 'baglogmakingreport'])->middleware('role:admin');
Route::get('/admin/baglog/report-mixing', [App\Http\Controllers\Admin\BaglogController::class, 'datamixing'])->middleware('role:admin');
Route::get('/admin/baglog/report-mixing/edit/{id}', [App\Http\Controllers\Admin\BaglogController::class, 'formeditmixing'])->middleware('role:admin')->name('FormEditMixing');
Route::post('/admin/baglog/report-mixing/submit', [App\Http\Controllers\Admin\BaglogController::class, 'submiteditmixing'])->middleware('role:admin');
Route::get('/admin/baglog/report-mixing/delete/{id}', [App\Http\Controllers\Admin\BaglogController::class, 'deletemixing'])->middleware('role:admin')->name('DeleteMixing');
Route::get('/admin/baglog/report-sterilisasi', [App\Http\Controllers\Admin\BaglogController::class, 'datasterilisasi'])->middleware('role:admin');
Route::get('/admin/baglog/report-sterilisasi/edit/{id}', [App\Http\Controllers\Admin\BaglogController::class, 'formeditsterilisasi'])->middleware('role:admin')->name('FormEditSterilisasi');
Route::post('/admin/baglog/report-sterilisasi/submit', [App\Http\Controllers\Admin\BaglogController::class, 'submiteditsterilisasi'])->middleware('role:admin');
Route::get('/admin/baglog/report-sterilisasi/delete/{id}', [App\Http\Controllers\Admin\BaglogController::class, 'deletesterilisasi'])->middleware('role:admin')->name('DeleteSterilisasi');
Route::get('/admin/baglog/report/{KodeProduksi}', [App\Http\Controllers\Admin\BaglogController::class, 'konta'])->middleware('role:admin')->name('BaglogKonta');
Route::get('/admin/baglog/kontaminasi/{KodeProduksi}', [App\Http\Controllers\Admin\BaglogController::class, 'kontaform'])->middleware('role:admin')->name('AddKontaBaglog');
Route::post('/admin/baglog/submit-kontaminasi', [App\Http\Controllers\Admin\BaglogController::class, 'addkonta'])->middleware('role:admin');
Route::post('/admin/baglog/edit-kontaminasi', [App\Http\Controllers\Admin\BaglogController::class, 'EditKonta'])->middleware('role:admin');
Route::get('/admin/baglog/kontaminasi-delete/{id}', [App\Http\Controllers\Admin\BaglogController::class, 'deletekonta'])->middleware('role:admin')->name('DeleteKontaBaglog');

Route::post('/admin/baglog/uji-coba', [App\Http\Controllers\Admin\BaglogController::class, 'UjiCobaCreate'])->middleware('role:admin');
Route::get('/admin/baglog/uji-coba-delete/{id}', [App\Http\Controllers\Admin\BaglogController::class, 'UjiCobaDelete'])->middleware('role:admin');

//Mylea
Route::get('/admin/mylea', [App\Http\Controllers\Admin\AdminDashboard::class, 'mylea'])->middleware('role:admin');
Route::get('/admin/mylea/order-produksi', [App\Http\Controllers\Admin\MyleaController::class, 'orderproduksi'])->middleware('role:admin');
Route::post('/admin/mylea/order-produksi/submit', [App\Http\Controllers\Admin\MyleaController::class, 'submitorderproduksi'])->middleware('role:admin');
Route::get('/admin/mylea/report', [App\Http\Controllers\Admin\MyleaController::class, 'report'])->middleware('role:admin');
Route::get('/admin/mylea/report/export-data', [App\Http\Controllers\Admin\MyleaController::class, 'exportdata'])->middleware('role:admin');
Route::get('/admin/mylea/report-edit/{KodeProduksi}', [App\Http\Controllers\Admin\MyleaController::class, 'reportedit'])->middleware('role:admin');
Route::post('/admin/mylea/report-submit/{KodeProduksi}', [App\Http\Controllers\Admin\MyleaController::class, 'reportsubmit'])->middleware('role:admin');
Route::get('/admin/mylea/report/kontaminasi/{KodeProduksi}', [App\Http\Controllers\Admin\MyleaController::class, 'kontaminasi'])->middleware('role:admin');
Route::get('/admin/mylea/report/form-kontaminasi/{KodeProduksi}', [App\Http\Controllers\Admin\MyleaController::class, 'formkontaminasi'])->middleware('role:admin');
Route::post('/admin/mylea/report/form-kontaminasi-submit', [App\Http\Controllers\Admin\MyleaController::class, 'formkontaminasisubmit'])->middleware('role:admin');
Route::get('/admin/mylea/report/kontaminasi-edit/{id}', [App\Http\Controllers\Admin\MyleaController::class, 'kontaminasiedit'])->middleware('role:admin');
Route::post('/admin/mylea/report/kontaminasi-submit/{id}', [App\Http\Controllers\Admin\MyleaController::class, 'kontaminasisubmit'])->middleware('role:admin');
Route::get('/admin/mylea/report/kontaminasi-delete/{id}', [App\Http\Controllers\Admin\MyleaController::class, 'deletekontaminasi'])->middleware('role:admin');
Route::get('/admin/mylea/report/harvest/{KodeProduksi}', [App\Http\Controllers\Admin\MyleaController::class, 'harvest'])->middleware('role:admin');
Route::get('/admin/mylea/report/harvest-delete/{KodeProduksi}/{id}', [App\Http\Controllers\Admin\MyleaController::class, 'deleteharvest'])->middleware('role:admin');
Route::get('/admin/mylea/report/data-baglog-delete/{id}', [App\Http\Controllers\Admin\MyleaController::class, 'databaglogdelete'])->middleware('role:admin');
Route::get('/admin/mylea/report/data-baglog-delete-operator/{id}', [App\Http\Controllers\Admin\MyleaController::class, 'DataBaglogDeleteOperator'])->middleware('role:admin');
Route::get('/admin/mylea/report/data-baglog-add/{KodeProduksi}', [App\Http\Controllers\Admin\MyleaController::class, 'databaglogadd'])->middleware('role:admin');
Route::post('/admin/mylea/report/data-baglog-add-submit/{KodeProduksi}', [App\Http\Controllers\Admin\MyleaController::class, 'databaglogaddsubmit'])->middleware('role:admin');

//Composite
Route::get('/admin/composite/', [App\Http\Controllers\Admin\AdminDashboard::class, 'composite'])->middleware('role:admin');
Route::get('/admin/composite/composite-variant', [App\Http\Controllers\Admin\CompositeController::class, 'CompositeVariant'])->middleware('role:admin');
Route::post('/admin/composite/composite-variant-submit', [App\Http\Controllers\Admin\CompositeController::class, 'CompositeVariantSubmit'])->middleware('role:admin');
Route::get('/admin/composite/composite-variant-delete/{id}', [App\Http\Controllers\Admin\CompositeController::class, 'CompositeVariantDelete'])->middleware('role:admin');
Route::get('/admin/composite/order-produksi', [App\Http\Controllers\Admin\CompositeController::class, 'orderproduksi'])->middleware('role:admin');
Route::post('/admin/composite/order-produksi/submit', [App\Http\Controllers\Admin\CompositeController::class, 'submitorderproduksi'])->middleware('role:admin');
Route::get('/admin/composite/report', [App\Http\Controllers\Admin\CompositeController::class, 'report'])->middleware('role:admin');
Route::get('/admin/composite/report/export-data', [App\Http\Controllers\Admin\CompositeController::class, 'exportdata'])->middleware('role:admin');
Route::get('/admin/composite/report/data-baglog-delete/{id}', [App\Http\Controllers\Admin\CompositeController::class, 'databaglogdelete'])->middleware('role:admin');
Route::get('/admin/composite/report/data-baglog-delete-operator/{id}', [App\Http\Controllers\Admin\CompositeController::class, 'DataBaglogDeleteOperator'])->middleware('role:admin');
Route::get('/admin/composite/report/data-baglog-add/{KodeProduksi}', [App\Http\Controllers\Admin\CompositeController::class, 'databaglogadd'])->middleware('role:admin');
Route::post('/admin/composite/report/data-baglog-add-submit/{KodeProduksi}', [App\Http\Controllers\Admin\CompositeController::class, 'databaglogaddsubmit'])->middleware('role:admin');
Route::get('/admin/composite/report-edit/{id}', [App\Http\Controllers\Admin\CompositeController::class, 'reportedit'])->middleware('role:admin');
Route::get('/admin/composite/report/harvest-delete/{CompositeID}/{id}', [App\Http\Controllers\Admin\CompositeController::class, 'deleteharvest'])->middleware('role:admin');
Route::post('/admin/composite/report-submit/{id}', [App\Http\Controllers\Admin\CompositeController::class, 'reportsubmit'])->middleware('role:admin');
Route::get('/admin/composite/report/kontaminasi/{id}', [App\Http\Controllers\Admin\CompositeController::class, 'kontaminasi'])->middleware('role:admin');
Route::get('/admin/composite/report/kontaminasi-edit/{id}', [App\Http\Controllers\Admin\CompositeController::class, 'kontaminasiedit'])->middleware('role:admin');
Route::post('/admin/composite/report/kontaminasi-submit/{id}', [App\Http\Controllers\Admin\CompositeController::class, 'kontaminasisubmit'])->middleware('role:admin');
Route::get('/admin/composite/report/kontaminasi-delete/{id}', [App\Http\Controllers\Admin\CompositeController::class, 'deletekontaminasi'])->middleware('role:admin');
Route::get('/admin/composite/report/form-kontaminasi/{id}', [App\Http\Controllers\Admin\CompositeController::class, 'formkontaminasi'])->middleware('role:admin');
Route::post('/admin/composite/report/form-kontaminasi-submit', [App\Http\Controllers\Admin\CompositeController::class, 'formkontaminasisubmit'])->middleware('role:admin');

//Post-Treatment
Route::get('/admin/mylea/post-treatment', [App\Http\Controllers\Admin\PostTreatmentController::class, 'index'])->middleware('role:admin');
Route::get('/admin/mylea/post-treatment/add-stock', [App\Http\Controllers\Admin\PostTreatmentController::class, 'addstock'])->middleware('role:admin');
Route::post('/admin/mylea/post-treatment/add-stock-submit', [App\Http\Controllers\Admin\PostTreatmentController::class, 'addstocksubmit'])->middleware('role:admin');
Route::get('/admin/mylea/post-treatment/stock-card', [App\Http\Controllers\Admin\PostTreatmentController::class, 'stockcard'])->middleware('role:admin');
Route::get('/admin/mylea/post-treatment/stock-card/form-pemakaian/{id}', [App\Http\Controllers\Admin\PostTreatmentController::class, 'formpemakaian'])->middleware('role:admin')->name('FormPemakaian');
Route::get('/admin/mylea/post-treatment/stock-card/delete-stock/{id}', [App\Http\Controllers\Admin\PostTreatmentController::class, 'deletestock'])->middleware('role:admin')->name('DeleteStock');
Route::post('/admin/mylea/post-treatment/stock-card/form-pemakaian-submit', [App\Http\Controllers\Admin\PostTreatmentController::class, 'formpemakaiansubmit'])->middleware('role:admin');
Route::get('/admin/mylea/post-treatment/stock-card/data-pemakaian/{id}', [App\Http\Controllers\Admin\PostTreatmentController::class, 'datapemakaian'])->middleware('role:admin')->name('DataPemakaian');
Route::get('/admin/mylea/post-treatment/stock-card/delete-pemakaian/{id}', [App\Http\Controllers\Admin\PostTreatmentController::class, 'deletepemakaian'])->middleware('role:admin')->name('DeletePemakaian');
Route::get('/admin/mylea/post-treatment/monitoring', [App\Http\Controllers\Admin\PostTreatmentController::class, 'monitoring'])->middleware('role:admin');
Route::get('/admin/mylea/post-treatment/monitoring/deleteqcdetails/{id}', [App\Http\Controllers\Admin\PostTreatmentController::class, 'deletequalitydetails'])->middleware('role:admin')->name('DeleteQCDetails');

//Biobo
Route::get('/admin/biobo', [App\Http\Controllers\Admin\AdminDashboard::class, 'biobo'])->middleware('role:admin');
Route::get('/admin/biobo/harvest', [App\Http\Controllers\Admin\BioboController::class, 'harvest'])->middleware('role:admin');
Route::get('/admin/biobo/harvest-form/{id}', [App\Http\Controllers\Admin\BioboController::class, 'harvestform'])->middleware('role:admin');
Route::post('/admin/biobo/harvest-submit/{id}', [App\Http\Controllers\Admin\BioboController::class, 'harvestupdate'])->middleware('role:admin');
Route::get('/admin/biobo/harvest-delete/{id}', [App\Http\Controllers\Admin\BioboController::class, 'harvestdelete'])->middleware('role:admin');
Route::get('/admin/biobo/pt1', [App\Http\Controllers\Admin\BioboController::class, 'pt1'])->middleware('role:admin');
Route::get('/admin/biobo/pt1-delete/{id}', [App\Http\Controllers\Admin\BioboController::class, 'pt1delete'])->middleware('role:admin');
Route::get('/admin/biobo/pt1-form/{id}', [App\Http\Controllers\Admin\BioboController::class, 'pt1form'])->middleware('role:admin');
Route::post('/admin/biobo/pt1-submit/{id}', [App\Http\Controllers\Admin\BioboController::class, 'pt1update'])->middleware('role:admin');
Route::get('/admin/biobo/pt2', [App\Http\Controllers\Admin\BioboController::class, 'pt2'])->middleware('role:admin');
Route::get('/admin/biobo/pt2-delete/{id}', [App\Http\Controllers\Admin\BioboController::class, 'pt2delete'])->middleware('role:admin');
Route::get('/admin/biobo/pt2-form/{id}', [App\Http\Controllers\Admin\BioboController::class, 'pt2form'])->middleware('role:admin');
Route::post('/admin/biobo/pt2-submit/{id}', [App\Http\Controllers\Admin\BioboController::class, 'pt2update'])->middleware('role:admin');



//Operator
Route::get('/operator_dashboard', [App\Http\Controllers\Operator\OperatorDashboard::class, 'index'])->middleware('auth');

//Baglog
Route::get('/operator/baglog', [App\Http\Controllers\Operator\BaglogController::class, 'baglog'])->middleware('auth');
Route::get('/operator/baglog/produksi-baglog-1', [App\Http\Controllers\Operator\BaglogController::class, 'ProduksiBaglog1'])->middleware('auth');
Route::get('/operator/baglog/mixing', [App\Http\Controllers\Operator\BaglogController::class, 'mixing'])->middleware('auth');
Route::get('/operator/baglog/detailmixing/{NoRecipe}', [App\Http\Controllers\Operator\BaglogController::class, 'mixingdetails'])->middleware('auth')->name('DetailMixing');
Route::post('/operator/baglog/mixing/{id}', [App\Http\Controllers\Operator\BaglogController::class, 'updatemixingstatus'])->middleware('auth')->name('UpdateMixing');
Route::get('/operator/baglog/sterilisasi', [App\Http\Controllers\Operator\BaglogController::class, 'sterilisasi'])->middleware('auth');
Route::post('/operator/baglog/submit-sterilisasi', [App\Http\Controllers\Operator\BaglogController::class, 'submitsterilisasi'])->middleware('auth');
Route::get('/operator/baglog/pembibitan', [App\Http\Controllers\Operator\BaglogController::class, 'pembibitan'])->middleware('auth');
Route::get('/operator/baglog/startpembibitan/{TanggalSterilisasi}/{NoBatch}/{Jumlah}/{sterilisasi_id}', [App\Http\Controllers\Operator\BaglogController::class, 'startpembibitan'])->middleware('auth')->name('StartPembibitan');
Route::post('/operator/baglog/submit-pembibitan', [App\Http\Controllers\Operator\BaglogController::class, 'submitpembibitan'])->middleware('auth');
Route::get('/operator/baglog/qcbaglog', [App\Http\Controllers\Operator\BaglogController::class, 'qcbaglog'])->middleware('auth');
Route::get('/operator/baglog/kontaminasi/{KodeProduksi}', [App\Http\Controllers\Operator\BaglogController::class, 'kontaminasi'])->middleware('auth')->name('Kontaminasi');
Route::get('/operator/baglog/data-kontaminasi/{KodeProduksi}', [App\Http\Controllers\Operator\BaglogController::class, 'datakontaminasi'])->middleware('auth')->name('DataKontaminasi');
Route::get('/operator/baglog/kontaminasi-delete/{id}', [App\Http\Controllers\Operator\BaglogController::class, 'deletekonta'])->name('DeleteKontaBaglogOperator');
Route::post('/operator/baglog/submit-kontaminasi', [App\Http\Controllers\Operator\BaglogController::class, 'submitkontaminasi'])->middleware('auth');
Route::get('/operator/baglog/submit-kartu-kendali/{KodeProduksi}', [App\Http\Controllers\Operator\BaglogController::class, 'submitkartukendali'])->middleware('auth');

//Mylea Operator
Route::get('/operator/mylea', [App\Http\Controllers\Operator\MyleaController::class, 'mylea'])->middleware('auth');
Route::get('/operator/mylea/produksi-mylea', [App\Http\Controllers\Operator\MyleaController::class, 'orderproduksi'])->middleware('auth');
Route::get('/operator/mylea/produksi-mylea/{KodeProduksi}', [App\Http\Controllers\Operator\MyleaController::class, 'orderproduksiform'])->middleware('auth')->name('UpdateOrderProduksiMylea');
Route::post('/operator/mylea/produksi-mylea/submit-form-produksi/{KodeProduksi}', [App\Http\Controllers\Operator\MyleaController::class, 'orderproduksiformsubmit'])->middleware('auth');
Route::get('/operator/mylea/production-report', [App\Http\Controllers\Operator\MyleaController::class, 'productionreport'])->middleware('auth');
Route::get('/operator/mylea/production-report/kontaminasi/{KodeProduksi}', [App\Http\Controllers\Operator\MyleaController::class, 'kontaminasi'])->middleware('auth')->name('MyleaKontaminasi');
Route::get('/operator/mylea/production-report/data-kontaminasi/{KodeProduksi}', [App\Http\Controllers\Operator\MyleaController::class, 'datakontaminasi'])->middleware('auth')->name('MyleaDataKontaminasi');
Route::get('/operator/mylea/production-report/export', [App\Http\Controllers\Operator\MyleaController::class, 'exportreport'])->middleware('auth');
Route::get('/operator/mylea/report/kontaminasi-delete/{id}', [App\Http\Controllers\Operator\MyleaController::class, 'deletekontaminasi']);
Route::post('/operator/mylea/production-report/submit-kontaminasi', [App\Http\Controllers\Operator\MyleaController::class, 'submitkontaminasi'])->middleware('auth');
Route::get('/operator/mylea/production-report/harvest/{KodeProduksi}', [App\Http\Controllers\Operator\MyleaController::class, 'harvest'])->middleware('auth')->name('MyleaHarvest');
Route::post('/operator/mylea/production-report/submit-harvest', [App\Http\Controllers\Operator\MyleaController::class, 'submitharvest'])->middleware('auth');
Route::get('/operator/mylea/production-report/biobo/{KodeProduksi}', [App\Http\Controllers\Operator\MyleaController::class, 'formharvestbiobo'])->middleware('auth')->name('MyleaBiobo');
Route::post('/operator/mylea/production-report/submit-biobo', [App\Http\Controllers\Operator\MyleaController::class, 'submitharvestbiobo'])->middleware('auth');

//Post Treatment Operator
Route::get('/operator/mylea/post-treatment', [App\Http\Controllers\Operator\PostTreatmentController::class, 'index'])->middleware('auth');
Route::get('/operator/mylea/post-treatment/qc1', [App\Http\Controllers\Operator\PostTreatmentController::class, 'qc1'])->middleware('auth');
Route::post('/operator/mylea/post-treatment/qc1-submit', [App\Http\Controllers\Operator\PostTreatmentController::class, 'submitqc1'])->middleware('auth');
Route::get('/operator/mylea/post-treatment/monitoring', [App\Http\Controllers\Operator\PostTreatmentController::class, 'monitoring'])->middleware('auth');
Route::get('/operator/mylea/post-treatment/mpt1/{KodeProduksi}', [App\Http\Controllers\Operator\PostTreatmentController::class, 'mpt1'])->name('MPT1')->middleware('auth');
/*Route::get('/operator/mylea/post-treatment/mpt1-washing/{id}', [App\Http\Controllers\Operator\PostTreatmentController::class, 'mpt1washing'])->middleware('auth')->name('MPT1Washing');
Route::get('/operator/mylea/post-treatment/mpt1-pengerikan/{id}', [App\Http\Controllers\Operator\PostTreatmentController::class, 'mpt1pengerikan'])->middleware('auth')->name('MPT1Pengerikan');
Route::get('/operator/mylea/post-treatment/mpt1-scoring/{id}', [App\Http\Controllers\Operator\PostTreatmentController::class, 'mpt1scoring'])->middleware('auth')->name('MPT1Scoring');
Route::get('/operator/mylea/post-treatment/mpt1-pengeringan/{id}', [App\Http\Controllers\Operator\PostTreatmentController::class, 'mpt1pengeringan'])->middleware('auth')->name('MPT1Pengeringan');
Route::get('/operator/mylea/post-treatment/mpt1-peg/{id}', [App\Http\Controllers\Operator\PostTreatmentController::class, 'mpt1peg'])->middleware('auth')->name('MPT1PEG');*/
Route::get('/operator/mylea/post-treatment/mpt1-report-submit/{id}/{case}', [App\Http\Controllers\Operator\PostTreatmentController::class, 'mpt1reportsubmit'])->middleware('auth')->name('MPT1-Report-Submit');
Route::get('/operator/mylea/post-treatment/mpt2/{KodeProduksi}', [App\Http\Controllers\Operator\PostTreatmentController::class, 'mpt2'])->middleware('auth')->name('MPT2');
Route::post('/operator/mylea/post-treatment/mpt2-submit/{KodeProduksi}', [App\Http\Controllers\Operator\PostTreatmentController::class, 'mpt2submit'])->middleware('auth')->name('MPT2-Submit');
Route::get('/operator/mylea/post-treatment/mpt2-report/{id}', [App\Http\Controllers\Operator\PostTreatmentController::class, 'mpt2report'])->middleware('auth')->name('MPT2-Report');
Route::get('/operator/mylea/post-treatment/mpt2-reportsubmit/{id}/{case}', [App\Http\Controllers\Operator\PostTreatmentController::class, 'mpt2reportsubmit'])->middleware('auth')->name('MPT2-Report-Submit');
Route::get('/operator/mylea/post-treatment/mpt3/{KodeProduksi}', [App\Http\Controllers\Operator\PostTreatmentController::class, 'mpt3'])->middleware('auth')->name('MPT3');
Route::get('/operator/mylea/post-treatment/mpt3-report/{id}', [App\Http\Controllers\Operator\PostTreatmentController::class, 'mpt3report'])->middleware('auth')->name('MPT3-Report');
Route::get('/operator/mylea/post-treatment/mpt3-reportsubmit/{id}/{case}', [App\Http\Controllers\Operator\PostTreatmentController::class, 'mpt3reportsubmit'])->middleware('auth')->name('MPT3-Report-Submit');
Route::get('/operator/mylea/post-treatment/mpt4/{KodeProduksi}', [App\Http\Controllers\Operator\PostTreatmentController::class, 'mpt4'])->middleware('auth')->name('MPT4');
Route::get('/operator/mylea/post-treatment/mpt4-report/{id}', [App\Http\Controllers\Operator\PostTreatmentController::class, 'mpt4report'])->middleware('auth')->name('MPT4-Report');
Route::get('/operator/mylea/post-treatment/mpt4-reportsubmit/{id}/{case}', [App\Http\Controllers\Operator\PostTreatmentController::class, 'mpt4reportsubmit'])->middleware('auth')->name('MPT4-Report-Submit');
Route::get('/operator/mylea/post-treatment/qc2', [App\Http\Controllers\Operator\PostTreatmentController::class, 'qc2'])->middleware('auth');
Route::get('/operator/mylea/post-treatment/qc2-form/{KodeProduksi}', [App\Http\Controllers\Operator\PostTreatmentController::class, 'qc2form'])->middleware('auth')->name('FormQC2');
Route::post('/operator/mylea/post-treatment/qc2-form-submit', [App\Http\Controllers\Operator\PostTreatmentController::class, 'qc2formsubmit'])->middleware('auth');

//Biobo Operator
Route::get('/operator/biobo', [App\Http\Controllers\Operator\BioboController::class, 'index'])->middleware('auth');
Route::get('/operator/biobo/harvest', [App\Http\Controllers\Operator\BioboController::class, 'harvest'])->middleware('auth');
Route::post('/operator/biobo/harvest-submit', [App\Http\Controllers\Operator\BioboController::class, 'harvestsubmit'])->middleware('auth');
Route::get('/operator/biobo/post-treatment-1', [App\Http\Controllers\Operator\BioboController::class, 'indexpt1'])->middleware('auth');
Route::get('/operator/biobo/input-pt-1', [App\Http\Controllers\Operator\BioboController::class, 'inputpt1'])->middleware('auth');
Route::post('/operator/biobo/pt-1-submit', [App\Http\Controllers\Operator\BioboController::class, 'pt1submit'])->middleware('auth');
Route::get('/operator/biobo/monitoring-post-treatment-1', [App\Http\Controllers\Operator\BioboController::class, 'pt1monitoring'])->middleware('auth');
Route::get('/operator/biobo/monitoring-post-treatment-1/FormDrying/{id}/{NoBatch}', [App\Http\Controllers\Operator\BioboController::class, 'pt1drying'])->middleware('auth');
Route::post('/operator/biobo/monitoring-post-treatment-1/form-drying-submit/{id}', [App\Http\Controllers\Operator\BioboController::class, 'pt1dryingsubmit'])->middleware('auth');
Route::get('/operator/biobo/monitoring-post-treatment-1/FormPressing/{id}/{NoBatch}', [App\Http\Controllers\Operator\BioboController::class, 'pt1pressing'])->middleware('auth');
Route::post('/operator/biobo/monitoring-post-treatment-1/form-pressing-submit/{id}', [App\Http\Controllers\Operator\BioboController::class, 'pt1pressingsubmit'])->middleware('auth');
Route::get('/operator/biobo/post-treatment-2', [App\Http\Controllers\Operator\BioboController::class, 'pt2monitoring'])->middleware('auth');
Route::get('/operator/biobo/post-treatment-2/terima/{id}', [App\Http\Controllers\Operator\BioboController::class, 'pt2terima'])->middleware('auth');
Route::get('/operator/biobo/monitoring-post-treatment-2/FormSanding/{id}/{NoBatch}', [App\Http\Controllers\Operator\BioboController::class, 'pt2sanding'])->middleware('auth');
Route::post('/operator/biobo/monitoring-post-treatment-2/form-sanding-submit/{id}', [App\Http\Controllers\Operator\BioboController::class, 'pt2sandingsubmit'])->middleware('auth');
Route::get('/operator/biobo/monitoring-post-treatment-2/FormCutting/{id}/{NoBatch}', [App\Http\Controllers\Operator\BioboController::class, 'pt2cutting'])->middleware('auth');
Route::post('/operator/biobo/monitoring-post-treatment-2/form-cutting-submit/{id}', [App\Http\Controllers\Operator\BioboController::class, 'pt2cuttingsubmit'])->middleware('auth');

//Composite Operator
Route::get('/operator/composite', [App\Http\Controllers\Operator\CompositeController::class, 'index'])->middleware('auth');
Route::get('/operator/composite/produksi-composite', [App\Http\Controllers\Operator\CompositeController::class, 'orderproduksi'])->middleware('auth');
Route::get('/operator/composite/produksi-composite/{id}', [App\Http\Controllers\Operator\CompositeController::class, 'orderproduksiform'])->middleware('auth')->name('UpdateOrderProduksiComposite');
Route::post('/operator/composite/produksi-composite/submit-form-produksi/{id}', [App\Http\Controllers\Operator\CompositeController::class, 'orderproduksiformsubmit'])->middleware('auth');
Route::get('/operator/composite/production-report', [App\Http\Controllers\Operator\CompositeController::class, 'productionreport'])->middleware('auth')->name('OperatorCompositeReport');
Route::get('/operator/composite/production-report/kontaminasi/{id}', [App\Http\Controllers\Operator\CompositeController::class, 'kontaminasi'])->middleware('auth')->name('CompositeKontaminasi');
Route::get('/operator/composite/production-report/data-kontaminasi/{id}', [App\Http\Controllers\Operator\CompositeController::class, 'datakontaminasi'])->middleware('auth')->name('CompositeDataKontaminasi');
Route::post('/operator/composite/production-report/submit-kontaminasi', [App\Http\Controllers\Operator\CompositeController::class, 'submitkontaminasi'])->middleware('auth');
Route::get('/operator/composite/report/kontaminasi-delete/{id}', [App\Http\Controllers\Operator\CompositeController::class, 'deletekontaminasi']);
Route::get('/operator/composite/production-report/harvest/{id}', [App\Http\Controllers\Operator\CompositeController::class, 'harvest'])->middleware('auth')->name('CompositeHarvest');
Route::post('/operator/composite/production-report/submit-harvest', [App\Http\Controllers\Operator\CompositeController::class, 'submitharvest'])->middleware('auth');