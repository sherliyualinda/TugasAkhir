<?php

use App\Http\Controllers\GanttController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Lahan;
//use App\Models\Sewa_lahan;
use App\Sewa_lahan;

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

Route::get('/masuk', function(){
	return view('auth/login');
});


Route::get('/gantt/{id}', function ($id) {
    session_start();
    //$_SESSION['id_lahan'] = $id;
    $_SESSION['id_sewa'] = $id;
    //$lahan = Lahan::select('*')->where('id', $id)->get();
    //$sewa = Sewa_lahan::select('*')->where('id_lahan', $id)->get();
    $sewa = Sewa_lahan::select('*')->where('id_sewa', $id)->get();
    //return view('gantt',['lahan' => $lahan]);
    return view('gantt',['sewa' => $sewa]);
})->middleware('auth');

//REFRESH WIDGET
Route::get('/sosial-media/widget_berita.blade.php', function(){
	return view('theme/widget_berita');
});

Route::get('/sosial-media/widget_infra.blade.php', function(){
	return view('theme/widget_infra');
});

Route::get('/sosial-media/widget_video.blade.php', function(){
	return view('theme/widget_video');
});

Route::get('/sosial-media/p/widget_berita.blade.php', function(){
	return view('theme/widget_berita');
});

Route::get('/sosial-media/p/widget_infra.blade.php', function(){
	return view('theme/widget_infra');
});

Route::get('/sosial-media/p/widget_video.blade.php', function(){
	return view('theme/widget_video');
});
//END REFRESH WIDGET

Route::get('/tes', function(){
	return "mughny";
});

Auth::routes();

//LOGIN DAN REGIS
Route::post('/autoLogin', 'Login_Con@autoLogin');
Route::post('/api/register', 'Login_Con@register');
Route::get('/login', 'Login_Con@login')->name('login');
Route::get('/sosial-media/reset-password', function(){
	return view('auth/reset');
});
Route::post('/sosial-media/reset_pwd', 'Login_Con@reset_password')->name('update.password');
Route::post('/sosial-media/register_proses', 'Login_Con@register_proses');
Route::get('/sosial-media/check-username/{username}', 'Login_Con@check_username');
Route::get('/sosial-media/check-email/{email}', 'Login_Con@check_email');
Route::post('/sosial-media/login_proses', 'Login_Con@login_proses');
Route::post('/sosial-media/login_proses', 'Login_Con@login_proses')->name('sosial-media.login');
Route::get('/sosial-media/logout_proses', 'Login_Con@logout_proses');
Route::get('/sosial-media/login/get-district/{id_regency}', 'Login_Con@get_district');
Route::get('/sosial-media/login/get-village/{id_district}', 'Login_Con@get_village');
Route::get('/sosial-media/login/get-regency/{id_province}', 'Login_Con@get_regency');

//LOKASI
Route::get('/sosial-media/get-regency/{id_province}', 'Sosmed_Con@get_regency');
Route::get('/sosial-media/get-district/{id_regency}', 'Sosmed_Con@get_district');
Route::get('/sosial-media/get-village/{id_district}', 'Sosmed_Con@get_village');

//REPORT
Route::post('/sosial-media/report_proses', 'Report_Con@insert_report');

//SHOP
Route::get('/sosial-media/shop', 'Sosmed_Con@get_shop');

//BERANDA
Route::get('/sosial-media/beranda', 'Sosmed_Con@beranda');
Route::post('/sosial-media/cari_pengguna', 'Sosmed_Con@cari_pengguna_proses')->name('sosial-media.cari_pengguna');
Route::get('/sosial-media/tambah_teman/{username}', 'Sosmed_Con@tambah_teman');
Route::post('/sosial-media/post', 'Sosmed_Con@post');
Route::post('/sosial-media/post_komen', 'Sosmed_Con@post_komen');
Route::get('/sosial-media/konten_detail/{id_konten}', 'Sosmed_Con@konten_detail');
Route::get('/sosial-media/explore/{tempat}', 'Sosmed_Con@get_konten_lokasi');
Route::post('/sosial-media/share_post', 'Sosmed_Con@share_post');
Route::get('/sosial-media/p/{slug}', 'Sosmed_Con@konten_detail_by_slug');

//HAPUS DAN EDIT POSTINGAN
Route::get('/sosial-media/hapus_konten/{id_konten}', 'Sosmed_Con@hapus_konten');
Route::post('/sosial-media/edit_konten_proses', 'Sosmed_Con@edit_konten_proses');

