<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\CartController;
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

// Route::resource('transaction', TransactionController::class);
// Route::resource('transaction/showDataAjax', [TransactionController::class, 'showAjax'])->name('transaction.showAjax');
Route::resource('transaction', TransactionController::class)->middleware('auth');
Route::post('transaction/showDataAjax/', [TransactionController::class, 'showAjax'])->name('transaction.showAjax');

Route::resource('hotels', HotelController::class);
Route::get('hotels/uploadLogo/{hotel_id}', [HotelController::class, 'uploadLogo']);
Route::post('hotels/simpanLogo', [HotelController::class, 'simpanLogo']);
Route::get('hotels/uploadPhoto/{hotel_id}', [HotelController::class, 'uploadPhoto'])->name('uploadPhoto');
Route::post('hotels/simpanPhoto', [HotelController::class, 'simpanPhoto']);


Route::resource('products',ProductController::class);
Route::get('products/uploadPhoto/{product_id}', [ProductController::class, 'uploadPhoto']);
Route::post('products/simpanPhoto', [ProductController::class, 'simpanPhoto']);
Route::post('product/delPhoto', [ProductController::class, 'delPhoto']);

Route::resource('type', TypesController::class);
Route::resource('customer', CustomerController::class);

//routing untuk membuka halaman welcome.blade.php saat program dijalankan
Route::get('/', function () {
    $teletubbies = array('Tinky Winky', 'Dipsy', 'Lalaa', 'Poo');
    return view('welcome', ['name' => 'Jeremy Kenneth Gunawan', 'age' => 15, 'teletubbies' => $teletubbies]);
});

Route::get('/greeting', function () {
    return "Hello World";
});

// //routing untuk membuka halaman welcome.blade.php (cara kedua lebih singkat) -> http://127.0.0.1:8000/welcome
// Route::view('/welcome', 'welcome');

//{id} : parameter (contoh saat dijalankan : http://127.0.0.1:8000/user/1)
Route::get('/user/{id}', function ($id) {
    return 'User '.$id;
});

//{name} : parameter (contoh saat dijalankan : http://127.0.0.1:8000/user)
Route::get('/user/{name?}', function ($name = 'John') {
    return 'User '.$name;
});

// //{name} : parameter (contoh saat dijalankan : http://127.0.0.1:8000/kategori)
// Route::get('/kategori/{name?}', function ($name='semua') {
//     if ($name=='semua') {
//         return "Daftar semua kategori";
//     }
//     //{name} : parameter (contoh saat dijalankan : http://127.0.0.1:8000/kategori/...name...)
//     else {
//         return 'Daftar Produk Kategori tiket terkait '.$name;
//     }
// });

Route::get('report/availableHotelRooms', [HotelController::class, 'availableHotelRoom'])->name('reportShowHotel');
Route::get('report/avgPriceByHotelType', [ProductController::class, 'averagePrice'])->name('reportAverage');

Route::view('dashboard','dashboard')->name('dashboard');

//{name} : parameter (contoh saat dijalankan : http://127.0.0.1:8000/kategori)
Route::get('/kategori/{name?}', function ($name='semua') {
    if ($name=='semua') {
        return view('home');
    }
    //{name} : parameter (contoh saat dijalankan : http://127.0.0.1:8000/kategori/sinema)
    else {
        $sinema = [
            'kisahCinta' => [
                'gambar' => 'https://cdn.idntimes.com/content-images/community/2023/08/up-86a8958d684b5501cf70ebcd5a5544eb-70766367481aad1124313a5bd6616d8c_600x400.jpg',   
                'deskripsi' => 'Film animasi telah lama menjadi sarana untuk menceritakan cerita-cerita yang memukau. Tidak hanya untuk anak-anak tetapi juga orang dewasa. Kekuatan unik film animasi terletak pada kemampuannya untuk menghadirkan drama dan romansa dengan cara yang begitu magis dan tak terduga. Dalam artikel ini, kita akan menjelajahi sembilan film animasi yang dengan indah menggambarkan kisah-kisah cinta yang menyentuh. Dari petualangan di atas awan hingga perjalanan melintasi waktu, mari kita meresapi keajaiban dari kisah-kisah cinta yang terpapar di dalam dunia animasi yang luar biasa.'
            ],
            'horror' => [
                'gambar' => 'https://cdn.idntimes.com/content-images/community/2023/07/pirdqkggz6chd-f4bf960c52118b7e07e330691e856b93-7677d9938f1428bd79ead715bb6d610e_600x400.jpg',   
                'deskripsi' => 'Channel ini menyajikan beragam konten horor, mulai dari kisah-kisah urban legend, cerita-cerita azab, dan kumpulan trivia seram lainnya. Beberapa video berisikan kisah yang dibawakan oleh narator, sementara video lainnya didukung dengan pengisi suara untuk membuat suasana lebih menegangkan.Durasi video pada channel ini bervariasi, berkisar antara 8 hingga 30 menit. Di beberapa video, kalian juga akan berkenalan dengan karakter Rizky, Ko Andy, dan Ratri, yang merupakan tim di balik pembuatan konten-konten channel Rizky Riplay.'
            ],
            'anime' => [
                'gambar' => 'https://cdn1-production-images-kly.akamaized.net/Y7nDuFFaCmPMQDaKOwAWD6O9L60=/640x360/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/1439644/original/036301500_1482131773-screenrant.jpg',
                'deskripsi' => 'Meski Naruto hanya tokoh fiksi, tak sedikit orang yang termotivasi melihat kisah hidupnya. Jadi, tak salah jika kamu juga bisa mengambil hal positif dari anime yang kali pertama dipublikasikan pada 1997 ini.',
            ]
        ];

        //mengambil data dalam array untuk dikirimkan ke halaman sinema
        return view('sinema', ['cinema' => $sinema]);



    }


});

