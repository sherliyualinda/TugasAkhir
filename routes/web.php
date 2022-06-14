<?php

use App\Http\Controllers\GanttController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Lahan;


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
    $_SESSION['id_lahan'] = $id;
    $lahan = Lahan::select('*')->where('id', $id)->get();
    return view('gantt',['lahan' => $lahan]);
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
Route::get('/sosial-media/profil/{username}', 'Sosmed_Con@lihat_profil');
Route::get('/sosial-media/profil/{username}', 'Sosmed_Con@lihat_profil')->name('sosial-media.profil');
Route::get('/sosial-media/tambah_teman2/{username}', 'Sosmed_Con@tambah_teman2');
Route::get('/sosial-media/hapus_following/{username}', 'Sosmed_Con@hapus_following');
Route::get('/sosial-media/hapus_followers/{username}', 'Sosmed_Con@hapus_followers');
Route::post('/sosial-media/post_komen_dari_profil', 'Sosmed_Con@post_komen_dari_profil');
Route::post('/sosial-media/ubah_foto_sampul', 'Sosmed_Con@ubah_foto_sampul');
Route::post('/sosial-media/ubah_foto_profil', 'Sosmed_Con@ubah_foto_profil');

//FOLLOW REQUEST
Route::get('/sosial-media/terima_request/{id}', 'Sosmed_Con@terima_request');
Route::get('/sosial-media/tolak_request/{id}', 'Sosmed_Con@tolak_request');
Route::get('/sosial-media/batal_request/{id}', 'Sosmed_Con@batal_request');

//PENGATURAN
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




Route::group(['middleware' => ['auth']], function(){

Route::get('/cart', 'CartController@index')->name('cart');
Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');

Route::post('/checkout', 'CheckoutController@process')->name('checkout');
Route::post('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');



Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/dashboard/products', 'DashboardProductController@index')->name('dashboard-product');
Route::get('/dashboard/products/create', 'DashboardProductController@create')->name('dashboard-product-create');
Route::post('/dashboard/products', 'DashboardProductController@store')->name('dashboard-product-store');
Route::get('/dashboard/products/{id}', 'DashboardProductController@details')->name('dashboard-product-details');
Route::post('/dashboard/products/{id}', 'DashboardProductController@update')->name('dashboard-product-update');

Route::post('/dashboard/products/gallery/upload', 'DashboardProductController@uploadGallery')->name('dashboard-product-gallery-upload');
Route::get('/dashboard/products/gallery/delete/{id}', 'DashboardProductController@deleteGallery')->name('dashboard-product-gallery-delete');

Route::get('/dashboard/transactions', 'DashboardTransactionController@index')->name('dashboard-transaction');
Route::get('/dashboard/transactions/{id}', 'DashboardTransactionController@details')->name('dashboard-transaction-details');
Route::post('/dashboard/transactions/{id}', 'DashboardTransactionController@update')->name('dashboard-transaction-update');


Route::get('/konfirmasistatuscustomer/{id}', 'DashboardTransactionController@konfirmasistatuscustomer')->name('konfirmasistatuscustomer');
Route::get('/konfirmasistatuspenjual/{id}', 'DashboardTransactionController@konfirmasistatuspenjual')->name('konfirmasistatuspenjual');



Route::get('/dashboard/settings', 'DashboardSettingController@store')->name('dashboard-settings-store');
Route::get('/dashboard/account', 'DashboardSettingController@account')->name('dashboard-settings-account');
Route::post('/dashboard/account/{redirect}', 'DashboardSettingController@update')->name('dashboard-settings-redirect');





});


Route::prefix('admin')
->namespace('Admin')
->middleware(['auth','admin'])
->group(function() {
    Route::get('/', 'DashboardController@index')->name('admin-dashboard');
    Route::resource('category', 'CategoryController');
    Route::resource('user', 'UserController');
    Route::resource('admin-store-user', 'AdminStoreController');
    Route::resource('product', 'ProductController');
    Route::resource('transaction', 'TransactionController');
    Route::resource('product-gallery', 'ProductGalleryController');
    Route::get('delete/{id}','UserController@destroy')->name('delete-user');
});