//HAPUS KOMENTAR
Route::get('/sosial-media/hapus_komentar_proses/{id}', 'Sosmed_Con@hapus_komentar_proses');

//LIKE DAN DISLIKE POSTINGAN
Route::post('/sosial-media/menyukai_proses/{id_konten}', 'Sosmed_Con@menyukai_proses');
Route::post('/sosial-media/batal_menyukai_proses/{id}', 'Sosmed_Con@batal_menyukai_proses');

//PROFIL
// Route::get('/sosial-media/profil/{username}', 'Sosmed_Con@lihat_profil');
Route::get('/sosial-media/profil/{username}', 'Sosmed_Con@lihat_profil')->name('sosial-media.profil');
Route::get('/sosial-media/tambah_teman2/{username}', 'Sosmed_Con@tambah_teman2');
Route::get('/sosial-media/hapus_following/{username}', 'Sosmed_Con@hapus_following');
Route::get('/sosial-media/hapus_followers/{username}', 'Sosmed_Con@hapus_followers');
Route::post('/sosial-media/post_komen_dari_profil', 'Sosmed_Con@post_komen_dari_profil');
Route::post('/sosial-media/ubah_foto_sampul', 'Sosmed_Con@ubah_foto_sampul');
Route::post('/sosial-media/ubah_foto_profil', 'Sosmed_Con@ubah_foto_profil');
Route::get('/createUser', 'StoreController@create')->name('createUser');
Route::get('/sosial-media/store', 'StoreController@mystore')->name('my-store');
Route::put('/sosial-media/send-submission-store/{id}', 'StoreController@sendSubmissionStore')->name('send-submission-store');


//FOLLOW REQUEST
Route::get('/sosial-media/terima_request/{id}', 'Sosmed_Con@terima_request');
Route::get('/sosial-media/tolak_request/{id}', 'Sosmed_Con@tolak_request');
Route::get('/sosial-media/batal_request/{id}', 'Sosmed_Con@batal_request');

//PENGATURAN
Route::get('/halamanAwal', 'LahanController@halamanAwal');
Route::get('/sosial-media/pengaturan', 'Sosmed_Con@pengaturan');
Route::post('/sosial-media/ubah_profil_proses', 'Sosmed_Con@ubah_profil_proses');
Route::get('/sosial-media/pengaturan_pass', 'Sosmed_Con@pengaturan_pass');
Route::post('/sosial-media/ubah_password_proses', 'Sosmed_Con@ubah_password_proses');
Route::get('/sosial-media/pengaturan_notif', 'Sosmed_Con@pengaturan_notif');
Route::post('/sosial-media/ubah_notif_proses', 'Sosmed_Con@ubah_notif_proses');
Route::get('/sosial-media/pengaturan_privasi', 'Sosmed_Con@pengaturan_privasi');
Route::post('/sosial-media/ubah_privasi_proses', 'Sosmed_Con@ubah_privasi_proses');
Route::get('/sosial-media/pengaturan_log', 'Sosmed_Con@pengaturan_log');
Route::get('/sosial-media/pengaturan_hapus_akun', 'Sosmed_Con@pengaturan_hapus_akun');
Route::post('/sosial-media/hapus_akun_proses', 'Sosmed_Con@hapus_akun_proses');

//CHAT
Route::get('/sosial-media/chat', 'Sosmed_Con@chat');
Route::get('/sosial-media/chat_new/{username}', 'Sosmed_Con@chat_new');
Route::get('/sosial-media/chat_lahan/{username}', 'Sosmed_Con@chat_lahan');
Route::get('/sosial-media/chat/{id_room_chat}', 'Sosmed_Con@chat_detail');
Route::post('/sosial-media/chat_proses', 'Sosmed_Con@chat_proses');
Route::get('/sosial-media/cek_chat/{username_penerima}', 'Sosmed_Con@cek_chat');
Route::get('/sosial-media/hapus_chat_proses/{id_chat}', 'Sosmed_Con@hapus_chat');
Route::get('/sosial-media/hapus_room_chat_proses/{id_room_chat}', 'Sosmed_Con@hapus_room_chat');

