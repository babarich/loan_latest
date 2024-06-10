<?php

use App\Http\Controllers\Borrower\BorrowerController;
use App\Http\Controllers\Borrower\BorrowerGroup;
use App\Http\Controllers\Borrower\GuarantorController;
use App\Http\Controllers\Loan\ProductController;
use App\Http\Controllers\Loan\LoanController;
use App\Http\Controllers\Collateral\CollateralTypeController;
use App\Http\Controllers\Collateral\CollateralController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});


Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});


Route::group(['middleware' => 'auth'], function (){

    Route::group(['prefix' => 'borrower'], function (){

        Route::name('borrow.')->group(function (){
            Route::controller(BorrowerController::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('view/{id?}', 'show')->name('show');
                Route::post('update/{id?}', 'update')->name('update');
                Route::get('export/{id?}', 'downloadAttachment')->name('download');
                Route::get('edit/{id?}', 'edit')->name('edit');
                Route::post('reassign/{id?}', 'reassign')->name('reassign');
                Route::get('borrow_assign/{id?}', 'guarantor')->name('assign');
                Route::post('delete/{id?}', 'delete')->name('delete');
                Route::post('upload_customer_report', 'uploadCustomer')->name('upload');
            });
        });
    });


    Route::group(['prefix' => 'loans'], function (){

        Route::name('loan.')->group(function (){
            Route::controller(LoanController::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::get('settlement', 'settlement')->name('settlement');
                Route::get('rollover', 'rollover')->name('rollover');
                Route::get('closed', 'closed')->name('closed');
                Route::post('store', 'store')->name('store');
                Route::post('check/{id?}', 'checkLoan')->name('check');
                Route::get('view/{id?}', 'show')->name('show');
                Route::get('view_settlement/{id?}', 'showSettlement')->name('viewSettlement');
                Route::get('view_rollover/{id?}', 'showRollover')->name('viewRollOver');
                Route::post('update/{id?}', 'update')->name('update');
                Route::post('settle_payment/{id?}', 'settlePayment')->name('settlePayment');
                Route::post('roll_over_payment/{id?}', 'rolloverPayment')->name('rolloverPayment');
                Route::post('attachment/{id?}', 'attachment')->name('attachment');
                Route::get('export/{id?}', 'downloadAttachment')->name('download');
                Route::get('download_report', 'report')->name('report');
                Route::get('edit/{id?}', 'edit')->name('edit');
                Route::post('repayment/{id?}', 'distributeLoanPayment')->name('payment');
                Route::post('submit_loan/{id?}', 'submitLoan')->name('submit');
                Route::post('delete/{id?}', 'delete')->name('delete');
            });
        });
    });



    Route::group(['prefix' => 'schedules'], function (){

        Route::name('schedule.')->group(function (){
            Route::controller(\App\Http\Controllers\Loan\LoanScheduleController::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('outstanding', 'outstanding')->name('outstanding');
                Route::get('maturity', 'maturity')->name('maturity');
                Route::get('create', 'create')->name('create');
                Route::get('show', 'show')->name('show');
                Route::post('update', 'update')->name('update');
            });
        });
    });


    Route::group(['prefix' => 'guarantors'], function (){

        Route::name('guarantor.')->group(function (){
            Route::controller(GuarantorController::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('view/{id?}', 'show')->name('show');
                Route::post('update/{id?}', 'update')->name('update');
                Route::get('export/{id?}', 'downloadAttachment')->name('download');
                Route::get('edit/{id?}', 'edit')->name('edit');
                Route::post('assign/{id?}', 'assign')->name('assign');
                Route::post('delete/{id?}', 'delete')->name('delete');
                Route::post('upload_guarantor_report', 'uploadCustomer')->name('upload');
            });
        });
    });

    Route::group(['prefix' => 'groups'], function (){

        Route::name('group.')->group(function (){
            Route::controller(BorrowerGroup::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('view/{id?}', 'show')->name('show');
                Route::post('update/{id?}', 'update')->name('update');
                Route::get('edit/{id?}', 'edit')->name('edit');
                Route::post('assign_user/{id?}', 'assignRelation')->name('relation');
                Route::post('delete/{id?}', 'delete')->name('delete');
            });
        });
    });



    Route::group(['prefix' => 'approvals'], function (){

        Route::name('approve.')->group(function (){
            Route::controller(\App\Http\Controllers\Loan\LoanApprovalController::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('approve/{id?}', 'approve')->name('approveFirst');
                Route::post('disburse/{id?}', 'approve')->name('disburse');
                Route::post('reject/{id?}', 'reject')->name('rejectFirst');
                Route::post('comment/{id?}', 'return')->name('comment');
                Route::get('view/{id?}', 'show')->name('show');
                Route::post('update/{id?}', 'update')->name('update');
                Route::get('edit/{id?}', 'edit')->name('edit');
                Route::post('assign_user/{id?}', 'assignRelation')->name('relation');
            });
        });
    });


    Route::group(['prefix' => 'collaterals'], function (){

        Route::name('collateral.')->group(function (){
            Route::controller(CollateralController::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store/{id?}', 'store')->name('store');
                Route::get('download/{id?}', 'downloadAttachment')->name('download');
                Route::get('file_download/{id?}', 'downloadFile')->name('downloadFile');
                Route::post('comment/{id?}', 'storeComment')->name('comment');
                Route::get('comment_index', 'showComment')->name('showComment');
                Route::get('view/{id?}', 'show')->name('show');
                Route::post('attachment_file/{id?}', 'attachment')->name('attach');
                Route::post('update/{id?}', 'update')->name('update');
                Route::get('edit/{id?}', 'edit')->name('edit');
            });
        });
    });


    Route::group(['prefix' => 'collateraltypes'], function (){

        Route::name('collateraltype.')->group(function (){
            Route::controller(CollateralTypeController::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('view/{id?}', 'show')->name('show');
                Route::post('update/{id?}', 'update')->name('update');
                Route::get('edit/{id?}', 'edit')->name('edit');
            });
        });
    });

    Route::group(['prefix' => 'products'], function (){

        Route::name('product.')->group(function (){
            Route::controller(ProductController::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('view/{id?}', 'show')->name('show');
                Route::post('update/{id?}', 'update')->name('update');
                Route::get('edit/{id?}', 'edit')->name('edit');
            });
        });
    });


    Route::group(['prefix' => 'interests'], function (){

        Route::name('interest.')->group(function (){
            Route::controller(\App\Http\Controllers\InterestController::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('view/{id?}', 'show')->name('show');
                Route::post('update/{id?}', 'update')->name('update');
                Route::get('edit/{id?}', 'edit')->name('edit');
            });
        });
    });



    Route::group(['prefix' => 'penaltys'], function (){

        Route::name('penalty.')->group(function (){
            Route::controller(\App\Http\Controllers\PenaltyController::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('view/{id?}', 'show')->name('show');
                Route::post('update/{id?}', 'update')->name('update');
                Route::get('edit/{id?}', 'edit')->name('edit');
            });
        });
    });

    Route::group(['prefix' => 'companies'], function (){

        Route::name('company.')->group(function (){
            Route::controller(\App\Http\Controllers\CompanyController::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('view/{id?}', 'show')->name('show');
                Route::post('update/{id?}', 'update')->name('update');
                Route::get('edit/{id?}', 'edit')->name('edit');
                Route::post('delete', 'delete')->name('delete');
            });
        });
    });


    Route::group(['prefix' => 'payments'], function (){

        Route::name('payment.')->group(function (){
            Route::controller(\App\Http\Controllers\Loan\PaymentController::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('chart', 'chart')->name('chart');
                Route::post('store', 'store')->name('store');
                Route::get('view/{id?}', 'show')->name('show');
                Route::get('collection', 'collection')->name('collection');
                Route::post('update/{id?}', 'update')->name('update');
                Route::get('edit/{id?}', 'edit')->name('edit');
                Route::get('create', 'create')->name('create');
            });
        });
    });

    Route::group(['prefix' => 'users'], function (){
        Route::name('user.')->group(function (){
            Route::controller(UserController::class)->group(function (){
                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::post('assign/{id?}', 'assignRole')->name('assign');
                Route::post('un_assign/{id?}', 'unassignRole')->name('unassign');
            });
        });
    });

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});
require __DIR__.'/auth.php';
