<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CartController as AdminCartController;
use App\Http\Controllers\Admin\CertificateController as AdminCertificateController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LetterController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Users\CertificateController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\User\AgreementController;
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\RegistrationController;
use App\Http\Controllers\User\TrainingController as UserTrainingController;
use App\Http\Controllers\Users\HomeController;
use App\Http\Controllers\Users\OrderController;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\OrganizationController;
use App\Http\Controllers\User\StaffController;
use App\Http\Controllers\User\StudentController;

use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\LetterController as UserLetterController;
use App\Http\Controllers\UserAgreementController;
// use App\Mail\Admin\NewTransaction;

// use App\Mail\Admin\NewUserRegistration;
// use App\Mail\User\RegistrationApproved;
// use Illuminate\Support\Env;
// use Illuminate\Support\Facades\Mail;

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

Route::get('/', [HomeController::class, 'index'])->name('user.homepage');
Route::get('data-tpa', [HomeController::class, 'organizationList'])->name('user.org_list');
Route::get('login', [UserAuthController::class, 'form'])->name('user.login_form');
Route::post('login', [UserAuthController::class, 'authenticate'])->name('user.login_attempt');
Route::get('signup', [RegistrationController::class, 'form'])->name('user.registration_form');
Route::post('signup', [RegistrationController::class, 'register'])->name('user.submit_registration');

Route::get('forgot-password', [UserAuthController::class, 'askResetPasswordForm'])->name('user.ask_reset_password_form');
Route::post('forgot-password', [UserAuthController::class, 'sendResetPasswordForm'])->name('user.send_reset_password_form');

Route::get('reset-password', [UserAuthController::class, 'resetPasswordForm'])->name('user.reset_password_form');
Route::post('reset-password', [UserAuthController::class, 'resetPasswordAttempt'])->name('user.reset_password_attempt');

Route::get('t_image', [FileController::class, 'trainingBanner'])->name('training.image');

Route::get('events/{id}', [UserTrainingController::class, 'show'])->name('user.training_detail');

Route::get('verifikasi/{id}', [HomeController::class, 'verification'])->name('user.verification');

