<?php

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

Route::get('/', 'PageController@index')->name('index');
Route::get('/success', 'PageController@success')->name('success');
Route::get('/success/{url?}', 'PageController@successAndRedirect')->name('successAndRedirect')->where('url', '(.*)');

Auth::routes();

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/register', 'UserController@showAdminRegisterForm')->name('register.form');
    Route::get('/changePassword', 'UserController@showPasswordChangeForm')->name('password.form');
    Route::post('/register', 'UserController@submitAdminRegisterForm')->name('register.submit');
    Route::post('/changePassword', 'UserController@submitPasswordChangeForm')->name('password.submit');
});

Route::group(['prefix' => 'dailyBook', 'as' => 'dailyBook.'], function () {

    Route::get('/class', 'PageController@selectClassDailyBook')->name('class');

    Route::group(['prefix' => '{daily_book_id}'], function () {
        Route::group(['prefix' => 'comments', 'as' => 'comments.'], function () {
            Route::get('/show', 'PageController@showComments')->name('show');
            Route::get('/send', 'PageController@sendComments')->name('send');
            Route::post('/add', 'DailyBooksController@addComments')->name('add');
        });
    });

    Route::group(['prefix' => 'DayCare', 'as' => 'dc.'], function () {
        Route::get('/students', 'PageController@dayCareStudents')->name('student');
        Route::group(['prefix' => '{student_id}'], function () {
            Route::get('/form', 'PageController@formDailyBookDayCare')->name('form');
            Route::get('/month', 'PageController@dayCareSelectMonth')->name('month');
            Route::get('/date/{month}/{year}', 'PageController@dayCareSelectDate')->name('date');
            Route::get('/date/parent', 'PageController@dayCareSelectDateParent')->name('date.parent');
            Route::get('/review/{day}/{month}/{year}', 'PageController@reviewDailyBookDayCare')->name('review');
            Route::get('/show/{day}/{month}/{year}', 'PageController@showDailyBookDayCare')->name('show');
            // Route::get('/read/{dailyBook}', 'DailyBooksController@isReadDailyBook')->name('read');
            Route::post('/add', 'DailyBooksController@addDailyBooksDayCare')->name('add');
            Route::post('/publish/{dailyBook}', 'DailyBooksController@publishDailyBookDayCare')->name('publish');
        });
    });

    Route::group(['prefix' => 'KelompokBermain', 'as' => 'kb.'], function () {
        Route::get('/students', 'PageController@kelompokBermainStudents')->name('student');
        Route::group(['prefix' => '{student_id}'], function () {
            Route::get('/form', 'PageController@formDailyBookKelompokBermain')->name('form');
            Route::get('/month', 'PageController@kelompokBermainSelectMonth')->name('month');
            Route::get('/date/{month}/{year}', 'PageController@kelompokBermainSelectDate')->name('date');
            Route::get('/date/parent', 'PageController@kelompokBermainSelectDateParent')->name('date.parent');
            Route::get('/review/{day}/{month}/{year}', 'PageController@reviewDailyBookKelompokBermain')->name('review');
            Route::get('/show/{day}/{month}/{year}', 'PageController@showDailyBookKelompokBermain')->name('show');
            // Route::get('/read/{dailyBook}', 'DailyBooksController@isReadDailyBook')->name('read');
            Route::post('/add', 'DailyBooksController@addDailyBooksKelompokBermain')->name('add');
            Route::post('/publish/{dailyBook}', 'DailyBooksController@publishDailyBookKelompokBermain')->name('publish');
        });
    });
});

Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
    Route::get('/typeclass', 'PageController@selectClassProfile')->name('typeclass');
    Route::get('/DayCare/students/', 'PageController@studentsProfileDayCare')->name('dc.student');
    Route::get('/KelompokBermain/students', 'PageController@studentsProfileKelompokBermain')->name('kb.student');
    Route::group(['prefix' => 'schedule', 'as' => 'schedule.'], function () {
        Route::get('/{kelas}/form', 'PageController@scheduleForm')->name('form');
        Route::get('/{kelas}/list', 'PageController@scheduleList')->name('list');
        Route::post('/add', 'JadwalController@addSchedule')->name('add');
        Route::post('/edit/{id}', 'JadwalController@editSchedule')->name('edit');
        Route::delete('/delete/{id}', 'JadwalController@deleteSchedule')->name('delete');
    });
    Route::group(['prefix' => 'pengumuman', 'as' => 'pengumuman.'], function () {
        Route::get('/{kelas}/form/add', 'PageController@addPengumuman')->name('form.add');
        Route::get('/{kelas}/form/edit/{id}', 'PageController@editPengumuman')->name('form.edit');
        Route::get('/{kelas}/list', 'PageController@pengumumanList')->name('list');
        Route::get('/{kelas}/show/{id}', 'PageController@seePengumuman')->name('show');
    });
    Route::group(['prefix' => 'edit/{student_id}', 'as' => 'edit.'], function () {
        Route::get('/details', 'PageController@profileDetails')->name('details');
        Route::get('/student', 'StudentController@editStudentProfileForm')->name('student.form');
        Route::get('/father', 'StudentController@editFatherProfileForm')->name('father.form');
        Route::get('/mother', 'StudentController@editMotherProfileForm')->name('mother.form');
        Route::post('/student', 'StudentController@editStudentProfile')->name('student.post');
        Route::post('/father', 'StudentController@editFatherProfile')->name('father.post');
        Route::post('/mother', 'StudentController@editMotherProfile')->name('mother.post');
        Route::post('/graduate', 'StudentController@graduateStudent')->name('graduate');
        Route::post('/photo', 'StudentController@editPhotoProfileStudent')->name('photoProfile');
        Route::post('/ungraduate', 'StudentController@cancelGraduateStudent')->name('ungraduate');
    });
    Route::group(['prefix' => 'tagihan/{kelas}', 'as' => 'tagihan.'], function () {
        Route::get('/lists', 'PageController@tagihanLists')->name('list');
        Route::get('/kwitansi/{student_id}/{tagihan_id}', 'PageController@showKwitansi')->name('kwitansi');
        Route::get('/form/add/{student_id}', 'PageController@tagihanAdd')->name('form.add');
        Route::get('/form/edit/{student_id}/{tagihan_id}', 'PageController@tagihanEdit')->name('form.edit');
        Route::post('/add/{student_id}', 'PembayaranController@addTagihan')->name('add');
        Route::post('/edit/{student_id}/{tagihan_id}', 'PembayaranController@editTagihanAdmin')->name('edit');
        Route::post('/uploadBukti/{student_id}/{tagihan_id}', 'PembayaranController@editTagihan')->name('upload');
        Route::post('/lunaskan/{student_id}/{tagihan_id}', 'PembayaranController@lunaskan')->name('lunaskan');
        Route::post('/cancelLunaskan/{student_id}/{tagihan_id}', 'PembayaranController@cancelLunaskan')->name('cancelLunaskan');
        Route::delete('/delete/{student_id}/{tagihan_id}', 'PembayaranController@deleteTagihan')->name('delete');
    });
});