Route::post('customtype/getEditForm',[TypesController::class,'getEditForm'])->name('type.getEditForm');
Route::post('customtype/getEditFormB',[TypesController::class,'getEditFormB'])->name('type.getEditFormB');
Route::post('customtype/saveDataTD',[TypesController::class,'saveDataTD'])->name('type.saveDataTD');
Route::post('customtype/deleteData',[TypesController::class,'deleteData'])->name('type.deleteData');

Route::post('customcustomer/getEditForm',[CustomerController::class,'getEditForm'])->name('customer.getEditForm');
Route::post('customcustomer/getEditFormB',[CustomerController::class,'getEditFormB'])->name('customer.getEditFormB');
Route::post('customcustomer/saveDataTD',[CustomerController::class,'saveDataTD'])->name('customer.saveDataTD');

Route::post('customproduct/getEditForm',[ProductController::class,'getEditForm'])->name('product.getEditForm');










Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('type', TypesController::class)->middleware('auth');

Route::get('pembeli/index', [PembeliController::class, 'viewIndex'])->name('index');
Route::get('pembeli/reservation', [PembeliController::class, 'viewReservation'])->name('viewReservation');
Route::post('cekproduk', [HotelController::class, 'cekproduk'])->name('cekproduk');
Route::get('/generate-pdf', [PdfController::class, 'generatePdf'])->name('generatePdf');


Route::get('/laralux', [FrontEndController::class, 'index'])->name('laralux.index');
Route::get('/laralux/{laralux}', [FrontEndController::class, 'show'])->name('laralux.show');
Route::middleware(['auth'])->group(function(){
    Route::get('laralux/user/cart', function(){
        return view('frontend.cart');
    })->name('cart');

    Route::get('laralux/cart/add/{id}', [FrontEndController::class, 'addToCart'])->name('addCart');
    Route::get('laralux/cart/delete/{id}', [FrontEndController::class, 'deleteFromCart'])->name('delFromCart');
    Route::post('laralux/cart/addQty', [FrontEndController::class, 'addQuantity'])->name('addQty');
    Route::post('laralux/cart/reduceQty', [FrontEndController::class, 'reduceQuantity'])->name('redQty');
    Route::get('laralux/cart/checkout',[FrontEndController::class,'checkout'])->name('checkout');
});

Route::middleware(['auth'])->group(function(){
    Route::get('laralux/user/cart', function(){
    return view('frontend.cart');
    })->name('cart');
    
    Route::get('laralux/cart/add/{id}', [FrontEndController::class, 'addToCart'])->name('addCart');
    
    Route::get('laralux/cart/delete/{id}', [FrontEndController::class, 'deleteFromCart'])->name('delFromCart');
    Route::post('laralux/cart/addQty', [FrontEndController::class, 'addQuantity'])->name('addQty');
    
    Route::post('laralux/cart/reduceQty', [FrontEndController::class, 'reduceQuantity'])->name('redQty');
    });
Route::post('/apply-discount', [CartController::class, 'applyDiscount'])->name('applyDiscount');

    