Route::middleware('auth.user')->group(function () {
    Route::get('logout', [UserAuthController::class, 'logout'])->name('user.logout');
    Route::get('agreement', [UserAgreementController::class, 'index'])->name('user.agreement');
    Route::get('agreement/sign', [UserAgreementController::class, 'sign'])->name('user.sign_agreement');
    Route::middleware('agreed.user')->group(function () {
        Route::prefix('events')->group(function () {
            Route::get('{id}/order', [UserOrderController::class, 'orderTraining'])->name('user.order_training');
            Route::post('{id}/fill-order', [UserOrderController::class, 'fillOrder'])->name('user.fill_order');
            // Route::get('{id}/checkout', [UserTrainingController::class, 'checkout'])->name('user.checkout_training');
            // Route::post('{id}/order', [OrderController::class, 'createOrder'])->name('user.create_training_order');
            // Route::post('{id}/order', [OrderController::class, 'placeOrder'])->name('user.order_training');
        });
        Route::prefix('transactions')->group(function () {
            Route::get('/', [UserOrderController::class, 'index'])->name('user.order_index');
            Route::get('{id}', [UserOrderController::class, 'show'])->name('user.detail_order');
            // Route::get('{id}/complete-order', [OrderController::class, 'completeOrder'])->name('user.complete_order');
            // Route::put('{id}/complete-order', [OrderController::class, 'storeCompletedOrder'])->name('user.store_completed_order');
            // Route::get('{id}/select-payment', [OrderController::class, 'selectPayment'])->name('user.select_order_payment');
            // Route::put('{id}/checkout', [OrderController::class, 'checkout'])->name('user.checkout_order');
            Route::put('{id}/checkout', [OrderController::class, 'midtransCheckoutProcess'])->name('user.pay_order');
        });
        Route::prefix('certificates')->group(function () {
            Route::get('/', [CertificateController::class, 'index'])->name('user.certificate_index');
            Route::get('{id}', [CertificateController::class, 'show'])->name('user.preview_certificate');
            Route::get('{id}/download', [CertificateController::class, 'show'])->name('user.download_certificate');
        });

        Route::prefix('keranjang')->group(function () {
            Route::get('/', [CartController::class, 'index'])->name('user.cart_index');
            Route::delete('/{id}/hapus', [CartController::class, 'destroy'])->name('user.remove_from_cart');
            Route::get('beli', [CartController::class, 'buy'])->name('user.buy_cart');
            Route::post('beli', [UserOrderController::class, 'createOrder'])->name('user.store_order');
        });
    });
    Route::get('profile', [ProfileController::class, 'show'])->name('user.profile');
    Route::put('profile/update/{id}', [ProfileController::class, 'update'])->name('user.update_profile');
    Route::get('images', [FileController::class, 'trainingBanner'])->name('user.images');
    Route::get('get-staff-by-name', [StaffController::class, 'staffByName'])->name('user.get_staff_by_name');

    Route::group(['prefix' => 'pengurus'], function () {
        Route::get('/', [OrganizationController::class, 'show'])->name('user.organization');
        Route::put('{id}', [OrganizationController::class, 'update'])->name('user.update_organization');
    });

    Route::group(['prefix' => 'staf-pengajar'], function () {
        Route::get('/', [StaffController::class, 'index'])->name('user.staff');
        Route::get('create', [StaffController::class, 'create'])->name('user.create_staff');
        Route::post('create', [StaffController::class, 'store'])->name('user.store_staff');
        Route::get('{id}', [StaffController::class, 'edit'])->name('user.staff_edit');
        Route::put('{id}', [StaffController::class, 'update'])->name('user.update_staff');
        Route::delete('{id}', [StaffController::class, 'destroy'])->name('user.delete_staff');
    });

    Route::group(['prefix' => 'santri'], function () {
        Route::get('/', [StudentController::class, 'index'])->name('user.students');
        Route::get('student_by_name', [StudentController::class, 'studentByName'])->name('user.student_by_name');
        Route::get('create', [StudentController::class, 'create'])->name('user.create_student');
        Route::post('create', [StudentController::class, 'store'])->name('user.store_student');
        Route::get('{id}', [StudentController::class, 'edit'])->name('user.edit_student');
        Route::put('{id}', [StudentController::class, 'update'])->name('user.update_student');
        Route::delete('{id}', [StudentController::class, 'destroy'])->name('user.delete_student');
    });

    Route::prefix('surat-pemberitahuan')->group(function () {
        Route::get('/', [UserLetterController::class, 'index'])->name('user.letter_index');
        Route::get('/{id}', [UserLetterController::class, 'show'])->name('user.letter_detail');
    });

    Route::get('piagam', [HomeController::class, 'charter'])->name('user.charter');
});

// Admin Routes