//HALAMAN GROUP
Route::get('/sosial-media/halaman_group', 'Sosmed_Con@halaman_group');
Route::post('/sosial-media/buat_group_proses', 'Sosmed_Con@buat_group_proses');
Route::get('/sosial-media/halaman_group_detail/{id_group}', 'Sosmed_Con@halaman_group_detail');
Route::post('/sosial-media/post_konten_grup', 'Sosmed_Con@post_konten_grup');
Route::post('/sosial-media/post_komen_grup', 'Sosmed_Con@post_komen_grup');
Route::post('/sosial-media/update_notif_group', 'Sosmed_Con@update_notif_group')->name('sosial-media.update_notif_group');
Route::get('/sosial-media/gabung_grup/{id_group}', 'Sosmed_Con@gabung_grup');
Route::post('/sosial-media/undangan_grup_proses', 'Sosmed_Con@undangan_grup_proses');
Route::get('/sosial-media/terima_undangan_grup/{id}', 'Sosmed_Con@terima_undangan_grup');
Route::get('/sosial-media/tolak_undangan_grup/{id}', 'Sosmed_Con@tolak_undangan_grup');
Route::get('/sosial-media/keluar_group_proses/{id_group}', 'Sosmed_Con@keluar_group_proses');
Route::get('/sosial-media/hapus_group_proses/{id_group}', 'Sosmed_Con@hapus_group_proses');
Route::post('/sosial-media/tambah_admin', 'Sosmed_Con@tambah_admin');
Route::get('/sosial-media/group/p/{slug}', 'Sosmed_Con@konten_group_detail_by_slug');
Route::post('/sosial-media/edit-desc', 'Sosmed_Con@update_deskripsi');
Route::post('/sosial-media/edit-nama-group', 'Sosmed_Con@update_nama_group');
Route::get('/sosial-media/list-report-grup/{id_group}', 'Sosmed_Con@data_report_group');
Route::post('/sosial-media/get-group-report-list', 'Sosmed_Con@get_group_report_list');

//NOTIF
Route::post('/sosial-media/update_notif', 'Sosmed_Con@update_notif')->name('sosial-media.update_notif');

//SUPER ADMIN AREA
//SUPER ADMIN - MENU DASHBOARD
Route::get('/sosial-media/dashboard-admin', 'superadmin\menu_dashboard_con@get_jml_akun');
Route::get('/sosial-media/getData/{x}', 'superadmin\menu_dashboard_con@get_data');

//SUPER ADMIN - MENU LIST REPORT
Route::get('/sosial-media/list-report', 'superadmin\menu_report_con@get_report');
Route::get('/sosial-media/delete-reported-content/{id_konten}', 'superadmin\menu_report_con@delete_reported_content');
Route::get('/sosial-media/delete-reported-comment/{id_comment}', 'superadmin\menu_report_con@delete_reported_comment');
Route::get('/sosial-media/get-content-of-comment/{id_comment}', 'superadmin\menu_report_con@get_content_of_comment');
Route::get('/sosial-media/decline-report/{id_reports}', 'superadmin\menu_report_con@decline_reports');
Route::post('/sosial-media/get-report-list', 'superadmin\menu_report_con@get_report_list');


//SUPER ADMIN - MENU LIST PENGGUNA
Route::get('/sosial-media/list-pengguna', 'superadmin\menu_pengguna_con@get_all_akun');

//VIDEO
Route::prefix('superadmin')
->name('superadmin.sosial-media.')
->namespace('superadmin')
->middleware('auth')
->group(function() {
    Route::resource('/sosial-media/video', 'VideoController');
});

//END SUPER ADMIN AREA
Route::group(['middleware' => ['auth']], function(){
    // DesaTube
    Route::resource('/desatube', 'DesaTube\VideoController')->only(['show','index']);
    Route::get('/desatube/like/{id}/{type}', 'DesaTube\VideoController@like')->name('desatube.like');
    Route::post('/desatube/comment', 'DesaTube\VideoController@comment')->name('desatube.comment');
    Route::get('/desatube/subscribe/{id}/{channel}', 'DesaTube\VideoController@subscribe')->name('desatube.subscribe');
    Route::get('/desatube/unsubscribe/{id}', 'DesaTube\VideoController@unsubscribe')->name('desatube.unsubscribe');
    // DesaTube

    //Marketplace
    Route::get('/sosial-media/marketplace', 'HomeController@marketplace');

    Route::get('/kamu', 'HomeController@kamu');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/rank', 'HomeController@rank')->name('rank');

    Route::get('/categories', 'CategoryController@index')->name('categories');
    Route::get('/categories/{id}', 'CategoryController@detail')->name('categories-detail');

    Route::get('/details/{id}', 'DetailController@index')->name('detail');
    Route::post('/details/{id}', 'DetailController@add')->name('detail-add');

    Route::get('/tambahqty/{id}', 'DetailController@tambahqty')->name('tambahqty');
    Route::get('/kurangqty/{id}', 'DetailController@kurangqty')->name('kurangqty');




    Route::get('/stores', 'StoreController@index')->name('store-page-search');
    Route::get('/stores/{id}', 'StoreController@area')->name('store-page-area');
    Route::get('/store/detail/{id}', 'StoreController@detail')->name('store-page-detail');


    Route::get('/success', 'CartController@success')->name('success');

    Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');

});


