<?php

use App\Http\Controllers\OrderController;
use App\Models\Trade;
use App\Models\Currency;
use Illuminate\Support\Facades\Route;

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

// Auth::guard('admin')->loginUsingId(2);


//Login Routes
Route::get('/login', 'App\Http\Controllers\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\LoginController@logout')->name('logout');





Route::middleware('auth.admin')->namespace('App\Http\Controllers')->group(function () {
    Route::get('/', 'HomeController@index')->name('index');

    Route::resource('permission', 'PermissionController')->except(['create', 'show']);
    Route::resource('role', 'RoleController')->except(['show']);
    Route::get('activity-log', 'ActivityLogController@index')->name('activity-log.index');
    Route::get('api-log', 'ApiLogController@index')->name('api-log.index');

    Route::resource('admins', 'AdminController')->except(['show']);
    Route::get('/admins/reset-google-2fa/{admin}', 'AdminController@resetGoogle2fa')->name('admins.resetGoogle2fa');

    Route::resource('profile', 'ProfileController')->only(['index', 'update', 'store']);
    Route::get('/profile/set-google-2fa', 'ProfileController@setGoogle2fa')->name('profile.setGoogle2fa');

    Route::resource('site-setting', 'SiteSettingController');
    Route::resource('currency', 'CurrencyController');

    Route::resource('slideshow', 'SlideshowController');


    Route::get('/contact-us', 'ContactUsController@index')->name('ContactUs.index');


    Route::get('/policies', 'PoliciesController@index')->name('policies.index');
    Route::put('/policies/update', 'PoliciesController@update')->name('policies.update');

    Route::get('/about', 'AboutController@index')->name('about.index');
    Route::put('/about/update', 'AboutController@update')->name('about.update');



    Route::get('/siteContent', 'SiteContentController@index')->name('siteContent.index');
    Route::post('/siteContent/update', 'SiteContentController@update')->name('siteContent.update');






    Route::get('/market', 'MarketController@index')->name('market.index');
    Route::get('/market/{marketId}/edit', 'MarketController@edit')->name('market.edit');
    Route::put('/market/{marketId}', 'MarketController@update')->name('market.update');

    Route::get('/commission', 'CommissionController@index')->name('commission.index');
    Route::get('/commission/{commissionId}/edit', 'CommissionController@edit')->name('commission.edit');
    Route::put('/commission/{commissionId}', 'CommissionController@update')->name('commission.update');



    Route::get('/deposits-irt', 'DepositIrtController@index')->name('deposits-irt.index');
    Route::get('/deposits', 'DepositController@index')->name('deposits.index');
    Route::post('/deposits/confirm', 'DepositController@confirm')->name('deposits.confirm');
    Route::post('/deposits/unconfirm', 'DepositController@unconfirm')->name('deposits.unconfirm');



    Route::resource('ticket', 'TicketController');
    Route::post('ticket/{id}/reply', 'TicketController@reply')->name('ticket.reply');





    Route::prefix('wallet-address')->name('walletAddress.')->group(function () {
        Route::get('/', 'WalletAddressController@index')->name('index');
        Route::post('/{currencyId}/check', 'WalletAddressController@check')->name('check');
        Route::post('/{currencyId}/insert', 'WalletAddressController@insert')->name('insert');
        Route::post('/{currencyId}/file', 'WalletAddressController@file')->name('file');
        Route::post('/{currencyId}/hash', 'WalletAddressController@hash')->name('hash');
        Route::get('/{walletId}/create', 'WalletAddressController@create')->name('create');
    });









    Route::prefix('withdraw-irt')->name('withdrawIrt.')->group(function () {
        Route::get('/', 'WithdrawIrtController@index')->name('index');
        Route::post('/check-wallet/{userId}', 'WithdrawIrtController@checkWallet')->name('checkWallet');
        Route::post('/check-wallet-withdraw/{withdrawId}', 'WithdrawIrtController@checkWalletWithdraw')->name('checkWalletWithdraw');
        Route::post('/confirm/{withdrawId}', 'WithdrawIrtController@confirm')->name('confirm');
        Route::post('/unconfirm/{withdrawId}', 'WithdrawIrtController@unconfirm')->name('unconfirm');
        Route::post('/payment-info/{withdrawId}', 'WithdrawIrtController@paymentInfo')->name('paymentInfo');
        Route::post('/internal-transfer/{withdrawId}', 'WithdrawIrtController@internalTransfer')->name('internalTransfer');
    });

    Route::prefix('withdraw')->name('withdraw.')->group(function () {
        Route::get('/', 'WithdrawController@index')->name('index');
        Route::post('/check-wallet/{userId}', 'WithdrawController@checkWallet')->name('checkWallet');
        Route::post('/check-wallet-withdraw/{withdrawId}', 'WithdrawController@checkWalletWithdraw')->name('checkWalletWithdraw');
        Route::post('/confirm/{withdrawId}', 'WithdrawController@confirm')->name('confirm');
        Route::post('/unconfirm/{withdrawId}', 'WithdrawController@unconfirm')->name('unconfirm');
        Route::post('/payment-info/{withdrawId}', 'WithdrawController@paymentInfo')->name('paymentInfo');
        Route::post('/internal-transfer/{withdrawId}', 'WithdrawController@internalTransfer')->name('internalTransfer');
    });





    Route::get('/order', 'OrderController@index')->name('order.index');
    Route::post('/order/{orderId}/trades', 'OrderController@trades')->name('order.trades');





    Route::get('/report/wallet', 'ReportWalletController@index')->name('reportWallet.index');
    Route::get('/report/wallet/{currencyId}/user-balances', 'ReportWalletController@show')->name('userBalances.show');

    Route::get('/site/fee', 'SiteFeeController@index')->name('siteFee.index');
    Route::get('/site/fee/indexByCurrency/{currencyId}', 'SiteFeeController@indexByCurrency')->name('siteFee.indexByCurrency');
    Route::post('/site/fee/refresh', 'SiteFeeController@refresh')->name('siteFee.refresh');


    Route::prefix('site-transaction')->name('siteTransaction.')->group(function () {
        Route::get('/create', 'SiteTransactionController@create')->name('create');
        Route::post('/store', 'SiteTransactionController@store')->name('store');
        Route::delete('/destroy/{SiteTransactionId}', 'SiteTransactionController@destroy')->name('destroy');
        Route::get('/{currency}', 'SiteTransactionController@indexByCurrency')->name('index');
    });




    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', 'UserController@index')->name('index');
        Route::get('/{user}', 'UserController@show')->name('show');

        Route::get('{user}/hard-update', 'UserController@showHardUpdate')->name('showHardUpdate');
        Route::post('{user}/store-hard-update', 'UserController@storeHardUpdate')->name('storHardUpdate');

        Route::get('{user}/bank-account', 'UserController@showBankAccount')->name('showBankAccount');
        Route::get('{user}/ticket', 'UserController@ticket')->name('ticket');
        Route::post('{user}/store-bank-account', 'UserController@storeBankAccount')->name('storBankAccount');

        Route::post('{user}/national-card-pic-show', 'UserController@nationalCardPicShow')->name('nationalCardPicShow');
        Route::post('{user}/auth-pic-verified-show', 'UserController@authPicVerifyShow')->name('authPicVerifyShow');

        Route::post('{user}/national-card-pic-remove', 'UserController@nationalCardPicRemove')->name('nationalCardPicRemove');
        Route::post('{user}/auth-pic-verified-remove', 'UserController@authPicVerifyRemove')->name('authPicVerifyRemove');

        Route::post('{user}/check-wallet', 'UserController@checkWallet')->name('checkWallet');


        Route::post('{user}/personal-info-verified', 'UserController@personalInfoVerified')->name('personalInfoVerified');
        Route::post('{user}/address-verified', 'UserController@addressVerified')->name('addressVerified');
        Route::post('{user}/auth-pic-verified', 'UserController@authPicVerified')->name('authPicVerified');
        Route::post('{user}/verified-bank-accounts', 'UserController@verifiedBankAccounts')->name('verifiedBankAccounts');




        Route::post('{user}/manual-user-withdraw-Irt', 'WithdrawIrtController@manualUserWithdrawIrt')->name('manualUserWithdrawIrt');
        Route::post('{user}/manual-user-deposit', 'DepositController@manualUserDeposit')->name('manualUserDeposit');



        Route::get('{user}/currency/{currencyId}/transaction', 'TransactionController@indexByUserCurrency')->name('indexByUserCurrency');
    });
});


Route::get('/test', function () {
    $orderId = 84;
    $data['currencies'] = Currency::Where('id', 1)->with(['wallet' => function ($q) {
        $q->where('user_id', 3);
    }])->get();
    return $data['currencies'];



    $OrderController = new OrderController();
    return $OrderController->trades($orderId);
});