Route::prefix('adminstore')
->namespace('AdminStore')
->middleware(['auth','adminstore'])
->group(function() {
    Route::get('/', 'DashboardController@index')->name('admin-store-dashboard');
    Route::resource('adminstore-category', 'CategoryController');
    Route::resource('adminstore-user', 'UserController');
    Route::get('/adminstore/user/tambahdata', 'UserController@create')->name('tambahdata');
    Route::post('/adminstore/user/add', 'UserController@store')->name('adddata');

    
    Route::resource('adminstore-product', 'ProductController');
    Route::get('/adminstore/pending', 'ProductController@pending')->name('adminstore-product-pending');
    Route::get('/adminstore/terima/{id}', 'ProductController@terima')->name('adminstore-product-terima');
    Route::get('/adminstore/tolak/{id}', 'ProductController@tolak')->name('adminstore-product-tolak');


    Route::get('/adminstore/tambahproduk', 'ProductController@create')->name('tambahproduk');
    Route::post('/adminstore/tambahproduk/add', 'ProductController@store')->name('addproduk');
    Route::get('/adminstore/editproduk/{id}', 'ProductController@edit')->name('editproduk');
    Route::post('/adminstore/updateproduk/{id}', 'ProductController@update')->name('updateproduk');

    Route::resource('adminstore-transaction', 'TransactionController');
    Route::resource('adminstore-product-gallery', 'ProductGalleryController');

  
    

    
});

//LAHAN
Route::get('/lahan', 'LahanController@lahan')->middleware('auth');
Route::get('/lahan/create', 'LahanController@create')->name('lahan.create')->middleware('auth');
Route::post('/lahan/simpan', 'LahanController@simpan')->name('lahan.simpan')->middleware('auth');
Route::get('/lahan/kelola_lahan', 'LahanController@kelola_lahan')->name('lahan.kelola_lahan')->middleware('auth');
Route::get('/lahan/ubah/{id}',  'LahanController@ubahlahan')->name('ubahlahan')->middleware('auth');
Route::post('/lahan/update', 'LahanController@updatelahan')->name('updatelahan')->middleware('auth');
Route::get('/lahan/hapus/{id}', 'LahanController@hapus_lahan')->middleware('auth');

Route::post('/lahan/simpan_wbs', 'LahanController@simpan_wbs')->name('simpan_wbs')->middleware('auth');
Route::get('/lahan/update_wbs/{id}', 'LahanController@update_wbs')->name('update_wbs')->middleware('auth');




Route::post('/tambahgantt/{id}', 'TaskController@store')->name('tambahgantt')->middleware('auth');
Route::get('/lahan/detail_lahan/{id}', 'LahanController@detail_lahan')->middleware('auth');

Route::get('/lahan/ubahSewa/{id}', 'LahanController@ubahSewa')->middleware('auth');
Route::post('/lahan/updateSewa/', 'LahanController@updateSewa')->name('updateSewa')->middleware('auth');

Route::get('/lahan/request/{id}', 'LahanController@request')->middleware('auth');
Route::get('/lahan/acc/{id}', 'LahanController@accRequest')->middleware('auth');
Route::get('/lahan/tolak/{id}', 'LahanController@tolakRequest')->middleware('auth');
Route::get('/lahan/doneRequest/{id}', 'LahanController@doneRequest')->middleware('auth');

Route::get('/wbs/{id}', 'LahanController@wbs')->name('wbs')->middleware('auth');
Route::get('/wbs_user/{id}', 'LahanController@wbs_user')->name('wbs')->middleware('auth');

Route::get('/lahan/createRisk/{id}', 'LahanController@createRisk')->name('create_risk')->middleware('auth');
Route::post('/lahan/simpan_risk/{id}', 'LahanController@simpan_risk')->name('simpan_risk')->middleware('auth');

Route::get('/lahan/kelola_risk/{id}', 'LahanController@risk')->name('kelola_risk')->middleware('auth');
Route::get('/lahan/create_formBoq/{id}', 'LahanController@formBoq')->name('formBoq')->middleware('auth');
Route::post('/lahan/tambahKebutuhanBoq/', 'LahanController@kebutuhanBoq')->name('tambahKebutuhanBoq')->middleware('auth');


Route::get('/lahan/boq/{id}', 'LahanController@createBoq')->name('create_boq')->middleware('auth');
//Route::get('/lahan/boq/{id}', 'LahanController@showBoq')->name('create_boq')->middleware('auth');



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
Route::get('/peralatan/acc/{id}', 'peralatanController@accRequest')->middleware('auth');
Route::get('/peralatan/tolak/{id}', 'peralatanController@tolakRequest')->middleware('auth');
Route::get('/peralatanan/doneRequest/{id}', 'peralatanController@doneRequest')->middleware('auth');

Auth::routes();
Auth::routes();
