<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComicsController;
use App\Http\Controllers\ChaptersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ContentController;
use App\Http\Middleware\CheckRequest;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use League\Flysystem\FileAttributes;

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

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/del', function () {
    // Storage::disk('google')->delete('');
    $url = Storage::disk('google')->url('project/TẠ U THIÊN SƯ/Chapter 1/1_20230527224015/1_20230527224015.png');    
    dd($url);
    // $delete = Storage::disk('google')->deleteDirectory('project/TẠ U THIÊN SƯ/Chapter 1/1_20230529203027');
    // return $delete;
});

Route::get('put-existing', function() {
    $filename = 'chapters';
    $filePath = public_path('avatar4.png');
    $fileData = File::get($filePath);
    dd($fileData);
    Storage::disk('google')->put($filename, $fileData);

    
    return 'File was saved to Google Drive';
});

// Route::get('list', function() {
//     $files = [];
//     $dir = 'project/TẠ U THIÊN SƯ/Chapter 1';
//     $recursive = true; // Có lấy file trong các thư mục con không?
//     $googleStorage = Storage::disk('google');
//     $contents = collect($googleStorage->listContents($dir, $recursive));
//     // $contents = collect(Storage::disk('google')->getFile());

//     foreach ($contents as $value) {
//         if ($value instanceof FileAttributes) {
//             $files[] = $value;
//         }
//     }

//     dd($files);
//     return $contents->where('type', '=', 'file');
// });

Route::middleware('auth.admin')->prefix('/admin')->name('admin.')->group(function() {

    Route::get('/', function(){
        return view('admin.index');
    })->name('index');

    Route::prefix('/users')->name('users.')->group(function() {

        Route::get('/', [UsersController::class, 'index'])->name('manage-user');

        Route::get('/add', function() {
            return view('admin.user.register');
        })->name('add');

        Route::post('/add', [UsersController::class, 'postAdd'])->name('post-add');

        Route::get('/profile/{id}', [UsersController::class, 'getPofile'])->name('profile');

        Route::get('/delete/{id}', [UsersController::class, 'delete'])->name('delete');

        Route::post('/update-user', [UsersController::class, 'postProfile'])->name('update-profile');
    });

    Route::prefix('/category')->name('categories.')->group(function() {

        Route::get('/', [CategoryController::class, 'index'])->name('manage-category');

        Route::get('/add', [CategoryController::class, 'addCate'])->name('add-category');

        Route::post('/add', [CategoryController::class, 'postAddCate'])->name('post-add-category');

        Route::get('/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('delete-category');

        Route::get('/update-category/{id}', [CategoryController::class, 'editCategory'])->name('edit-category');

        Route::post('/update-category', [CategoryController::class, 'postEditCategory'])->name('post-edit-category');
    });

    Route::prefix('/comics')->name('comics.')->group(function() {

        Route::get('/', [ComicsController::class, 'index'])->name('manage-comic');

        Route::get('/add', [ComicsController::class, 'addComic'])->name('add-comic');

        Route::post('/add', [ComicsController::class, 'postAddComic'])->name('post-add-comic');

        Route::get('/delete/{id}', [ComicsController::class, 'deleteComic'])->name('delete-comic');

        Route::get('/update-comic/{id}', [ComicsController::class, 'editComic'])->name('edit-comic');

        Route::post('/update-comic', [ComicsController::class, 'postEditComic'])->name('post-edit-comic');
    });

    Route::prefix('/chapters')->name('chapters.')->group(function() {

        Route::get('/{id}', [ChaptersController::class, 'index'])->name('manage-chapter');

        Route::get('/add/{id}/{chapter}',[ChaptersController::class, 'addChapter'])->name('add-chapter');

        Route::post('/add', [ChaptersController::class, 'postAddChapter'])->name('post-add-chapter');

        Route::get('/delete/{id}', [ChaptersController::class, 'deleteChapter'])->name('delete-chapter');

        Route::get('/update-chapter/{id}', [ChaptersController::class, 'editChapter'])->name('edit-chapter');

        Route::post('/update-chapter', [ChaptersController::class, 'postEditChapter'])->name('post-edit-chapter');
    });

    Route::prefix('/content')->name('contents.')->group(function() {

        Route::get('/{id}', [ContentController::class, 'index'])->name('manage-content');

        Route::get('/add/{id}',[ContentController::class, 'addContent'])->name('add-content');

        Route::post('/add', [ContentController::class, 'postAddContent'])->name('post-add-content');

        Route::get('/delete/{id}', [ContentController::class, 'deleteContent'])->name('delete-content');

        Route::get('/update-chapter/{id}', [ContentController::class, 'editContent'])->name('edit-content');

        Route::post('/update-chapter', [ContentController::class, 'postEditContent'])->name('post-edit-content');
    });
});

Route::get('/home', [HomeController::class, 'index'])->name('index');
Route::get('/read-comic/{id}', [HomeController::class, 'readComic'])->name('read-comic');
Route::get('/read-chapter/{id}', [HomeController::class, 'readChapter'])->name('read-chapter');
Route::get('/read-chapter-next/{id}/{comic_id}', [HomeController::class, 'readChapterNext'])->name('read-chapter-next');
Route::get('/read-chapter-prev/{id}/{comic_id}', [HomeController::class, 'readChapterPrev'])->name('read-chapter-prev');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/register', [HomeController::class, 'postRegister'])->name('post-register');
Route::get('/forgot-password', [HomeController::class, 'forgotPassword'])->name('forgot-password');
Route::get('/search-category/{id}', [HomeController::class,'searchCategory'])->name('search-category');
Route::post('/post-login', [HomeController::class, 'postLogin'])->name('post-login');
Route::get('/logout', [HomeController::class, 'logoutUser'])->name('logout');
Route::get('/profile-user/{id}', [HomeController::class, 'profileUser'])->name('profile-user');
Route::get('/remove-history/{id}', [HomeController::class, 'removeHistory'])->name('remove-history');