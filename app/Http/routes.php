<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Http\Request;


Route::get('/', function () {
    return view('welcome');

});

Route::get('/brackets/messages', 'BracketController@messages');
Route::resource('brackets', 'BracketController');


Route::post('/captcha', function(Request $request){
    $rules = ['g-recaptcha-response' => 'GoogleRecaptcha'];
    $data = $request->only(['g-recaptcha-response']);
    $v = Validator::make($data, $rules);
    if ($v->fails()) {
        return ['errors' => $v->errors()->getMessages()];
    }

});


Route::group(['prefix' => 'api/v1'], function() {
    Route::resource('brands', 'Api\V1\BrandController');

    Route::resource('products', 'Api\V1\ProductController');

    Route::resource('notifications', 'Api\V1\NotificationController');

    Route::resource('roles', 'Api\V1\RoleController');

    Route::resource('permissions', 'Api\V1\PermissionController');

    Route::resource('teams', 'Api\V1\TeamController');

    Route::resource('order-items', 'Api\V1\OrderItemController');

    Route::resource('user-transaction-histories', 'Api\V1\UserTransactionHistoryController');

    Route::resource('auction-winners', 'Api\V1\AuctionWinnerController');

    Route::resource('auction-bids', 'Api\V1\AuctionBidController');

    Route::resource('cart-items', 'Api\V1\CartItemController');

    Route::resource('cms-banners', 'Api\V1\CmsBannerController');

    Route::resource('cron-statuses', 'Api\V1\CronStatusController');

    Route::resource('cv-items', 'Api\V1\CvItemController');

    Route::resource('images', 'Api\V1\ImageController');

    Route::resource('invalid-postal-codes', 'Api\V1\InvalidPostalCodeController');

    Route::resource('jobs', 'Api\V1\JobController');

    Route::resource('migrations', 'Api\V1\MigrationController');

    Route::resource('password-resets', 'Api\V1\PasswordResetController');

    Route::resource('point-types', 'Api\V1\PointTypeController');

    Route::resource('prod-images', 'Api\V1\ProdImageController');

    Route::resource('product-codes', 'Api\V1\ProductCodeController');

    Route::resource('product-option-groups', 'Api\V1\ProductOptionGroupController');

    Route::resource('product-option-types', 'Api\V1\ProductOptionTypeController');

    Route::resource('product-options', 'Api\V1\ProductOptionController');

    Route::resource('role-permissions', 'Api\V1\RolePermissionController');

    Route::resource('shared-items', 'Api\V1\SharedItemController');

    Route::resource('social-connections', 'Api\V1\SocialConnectionController');

    Route::resource('sweepstakes', 'Api\V1\SweepstakeController');

    Route::resource('tmp-images', 'Api\V1\TmpImageController');

    Route::resource('used-code-logs', 'Api\V1\UsedCodeLogController');

    Route::resource('user-logs', 'Api\V1\UserLogController');

    Route::resource('user-roles', 'Api\V1\UserRoleController');

    Route::resource('watched-auctions', 'Api\V1\WatchedAuctionController');

    Route::resource('wishlist-items', 'Api\V1\WishlistItemController');

    Route::resource('failed-jobs', 'Api\V1\FailedJobController');
    Route::resource('addresses', 'Api\V1\AddressController');
    Route::resource('auctions', 'Api\V1\AuctionController');
    Route::resource('users', 'Api\V1\UserController');

});

Route::group(['prefix' => 'admin'], function() {
    Route::resource('addresses', 'Admin\AddressController');
    Route::resource('auction-bids', 'Admin\AuctionBidController');
    Route::resource('auctions', 'Admin\AuctionController');
    Route::resource('auction-winners', 'Admin\AuctionWinnerController');
    Route::resource('brands', 'Admin\BrandController');
    Route::resource('cart-items', 'Admin\CartItemController');
    Route::resource('cms-banners', 'Admin\CmsBannerController');
    Route::resource('cron-statuses', 'Admin\CronStatusController');
    Route::resource('cv-items', 'Admin\CvItemController');
    Route::resource('failed-jobs', 'Admin\FailedJobController');
    Route::resource('images', 'Admin\ImageController');
    Route::resource('invalid-postal-codes', 'Admin\InvalidPostalCodeController');
    Route::resource('jobs', 'Admin\JobController');
    Route::resource('migrations', 'Admin\MigrationController');
    Route::resource('notifications', 'Admin\NotificationController');
    Route::resource('order-items', 'Admin\OrderItemController');
    Route::resource('password-resets', 'Admin\PasswordResetController');
    Route::resource('permissions', 'Admin\PermissionController');
    Route::resource('point-types', 'Admin\PointTypeController');
    Route::resource('prod-images', 'Admin\ProdImageController');
    Route::resource('product-codes', 'Admin\ProductCodeController');
    Route::resource('products', 'Admin\ProductController');
    Route::resource('product-options', 'Admin\ProductOptionController');
    Route::resource('product-option-groups', 'Admin\ProductOptionGroupController');
    Route::resource('product-option-types', 'Admin\ProductOptionTypeController');
    Route::resource('roles', 'Admin\RoleController');
    Route::resource('role-permissions', 'Admin\RolePermissionController');
    Route::resource('shared-items', 'Admin\SharedItemController');
    Route::resource('social-connections', 'Admin\SocialConnectionController');
    Route::resource('sweepstakes', 'Admin\SweepstakeController');
    Route::resource('teams', 'Admin\TeamController');
    Route::resource('tmp-images', 'Admin\TmpImageController');
    Route::resource('used-code-logs', 'Admin\UsedCodeLogController');
    Route::resource('users', 'Admin\UserController');
    Route::resource('user-logs', 'Admin\UserLogController');
    Route::resource('user-roles', 'Admin\UserRoleController');
    Route::resource('user-transaction-histories', 'Admin\UserTransactionHistoryController');
    Route::resource('watched-auctions', 'Admin\WatchedAuctionController');
    Route::resource('wishlist-items', 'Admin\WishlistItemController');
});