Route::group(['middleware' => ['auth']], function(){

Route::get('/cart', 'CartController@index')->name('cart');
Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');

Route::post('/checkout', 'CheckoutController@process')->name('checkout');
Route::post('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');



Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/dashboard/products', 'DashboardProductController@index')->name('dashboard-product');
Route::get('/dashboard/products/create', 'DashboardProductController@create')->name('dashboard-product-create');
Route::get('/dashboard/products/createUser', 'DashboardProductController@createUser')->name('dashboard-product-createUser');
Route::post('/dashboard/productsUser', 'DashboardProductController@storeUser')->name('dashboard-product-storeUser');
Route::post('/dashboard/products', 'DashboardProductController@store')->name('dashboard-product-store');
Route::get('/dashboard/products/{id}', 'DashboardProductController@details')->name('dashboard-product-details');
Route::get('/dashboard/products/show/{id}', 'DashboardProductController@show')->name('dashboard-product-show');
Route::post('/dashboard/products/{id}', 'DashboardProductController@update')->name('dashboard-product-update');
Route::post('/dashboard/products/approve/{id}', 'DashboardProductController@approve')->name('dashboard-product-approve');

Route::post('/dashboard/products/gallery/upload', 'DashboardProductController@uploadGallery')->name('dashboard-product-gallery-upload');
Route::get('/dashboard/products/gallery/delete/{id}', 'DashboardProductController@deleteGallery')->name('dashboard-product-gallery-delete');

Route::get('/dashboard/transactions', 'DashboardTransactionController@index')->name('dashboard-transaction');
Route::get('/dashboard/transactions/{id}', 'DashboardTransactionController@details')->name('dashboard-transaction-details');
Route::post('/dashboard/transactions/{id}', 'DashboardTransactionController@update')->name('dashboard-transaction-update');

// store
Route::get('/dashboard/stores-pending', 'StoreController@storePending')->name('dashboard.store-pending');
Route::get('/dashboard/stores-pending-detail/{id}', 'StoreController@storeDetail')->name('dashboard.store-pending-show');
Route::post('/dashboard/stores/approve/{id}', 'StoreController@storeApprove')->name('dashboard.store-approve');

Route::get('/konfirmasistatuscustomer/{id}', 'DashboardTransactionController@konfirmasistatuscustomer')->name('konfirmasistatuscustomer');
Route::get('/konfirmasistatuspenjual/{id}', 'DashboardTransactionController@konfirmasistatuspenjual')->name('konfirmasistatuspenjual');

Route::get('/dashboard/settings', 'DashboardSettingController@store')->name('dashboard-settings-store');
Route::get('/dashboard/account', 'DashboardSettingController@account')->name('dashboard-settings-account');
Route::post('/dashboard/account/{redirect}', 'DashboardSettingController@update')->name('dashboard-settings-redirect');

// lahan
Route::get('/dashboard/lahan-pending', 'Admin\LahanController@index')->name('dashboard.lahan-pending');
Route::get('/dashboard/lahan-pending-detail/{id}', 'Admin\LahanController@show')->name('dashboard.lahan-pending-show');
Route::post('/dashboard/lahan/approval/{id}', 'Admin\LahanController@approval')->name('dashboard.lahan.approval');

Route::resource('/dashboard/video', 'AdminStore\VideoController');



});


