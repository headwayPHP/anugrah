<?php

//use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\ContactRequestController;

//use App\Http\Controllers\Admin\SocialMediaPostController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\ReqRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialMediaPostController;


Route::post('login', [AuthController::class, 'login'])->name('post.login');
Route::get('404', function () {
    return view('frontend.pages.404');
});
Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/page/{id}', [FrontController::class, 'specificPage'])->name('frontend.specific.page');

//Route::get('logout', [AuthController::class, 'logout'])->name('logoutMessage');

Route::middleware(['auth:api'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
});
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [FrontController::class, 'homePage'])->name('front.home');
Route::get('/contact-us', [FrontController::class, 'contactRequestPage'])->name('contactRequestPage');
Route::get('/about-us', [FrontController::class, 'aboutUsPage'])->name('aboutUsPage');
Route::get('/privacy-policy', [FrontController::class, 'privacyPage'])->name('privacyPage');
Route::get('/register', [FrontController::class, 'regRequestPage'])->name('regRequestPage');
Route::post('/saveContactRequest', [FrontController::class, 'saveContactRequest'])->name('saveContactRequest');
Route::post('/saveReqRequest', [FrontController::class, 'saveReqRequest'])->name('saveReqRequest');
Route::get('/gallery', [FrontController::class, 'galleryPage'])->name('galleryPage');
Route::get('/activity-page', [FrontController::class, 'activityPage'])->name('activityPage');
Route::get('/activity-page/{id}', [FrontController::class, 'showActivityDetails'])->name('front.activity.details');
Route::get('courses', [FrontController::class, 'coursePage'])->name('coursePage');
Route::get('courses/{id}', [FrontController::class, 'courseDetailPage'])->name('courseDetailPage');

Route::post('/attendances/calendar-data', [AttendanceController::class, 'calendarData'])->name('attendances.calendarData');


// Route::get('/', [AdminController::class, 'home'])->name('admin.home');
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.home');

    Route::get('contact-requests', [ContactRequestController::class, 'index'])->name('contact-requests.index');
    Route::get('contact-requests/{id}', [ContactRequestController::class, 'show'])->name('contact-requests.show');
    Route::delete('contact-requests/{id}', [ContactRequestController::class, 'destroy'])->name('contact-requests.destroy');
    //    Route::post('contact-requests/{id}/status', [ContactRequestController::class, 'updateStatus'])->name('contact-requests.update-status');

    Route::post('/contact/update-status/{id}', [ContactRequestController::class, 'updateStatus'])->name('contact.updateStatus');


    Route::get('/req-requests', [ReqRequestController::class, 'index'])->name('req_requests.index');
    Route::get('/req-requests/{id}', [ReqRequestController::class, 'show'])->name('req_requests.show');
    Route::post('/req-requests/update-status/{id}', [ReqRequestController::class, 'updateStatus'])->name('req_requests.updateStatus');


    Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');
    Route::get('/photos/{id}', [PhotoController::class, 'show'])->name('photos.show');
    Route::get('/photos/{id}/edit', [PhotoController::class, 'edit'])->name('photos.edit');
    Route::post('/photos/{id}/update', [PhotoController::class, 'update'])->name('photos.update');
    Route::delete('/photos/{id}', [PhotoController::class, 'destroy'])->name('photos.destroy');
    Route::post('/photos/create', [PhotoController::class, 'create'])->name('photos.create');

    // status toggle
    Route::post('/photos/{id}/status-update', [PhotoController::class, 'statusUpdate'])->name('photos.statusUpdate');

    // featured toggle (optional)
    Route::post('/photos/{id}/is-featured-toggle', [PhotoController::class, 'isFeaturedToggle'])->name('photos.isFeaturedToggle');


    // routes/web.php
    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

    // routes/web.php
    Route::get('/settings/create', [SettingsController::class, 'create'])->name('settings.create');
    Route::post('/settings/store', [SettingsController::class, 'store'])->name('settings.store');


    Route::get('social-posts', [SocialMediaPostController::class, 'index'])->name('social-posts.index');
    Route::post('social-posts/store', [SocialMediaPostController::class, 'store'])->name('social-posts.store');
    Route::post('social-posts/{id}/update', [SocialMediaPostController::class, 'update'])->name('social-posts.update');
    Route::post('social-posts/{id}/delete', [SocialMediaPostController::class, 'destroy'])->name('social-posts.destroy');
    Route::post('social-posts/{id}/toggle-status', [SocialMediaPostController::class, 'statusToggle'])->name('social-posts.status');

    Route::get('pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::post('pages', [PageController::class, 'store'])->name('pages.store');
    Route::get('pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('pages/{page}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');
    Route::post('pages/{page}/toggle-status', [PageController::class, 'toggleStatus'])->name('pages.toggle-status');

    Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    Route::post('courses/{course}/toggle-status', [CourseController::class, 'toggleStatus'])->name('courses.toggle-status');


    // Batches Routes
    Route::get('batches', [BatchController::class, 'index'])->name('batches.index');
    Route::post('batches', [BatchController::class, 'store'])->name('batches.store');
    Route::put('batches/{batch}', [BatchController::class, 'update'])->name('batches.update');
    Route::delete('batches/{batch}', [BatchController::class, 'destroy'])->name('batches.destroy');
    Route::post('batches/{batch}/toggle-status', [BatchController::class, 'toggleStatus'])->name('batches.toggle-status');

    // Students Routes
    Route::get('students', [StudentController::class, 'index'])->name('students.index');
    Route::post('students', [StudentController::class, 'store'])->name('students.store');
    Route::put('students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::post('students/{student}/toggle-status', [StudentController::class, 'toggleStatus'])->name('students.toggle-status');
    Route::post('students/{student}/toggle-kit', [StudentController::class, 'toggleKitStatus'])->name('students.toggle-kit');
    Route::get('/admin/get-batches', [BatchController::class, 'getBatchesByCourse'])->name('get.batches');



    Route::get('attendance', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::post('attendance/load-students', [AttendanceController::class, 'loadStudents'])->name('attendances.loadStudents');
    Route::post('attendance/mark', [AttendanceController::class, 'markAttendance'])->name('attendances.mark');
    Route::post('attendance/unmark', [AttendanceController::class, 'unmarkAttendance'])->name('attendances.unmark');


    Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');

    Route::post('activities', [ActivityController::class, 'store'])->name('activities.store');
    Route::put('activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');
    Route::delete('activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');

    // Optional AJAX route for showing a single activity (for view modal)
    Route::get('activities/{activity}', [ActivityController::class, 'show'])->name('activities.show');
    Route::post('/admin/activities/{activity}/toggle-status', [ActivityController::class, 'toggleStatus'])->name('activities.toggleStatus');
    Route::post('/admin/activities/{activity}/toggle-featured', [ActivityController::class, 'toggleFeatured'])->name('activities.toggleFeatured');
});
