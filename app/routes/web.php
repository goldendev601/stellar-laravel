<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;


Route::get(
    '/', function () {
        return redirect()->route('home');
    }
)->name(
        '/'
    );

//Language Change
Route::get(
    'lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'de', 'es', 'fr', 'pt', 'cn', 'ae'])) {
        abort(400);
    }
    Session()->put('locale', $locale);
    Session::get('locale');
    return redirect()->back();
}
)->name(
    'lang'
);

Route::get('share/assets/{id}', [AssetController::class,'shareAssets'])->name('share.assets');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('doregistration', [AuthController::class, 'doRegistration'])->name('register.doRegistration');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('dologin', [AuthController::class, 'doLogin'])->name('login.doLogin');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('forgotpassword', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forgotpassword', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/members/add', [MemberController::class, 'addMember'])->name('members.add');
Route::get('/member/show/{memberId}', [MemberController::class, 'showMember'])->name('members_show');
Route::post('/member/status-change', [MemberController::class, 'statusChange'])->name('statusChange');
Route::post('/member/search-users', [MemberController::class, 'searchUsers'])->name('searchUsers');
Route::get('/members/interest', [MemberController::class, 'memberInterest'])->name('members.interest');
Route::get('/members/edit/{id}', [MemberController::class, 'editMember'])->name('members.edit');
Route::post('/members/insert', [MemberController::class, 'insertMember'])->name('members.insert');
Route::post('/members/update/{id}', [MemberController::class, 'updateMember'])->name('members.update');

Route::prefix('dashboard')->group(
    function () {
        Route::get('index', [HomeController::class,'index'])->name('index');
        // Route::view('members', 'dashboard.members')->name('members');
        Route::view('assets', 'dashboard.assets')->name('assets1');
    }
);



Route::prefix('others')->group(
    function () {
        Route::view('400', 'errors.400')->name('error-400');
        Route::view('401', 'errors.401')->name('error-401');
        Route::view('403', 'errors.403')->name('error-403');
        Route::view('404', 'errors.404')->name('error-404');
        Route::view('500', 'errors.500')->name('error-500');
        Route::view('503', 'errors.503')->name('error-503');
    }
);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/members', [App\Http\Controllers\MemberController::class, 'index'])->name('members');
Route::get('/members-export-csv', [App\Http\Controllers\MemberController::class, 'membersExportCSV'])->name('members_export_csv');


Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account');
Route::get('/account/edit-name', [App\Http\Controllers\AccountController::class, 'editName'])->name('editName');
Route::get('image-crop', [App\Http\Controllers\AccountController::class, "index"]);
Route::post('image-crop', [App\Http\Controllers\AccountController::class, "imageCropPost"])->name("imageCrop");
Route::post('/account/edit-avatar', [App\Http\Controllers\AccountController::class, "editAvatar"])->name("editAvatar");

Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('settings');
Route::post('/set-password', [App\Http\Controllers\SettingController::class, 'submitResetPasswordForm'])->name('set-password');

Route::middleware(['superadmin'])->group(function() {
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/edit/{id}', [UserController::class, 'editUser'])->name('users.edit');
    Route::post('/users/update/{id}', [UserController::class, 'updateUser'])->name('users.update');
});

Route::prefix('assets')->group(
    function () {
        Route::get('/index/{id?}', [App\Http\Controllers\AssetController::class, 'index'])->name('assets_index');
        Route::get('/show/{asset}', [App\Http\Controllers\AssetController::class, 'showAsset'])->name('assets_show');
        Route::get('/create', [App\Http\Controllers\AssetController::class, 'create'])->name('create_asset');
        Route::post('/insert', [App\Http\Controllers\AssetController::class, 'insert'])->name('insert_assets');
        Route::get('/list', [App\Http\Controllers\AssetController::class, 'list'])->name('assets_list');
        Route::get('/edit/{id}', [App\Http\Controllers\AssetController::class, 'edit'])->name('assets_edit');
        Route::get('/delete/{id}', [App\Http\Controllers\AssetController::class, 'delete'])->name('assets_delete');
        Route::get('/send-payment-link/{id}', [App\Http\Controllers\AssetController::class, 'sendPaymentLink'])->name('assets_send_payment_link');
        Route::get('/preview/{category}/{id}', [App\Http\Controllers\AssetController::class, 'showAssetPreview'])->name('assets_preview');
        Route::post('/seller/insert', [App\Http\Controllers\AssetController::class, 'createNewSeller'])->name('seller_insert');
        Route::get('/receivedAssetList/{id}', [App\Http\Controllers\AssetController::class, 'getReceivedAssetList'])->name('get_received_asset_list');
        Route::post('/share', [App\Http\Controllers\AssetController::class, 'assetShare'])->name('assetShare');
    }
);

Route::prefix('library')->group(
    function () {
        Route::get('/index', [App\Http\Controllers\LibraryController::class, 'index'])->name('library_index');
        Route::get('/create', [App\Http\Controllers\LibraryController::class, 'create'])->name('create_library');
        Route::post('/store', [App\Http\Controllers\LibraryController::class, 'store'])->name('save_library');
        Route::get('/edit/{id}', [App\Http\Controllers\LibraryController::class, 'edit'])->name('library_edit');
        Route::get('/show/{id}', [App\Http\Controllers\LibraryController::class, 'libraryShow'])->name('library_show');
        Route::get('/delete/image/{id}', [App\Http\Controllers\LibraryController::class, 'deleteImage'])->name('deleteImage');
    }
);

Route::prefix('conversations')->group(
    function () {
        Route::get('/index/{id?}', [App\Http\Controllers\ConversationController::class, 'index'])->name('conversations_index');
        Route::get('/create', [App\Http\Controllers\ConversationController::class, 'create'])->name('conversations_library');
        Route::get('/show/{id}', [App\Http\Controllers\ConversationController::class, 'showConversations'])->name('conversations_show');
    }
);