Route::group(['prefix' => 'dailyBook', 'as' => 'dailyBook.'], function () {
    Route::get('/students/{class}', 'PageController@studentsList')->name('student');
    Route::group(['prefix' => '{daily_book_id}'], function () {
        Route::group(['prefix' => 'comments', 'as' => 'comments.'], function () {
            Route::get('/show', 'PageController@showComments')->name('show');
            Route::get('/send', 'PageController@sendComments')->name('send');
            Route::post('/add', 'DailyBooksController@addComments')->name('add');
        });
    });
    Route::group(['prefix' => '{student_id}'], function () {
        Route::get('/form', 'PageController@formDailyBook')->name('form');
        Route::get('/date/{month}/{year}', 'PageController@selectDate')->name('date');
        Route::get('/month', 'PageController@selectMonth')->name('month');
        Route::post('/add', 'DailyBooksController@addDailyBooks')->name('add');
    });
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@administratorHome')->name('home');
    Route::group(['prefix' => 'schedule', 'as' => 'schedule.'], function () {
        Route::post('/add', 'JadwalController@addSchedule')->name('add');
        Route::post('/edit/{id}', 'JadwalController@editSchedule')->name('edit');
        Route::delete('/delete/{id}', 'JadwalController@deleteSchedule')->name('delete');
    });
    Route::resource('berita', 'BeritaController');
    Route::resource('pengumuman', 'PengumumanController');
    Route::post('gantiTandaTangan', 'PembayaranController@gantiTandaTangan')->name('ganti.ttd');
});

Route::get('/notification', 'PageController@showAllNotifications')->name('notification');
Route::get('/notification/{id}', 'NotificationController@redirectToNotificationUrl')->name('notification.read');

Route::group(['prefix' => 'orangtua', 'as' => 'orangtua.'], function () {
    Route::get('/home', 'HomeController@parentHome')->name('home');
});

Route::group(['prefix' => 'guru', 'as' => 'guru.'], function () {
    Route::get('/home', 'HomeController@teacherHome')->name('home');
});

Route::group(['prefix' => 'fasilitator', 'as' => 'fasilitator.'], function () {
    Route::get('/home', 'HomeController@fasilitatorHome')->name('home');
});

Route::group(['prefix' => 'co-fasilitator', 'as' => 'cofasilitator.'], function () {
    Route::get('/home', 'HomeController@cofasilitatorHome')->name('home');
});