Route::prefix('admin')
->namespace('Admin')
->middleware(['auth','admin'])
->group(function() {
    Route::get('/', 'DashboardController@index')->name('admin-dashboard')->middleware('auth');
    Route::resource('category', 'CategoryController')->middleware('auth');
    Route::resource('user', 'UserController')->middleware('auth');
    Route::resource('admin-store-user', 'AdminStoreController')->middleware('auth');
    Route::resource('product', 'ProductController')->middleware('auth');
    Route::resource('transaction', 'TransactionController')->middleware('auth');
    Route::resource('product-gallery', 'ProductGalleryController')->middleware('auth');
    Route::get('delete/{id}','UserController@destroy')->name('delete-user')->middleware('auth');
});


Route::get('/', 'DashboardController@index')->name('admin-store-dashboardd');
Route::prefix('adminstore')
->namespace('AdminStore')
->middleware(['auth','adminstore'])
->group(function() {
    Route::get('/', 'DashboardController@index')->name('admin-store-dashboard')->middleware('auth');
    Route::resource('adminstore-category', 'CategoryController')->middleware('auth');
    Route::resource('adminstore-user', 'UserController')->middleware('auth');
    Route::get('/adminstore/user/tambahdata', 'UserController@create')->name('tambahdata')->middleware('auth');
    Route::post('/adminstore/user/add', 'UserController@store')->name('adddata')->middleware('auth');

    
    Route::resource('adminstore-product', 'ProductController')->middleware('auth');
    Route::get('/adminstore/pending', 'ProductController@pending')->name('adminstore-product-pending')->middleware('auth');
    Route::get('/adminstore/terima/{id}', 'ProductController@terima')->name('adminstore-product-terima')->middleware('auth');
    Route::get('/adminstore/tolak/{id}', 'ProductController@tolak')->name('adminstore-product-tolak')->middleware('auth');


    Route::get('/adminstore/tambahproduk', 'ProductController@create')->name('tambahproduk')->middleware('auth');
    Route::post('/adminstore/tambahproduk/add', 'ProductController@store')->name('addproduk')->middleware('auth');
    Route::get('/adminstore/editproduk/{id}', 'ProductController@edit')->name('editproduk')->middleware('auth');
    Route::post('/adminstore/updateproduk/{id}', 'ProductController@update')->name('updateproduk')->middleware('auth');

    Route::resource('adminstore-transaction', 'TransactionController')->middleware('auth');
    Route::resource('adminstore-product-gallery', 'ProductGalleryController')->middleware('auth');
    

    
});

//LAHAN
Route::get('/lahan', 'LahanController@lahan')->name('lahan')->middleware('auth');
Route::get('/lahan/create', 'LahanController@create')->name('lahan.create')->middleware('auth');
Route::post('/lahan/simpan', 'LahanController@simpan')->name('lahan.simpan')->middleware('auth');
Route::get('/lahan/kelola_lahan', 'LahanController@kelola_lahan')->name('lahan.kelola_lahan')->middleware('auth');
Route::get('/lahan/ubah/{id}',  'LahanController@ubahlahan')->name('ubahlahan')->middleware('auth');
Route::post('/lahan/update', 'LahanController@updatelahan')->name('updatelahan')->middleware('auth');
Route::get('/lahan/hapus/{id}', 'LahanController@hapus_lahan')->middleware('auth');

Route::post('/lahan/simpan_wbs', 'LahanController@simpan_wbs')->name('simpan_wbs')->middleware('auth');
Route::get('/lahan/update_wbs/{id}', 'LahanController@update_wbs')->name('update_wbs')->middleware('auth');

Route::get('/lahan/simpan_history/{id}', 'LahanController@simpan_history')->middleware('auth');


Route::post('/tambahgantt/{id}', 'TaskController@store')->name('tambahgantt')->middleware('auth');
Route::get('/lahan/detail_lahan/{id}', 'LahanController@detail_lahan')->middleware('auth');
Route::get('/lahan/Dprojek_user/{id}', 'LahanController@Dprojek_user')->middleware('auth');
Route::get('/lahan/dokumentasi/{id}/{penyewa}', 'LahanController@dokumentasi')->middleware('auth');
Route::get('/lahan/projek_user', 'LahanController@projek_user')->middleware('auth');

Route::get('/lahan/ubahSewa/{id}', 'LahanController@ubahSewa')->middleware('auth');
Route::get('/lahan/pembayaran-sewa', 'LahanController@pembayaranSewa')->middleware('auth');
Route::post('/lahan/updateSewa/', 'LahanController@updateSewa')->name('updateSewa')->middleware('auth');

