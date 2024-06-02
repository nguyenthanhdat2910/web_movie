<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrangChu_controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuocGiaController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\TapPhimController;
use App\Http\Controllers\PhimController;
use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\InfoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|chieuphim
*/
Route::get('/', [TrangChu_controller::class, 'Trangchu'])->name('homepage');

Route::get('/danh_muc/{slug}', [TrangChu_controller::class, 'danhmuc'])->name('danh_muc');
Route::get('/quoc_gia/{slug}', [TrangChu_controller::class, 'quocgia'])->name('quoc_gia');
Route::get('/tap_phim', [TrangChu_controller::class, 'tapphim'])->name('tap_phim');
Route::get('/the_loai_phim/{slug}', [TrangChu_controller::class, 'theloaiphim'])->name('the_loai_phim');
Route::get('/ctphim/{slug}', [TrangChu_controller::class, 'ctphim'])->name('ct_phim');
Route::get('/chieu_phim/{slug}/{tap}', [TrangChu_controller::class, 'chieuphim'])->name('chieu_phim');
Route::get('/year/{year}', [TrangChu_controller::class, 'year']);
Route::get('/tag/{tag}', [TrangChu_controller::class, 'tag']);
Route::get('/tim-kiem', [TrangChu_controller::class, 'timkiem'])->name('tim-kiem');
Route::get('/locphim', [TrangChu_controller::class, 'locphim'])->name('locphim');
Route::post('/add-rating', [TrangChu_controller::class, 'add_rating'])->name('add-rating');



Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('danhmuc', DanhMucController::class);
Route::resource('theloai', TheLoaiController::class);
Route::resource('phim', PhimController::class);
Route::resource('quocgia', QuocGiaController::class);
Route::resource('tapphim', TapPhimController::class);
Route::resource('info', InfoController::class);


Route::get('select-phim', [TapPhimController::class,'select_phim'])->name('select-phim');
Route::get('add-ep/{id}', [TapPhimController::class,'Add_ep'])->name('add-ep');

Route::get('/update-year-phim', [PhimController::class, 'update_year']);
Route::get('/update-topview-phim', [PhimController::class, 'update_topview']);
Route::get('/filter-topview-phim', [PhimController::class, 'filter_topview']);
Route::get('/filter-topview-ready', [PhimController::class, 'filter_topview_ready']);
Route::get('/sort-phim', [PhimController::class, 'sort_phim'])->name('sort-phim');

// ajax phần tử phim
Route::get('/thay-danhmuc', [PhimController::class, 'thay_danhmuc'])->name('thay-danhmuc');
Route::get('/thay-quocgia', [PhimController::class, 'thay_quocgia'])->name('thay-quocgia');
Route::get('/thay-hot', [PhimController::class, 'thay_hot'])->name('thay-hot');
Route::get('/thay-vietsub', [PhimController::class, 'thay_vietsub'])->name('thay-vietsub');
Route::get('/thay-status', [PhimController::class, 'thay_status'])->name('thay-status');
Route::get('/thay-phimle', [PhimController::class, 'thay_phimle'])->name('thay-phimle');
Route::get('/thay-resolution', [PhimController::class, 'thay_resolution'])->name('thay-resolution');
Route::post('/update-new-image', [PhimController::class, 'update_new_image'])->name('update-new-image');
Route::post('/nav-resorting', [PhimController::class, 'nav_resorting'])->name('nav-resorting');
Route::post('/phim-resorting', [PhimController::class, 'phim_resorting'])->name('phim-resorting');
