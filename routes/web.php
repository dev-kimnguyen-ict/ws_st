<?php
Route::group(['domain' => env('APP_DOMAIN')], function () {
    // Index page:
    Route::get('/', 'TemplateController@index');

    // Auth:
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('auth.getLogin');
    Route::post('login', 'Auth\LoginController@login')->name('auth.postLogin');
    Route::get('logout', 'Auth\LoginController@logout')->name('auth.logout');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.getRegister');
    Route::post('register', 'Auth\RegisterController@register')->name('auth.postRegister');
    Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm')->name('password.getPasswordReset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.postPasswordReset');
    Route::post('password/email', 'Auth\ResetPasswordController@sendResetLinkEmail')->name('password.sendToEmail');
    Route::get('auth/{provider}', 'Auth\SocialController@redirectToProvider')->name('auth.social.redirect');
    Route::get('auth/{provider}/callback', 'Auth\SocialController@handleProviderCallback')->name('auth.social.callback');

    /*
    // Admin area:
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'Admin\PagesController@dashboard')->name('admin.dashboard');
        Route::get('/orders', 'Admin\OrderManagerController@index')->name('admin.order.index');
        Route::resource('upload', 'Api\Upload\UploadController', ['as' => 'admin', 'only' => ['store', 'create']]);

        Route::resource('category', 'Admin\CategoryController', ['as' => 'admin']);
        Route::resource('product', 'Admin\ProductController', ['as' => 'admin']);
        Route::get('/category/filter', 'Admin\CategoryController@filter')->name('admin.category.filter');

        Route::group(['prefix' => 'products'], function () {
            Route::get('/filter', 'Admin\ProductManagerController@filter')->name('admin.product.filter');
            Route::put('/images/{id}', 'Admin\ImagesController@saveImageProduct')->name('admin.product.saveImage');
            Route::delete('/images/{id}', 'Admin\ImagesController@removeImageProduct')->name('admin.product.removeImage');
        });

        Route::group(['prefix' => 'accounts'], function () {
            Route::get('/', 'Admin\AccountManagerController@index')->name('admin.account.index');
            Route::get('/filter', 'Admin\AccountManagerController@filter')->name('admin.account.filter');
            Route::get('/create', 'Admin\AccountManagerController@create')->name('admin.account.create');
            Route::post('/create', 'Admin\AccountManagerController@store')->name('admin.account.store');
            Route::get('/edit/{id}', 'Admin\AccountManagerController@edit')->name('admin.account.edit');
            Route::put('/edit/{id}', 'Admin\AccountManagerController@update')->name('admin.account.update');
            Route::delete('/delete/{id}', 'Admin\AccountManagerController@destroy')->name('admin.account.destroy');
            Route::get('/details/{id}', 'Admin\AccountManagerController@show')->name('admin.account.show');
        });
    });
    */

    /*
    // Web routes:
    Route::group(['prefix' => '/'], function () {
        Route::get('/', 'PagesController@index')->name('web.homepage');
        Route::get('/gioi-thieu{subfix?}', 'PagesController@about')->name('app.page.about');
        Route::get('/lien-he{subfix?}', 'PagesController@contact')->name('app.page.contact');
        Route::get('/san-pham-moi{subfix?}', 'ProductController@new')->name('app.product.new');
        Route::get('/san-pham-noi-bat{subfix?}', 'ProductController@featured')->name('app.product.featured');

        // Xử lý thanh toán khi đã đăng nhập
        Route::get('/dat-hang-va-thanh-toan{subfix?}', 'OrderController@insert')->name('app.order.checkout');
        Route::post('/dat-hang-va-thanh-toan{subfix?}', 'OrderController@postCustomer')->name('app.order.postCustomer');
        Route::get('/search', 'ProductController@search')->name('app.product.search');
        Route::get('gio-hang{subfix?}', 'Ajax\CartController@getList')->name('app.cart.list');

        // Car routes:
        Route::group(['prefix' => 'gio-hang'], function () {
            Route::put('them-san-pham{subfix?}', 'Ajax\CartController@insert')->name('app.cart.insert');
            Route::delete('xoa-san-pham{subfix?}', 'Ajax\CartController@remove')->name('app.cart.remove');
            Route::put('cap-nhat-so-luong{subfix?}', 'Ajax\CartController@update')->name('app.cart.update');
            Route::delete('huy-gio-hang{subfix?}', 'Ajax\CartController@destroy')->name('app.cart.destroy');
        });

        // Trang danh mục sản phẩm phải được đặt ở cuối cùng trong file này để không bị xung đột route:
        Route::get('/{categoryAlias}/{productAlias}{subfix?}', 'ProductController@detail')->name('app.product.detail');
        Route::get('/{categoryAlias}{subfix?}', 'ProductController@category')->name('app.product.category');
    });
    */
});

Route::group(['domain' => 'admin.' . env('APP_DOMAIN'), 'as' => 'admin.'], function () {
    // Authenticated admin:
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/', function () {
            return 'Admin area';
        });
    });

    $handle = function () {
        return view('admin_index');
    };

    // Not authenticated:
    Route::group(['middleware' => 'guest:admin'], function () use ($handle) {
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('api.auth.getLogin');
        Route::post('login', 'Auth\LoginController@login')->name('auth.postLogin');
        Route::get('logout', 'Auth\LoginController@logout')->name('auth.logout');
        Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.getRegister');
        Route::post('register', 'Auth\RegisterController@register')->name('auth.postRegister');
        Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm')->name('password.getPasswordReset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.postPasswordReset');
        Route::post('password/email', 'Auth\ResetPasswordController@sendResetLinkEmail')->name('password.sendToEmail');
        Route::get('auth/{provider}', 'Auth\SocialController@redirectToProvider')->name('auth.social.redirect');
        Route::get('auth/{provider}/callback', 'Auth\SocialController@handleProviderCallback')->name('auth.social.callback');
   });
});