Route::get('/lahan/request/{id}', 'LahanController@request')->name('request')->middleware('auth');
Route::get('/lahan/acc/{id}', 'LahanController@accRequest')->middleware('auth');
Route::get('/lahan/tolak/{id}', 'LahanController@tolakRequest')->middleware('auth');
Route::get('/lahan/doneRequest/{id}', 'LahanController@doneRequest')->middleware('auth');

Route::get('/lahan/struk/{id}', 'LahanController@strukPembayaran')->middleware('auth');
Route::get('/lahan/kelola_struk/{id}', 'LahanController@kelolaStruk')->name('kelolaStruk')->middleware('auth');
Route::get('/lahan/ubah_struk/{id}',  'LahanController@ubahStruk')->middleware('auth');
Route::post('/lahan/update_struk', 'LahanController@updateStruk')->name('updateStruk')->middleware('auth');
Route::get('/lahan/hapus_Struk/{id}', 'LahanController@hapusStruk')->middleware('auth');

Route::post('/lahan/simpan_struk', 'LahanController@simpan_struk')->name('simpan_struk')->middleware('auth');
Route::get('/lahan/ubah_risk/{id}',  'LahanController@ubahRisk')->middleware('auth');
Route::post('/lahan/update_risk', 'LahanController@updateRisk')->name('updateRisk')->middleware('auth');

Route::get('/wbs/{id}', 'LahanController@wbs')->name('wbs')->middleware('auth');
Route::get('/wbs_user/{id}', 'LahanController@wbs_user')->name('wbs')->middleware('auth');
Route::get('/s-curve/wbs/{id}', 'LahanController@scurve')->name('scurve')->middleware('auth');
Route::get('/wbs/boq/{id}', 'LahanController@boq_wbs')->name('boq-wbs')->middleware('auth');

Route::get('/lahan/createRisk/{id}', 'LahanController@createRisk')->name('create_risk')->middleware('auth');
Route::post('/lahan/simpan_risk/{id}', 'LahanController@simpan_risk')->name('simpan_risk')->middleware('auth');
Route::get('/lahan/kelola_risk/{id}', 'LahanController@risk')->name('kelola_risk')->middleware('auth');

Route::get('/lahan/ubah_daily/{id}',  'LahanController@ubahDaily')->middleware('auth');
Route::post('/lahan/update_daily', 'LahanController@updateDaily')->name('updateDaily')->middleware('auth');
Route::get('/lahan/createDaily/{id}', 'LahanController@createDaily')->name('create_daily')->middleware('auth');
Route::post('/lahan/simpan_daily/{id}', 'LahanController@simpan_daily')->name('simpan_daily')->middleware('auth');
Route::get('/lahan/kelola_daily/{id}', 'LahanController@daily')->name('kelola_daily')->middleware('auth');

Route::get('/lahan/kelola_resource/{id}', 'LahanController@kelola_resource')->middleware('auth');

Route::get('/lahan/halmanual/{id}', 'LahanController@detailManual')->middleware('auth');

Route::get('/lahan/create_formWbs/{id}', 'LahanController@formWbs')->name('formWbs')->middleware('auth');
// Route::post('/lahan/tambahKebutuhanWbs/', 'LahanController@kebutuhanWbs')->name('tambahKebutuhanWbs')->middleware('auth');

Route::get('/lahan/orang/{id}', 'LahanController@orang')->middleware('auth');
Route::get('/lahan/material/{id}', 'LahanController@material')->middleware('auth');
Route::get('/lahan/alat/{id}', 'LahanController@alat')->middleware('auth');
Route::post('/lahan/simpan_orang/{id}', 'LahanController@simpan_orang')->name('simpanOrang')->middleware('auth');
Route::post('/lahan/simpan_material/{id}', 'LahanController@simpan_material')->name('tambahMaterial')->middleware('auth');
Route::post('/lahan/simpan_alat/{id}', 'LahanController@simpan_alat')->name('simpanAlat')->middleware('auth');

Route::get('/lahan/ubah_sdm/{id}',  'LahanController@ubahSDM')->middleware('auth');
Route::post('/lahan/update_sdm', 'LahanController@updateSDM')->name('updateSDM')->middleware('auth');
Route::get('/lahan/hapus_sdm/{id}', 'LahanController@hapusSDM')->middleware('auth');