Route::prefix('admin')->group(function () {

    Route::get('email_test', function () {
        // return new App\Mail\Admin\NewTransaction(1);
        return new App\Mail\Admin\NewUserRegistration(1);
    });

    Route::post('/home/profile/about/img', function () {
        return json_encode(['location' => '/storage/app/public/pictures/bestAvatar.png']);
    });

    Route::get('login', [AuthController::class, 'form'])->name('admin.login_form');
    Route::post('login', [AuthController::class, 'authenticate'])->name('admin.login_attempt');

    Route::middleware('role.admin')->group(function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('agreement')->group(function () {
            Route::get('create', [AgreementController::class, 'create'])->name('admin.create_agreement');
            Route::get('/', [AgreementController::class, 'index'])->name('admin.agreement_index');
            Route::get('/{id}', [AgreementController::class, 'edit'])->name('admin.edit_agreement');
            Route::post('create', [AgreementController::class, 'store'])->name('admin.store_new_agreement');
            Route::put('update/{id}', [AgreementController::class, 'update'])->name('admin.update_agreement');
        });

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.user_index');
            Route::get('create', [UserController::class, 'create'])->name('admin.create_new_user');
            Route::post('create', [UserController::class, 'store'])->name('admin.store_new_user');
            Route::get('{id}', [UserController::class, 'show'])->name('admin.detail_user');
            Route::get('{id}/banned', [UserController::class, 'banned'])->name('admin.banned_user');
            Route::get('{id}/unbannd', [UserController::class, 'unbanned'])->name('admin.unbanned_user');
            Route::put('{id}/update', [UserController::class, 'update'])->name('admin.update_user');
            Route::get('verify/{id}', [UserController::class, 'userRegistrationDetail'])->name('admin.verify_user');
            Route::get('verify/{id}/accept', [UserController::class, 'verifyUser'])->name('admin.accept_user_registration');
            Route::get('verify/{id}/deny', [UserController::class, 'denyRegistration'])->name('admin.deny_user_registration');
        });

        Route::get('file-sk', [FileController::class, 'trainingBanner'])->name('admin.user_file_sk');

        Route::prefix('events')->group(function () {
            Route::get('/', [TrainingController::class, 'index'])->name('admin.training_index');
            Route::get('participants', [TrainingController::class, 'participants'])->name('admin.training_participants');
            Route::get('create', [TrainingController::class, 'create'])->name('admin.create_new_training');
            Route::post('create', [TrainingController::class, 'store'])->name('admin.store_new_training');
            Route::get('{id}', [TrainingController::class, 'edit'])->name('admin.edit_training');
            Route::put('{id}', [TrainingController::class, 'update'])->name('admin.update_training');
            Route::delete('{id}', [TrainingController::class, 'destroy'])->name('admin.delete_training');
        });

        Route::prefix('trainers')->group(function () {
            Route::get('/', [TrainerController::class, 'index'])->name('admin.trainer_index');
            Route::get('trainerByName', [TrainerController::class, 'trainerByName'])->name('admin.get_trainer_by_name');
            Route::get('create', [TrainerController::class, 'create'])->name('admin.create_new_trainer');
            Route::post('create', [TrainerController::class, 'store'])->name('admin.store_new_trainer');
        });

        Route::prefix('categories')->group(function () {
            Route::get('categoryByName', [CategoryController::class, 'categoryByName'])->name('admin.get_category_by_name');
            Route::get('create', [CategoryController::class, 'create'])->name('admin.create_new_category');
            Route::post('create', [CategoryController::class, 'store'])->name('admin.store_new_category');
        });

        Route::prefix('transactions')->group(function () {
            Route::get('/', [AdminOrderController::class, 'index'])->name('admin.order_index');
            Route::get('{id}', [AdminOrderController::class, 'show'])->name('admin.detail_order');
            Route::get('{id}/confirm', [AdminOrderController::class, 'confirmPayment'])->name('admin.finish_order');
            Route::delete('{id}/delete', [AdminOrderController::class, 'destroy'])->name('admin.delete_order');
        });

        Route::prefix('cerificates')->group(function () {
            Route::get('/', [AdminCertificateController::class, 'index'])->name('admin.certificate_index');
            Route::get('settings', [AdminCertificateController::class, 'settingIndex'])->name('admin.certificate_setting_index');
            Route::get('settings/{id}', [AdminCertificateController::class, 'settingDetail'])->name('admin.certificate_setting_detail');
            Route::post('settings/{id}/preview', [AdminCertificateController::class, 'preview'])->name('admin.certificate_setting_preview');
        });

        Route::prefix('cart')->group(function () {
            Route::get('/', [AdminCartController::class, 'index'])->name('admin.cart_index');
        });

        Route::prefix('surat')->group(function () {
            Route::get('/', [LetterController::class, 'index'])->name('admin.letter_index');
            Route::get('/create', [LetterController::class, 'create'])->name('admin.create_letter');
            Route::post('/create', [LetterController::class, 'store'])->name('admin.store_letter');
            Route::get('/{id}', [LetterController::class, 'show'])->name('admin.detail_letter');
            Route::put('/{id}/update', [LetterController::class, 'update'])->name('admin.update_letter');
            Route::delete('/{id}', [LetterController::class, 'destroy'])->name('admin.delete_letter');
        });

        Route::prefix('santri')->group(function () {
            Route::get('/', [AdminStudentController::class, 'index'])->name('admin.student_index');
            Route::get('/{id}', [AdminStudentController::class, 'show'])->name('admin.detail_student');
        });
    });
});