Route::get('/lahan/createManual', 'LahanController@createManual')->name('create_manual')->middleware('auth');
Route::post('/lahan/simpan_manual', 'LahanController@simpan_manual')->name('simpan_manual')->middleware('auth');
Route::get('/lahan/manualBook', 'LahanController@manualBook')->name('manualBook')->middleware('auth');
Route::get('/lahan/lihat_manual/{id}',  'LahanController@lihatManual')->middleware('auth');
Route::get('/lahan/ubah_manual/{id}',  'LahanController@ubahManual')->middleware('auth');
Route::post('/lahan/update_manual', 'LahanController@updateManual')->name('updateManual')->middleware('auth');
Route::get('/lahan/hapus_manual/{id}', 'LahanController@hapusManual')->middleware('auth');

//Route::get('/lahan/boq/{id}', 'LahanController@showBoq')->name('create_boq')->middleware('auth');
Route::get('/lahan/boq/{id}', 'LahanController@createBoq')->name('create_boq')->middleware('auth');




//Peralatan
Route::get('/peralatan', 'PeralatanController@peralatan')->name('peralatan')->middleware('auth');
Route::get('/peralatan/create', 'PeralatanController@create')->name('peralatan.create')->middleware('auth');
Route::post('/peralatan/simpan', 'PeralatanController@simpan')->name('peralatan.simpan')->middleware('auth');
Route::get('/peralatan/kelola_peralatan', 'PeralatanController@kelola_peralatan')->name('peralatan.kelola_peralatan')->middleware('auth');
Route::get('/peralatan/ubah/{id}',  'PeralatanController@ubahperalatan')->name('ubahperalatan')->middleware('auth');
Route::post('/peralatan/update', 'PeralatanController@updateperalatan')->name('updateperalatan')->middleware('auth');
Route::get('/peralatan/hapus_peralatan/{id}', 'PeralatanController@hapus_peralatan')->middleware('auth');
Route::get('/lahan/detail_peralatan/{id}', 'PeralatanController@detail_peralatan')->middleware('auth');
Route::get('/peralatan/sewaPeralatan/{id}', 'PeralatanController@sewaPeralatan')->middleware('auth');
Route::post('/peralatan/updateSewaPeralatan/', 'PeralatanController@updateSewaPeralatan')->name('updateSewaPeralatan')->middleware('auth');

Route::get('/peralatan/request/{id}', 'peralatanController@request')->middleware('auth');
Route::get('/peralatan/acc/{id},{id2},{id3},{id4}', 'peralatanController@accRequest')->middleware('auth');
Route::get('/peralatan/done/{id},{id2},{id3},{id4}', 'peralatanController@doneRequest')->middleware('auth');
Route::get('/peralatan/tolak/{id}', 'peralatanController@tolakRequest')->middleware('auth');
Route::get('/peralatanan/doneRequest/{id}', 'peralatanController@doneRequest')->middleware('auth');
// admin peralatan
Route::get('/dashboard/peralatan/pending', 'Admin\PeralatanController@index')->name('dashboard.peralatan-pending')->middleware('auth');
Route::get('/dashboard/peralatan/pending/show/{id}', 'Admin\PeralatanController@show')->name('dashboard.peralatan-pending-show')->middleware('auth');
Route::post('/dashboard/peralatan/approval/{id}', 'Admin\PeralatanController@approval')->name('dashboard.peralatan-pending.approval')->middleware('auth');

Route::get('/lahan/createJadwal/{id}', 'LahanController@createJadwal')->name('create_jadwal')->middleware('auth');
Route::get('/jadwal/kelola/{id}', 'LahanController@kelola_jadwal')->name('kelola_jadwal')->middleware('auth');
Route::post('/jadwal/simpan_jadwal/{id}', 'LahanController@simpan_jadwal')->name('simpan_jadwal')->middleware('auth');
Route::get('/lahan/ubah_jadwal/{id}',  'LahanController@ubahJadwal')->middleware('auth');
Route::post('/lahan/update_jadwal', 'LahanController@updateJadwal')->name('updateJadwal')->middleware('auth');
Route::get('/lahan/lihat_jadwal/{id}',  'LahanController@lihat_kalender')->middleware('auth');

Route::get('/peralatan/transaksi', 'PeralatanController@transaksi')->name('transaksi.peralatan')->middleware('auth');
Route::get('/peralatan/bukti_bayar/{id}', 'PeralatanController@bukti_bayar')->middleware('auth');
Route::post('/peralatan/simpan_bukti', 'PeralatanController@simpan_bukti')->name('uploadBukti')->middleware('auth');
// Auth::routes();
// Auth::routes();
