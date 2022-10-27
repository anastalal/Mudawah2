<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\facilityController;
use App\Http\Controllers\LikeControler;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RateController;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SpecializitionController as ControllersSpecializitionController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\UserControler;
use App\Http\Controllers\voyager\SpecializitionController;
use App\Http\Controllers\WorkdayPeriodController;
use App\Models\Appointment;
use App\Models\AppointmentState;
use App\Models\Facility;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//user related
Route::group(array('prefix'=>'users','namespace'=>'App\Http\Controllers\Api'),function(){
    Route::get('/','UsersController@index');
    Route::get('/{id}','UsersController@show');
    Route::get('/role/{id}','UsersController@usersByRole');
    Route::post('/user-add','UsersController@store');
    Route::post('/user-update/{id}','UsersController@update');
    Route::delete('/user-delete/{id}','UsersController@destroy');
});
//auth related
Route::post('/register', 'App\Http\Controllers\Api\AuthController@register'); 
Route::post('/login','App\Http\Controllers\Api\AuthController@login');

//role related
Route::get('/roles', 'App\Http\Controllers\RolesController@index'); 





//Route::get('/posts/user/{id}','App\Http\Controllers\Api\UsersController@posts');
//Route::get('/comments/author/{id}','App\Http\Controllers\Api\UsersController@comments'); 

//post related
Route::group(array('prefix'=>'posts','namespace'=>'App\Http\Controllers\Api'),function(){
    Route::get('/','PostsController@index');
    Route::get('/{id}','PostsController@show');
    Route::get('/user/{id}','UsersController@posts');
    Route::get('/posts/user/{id}','UsersController@posts');
    Route::get('category/{id}', 'PostsController@postsByCategory');
    Route::post('/post-add','PostsController@store');
    Route::post('/post-update/{id}','PostsController@update');


});
//Route::get('/post/{id}','App\Http\Controllers\Api\PostsController@show');
Route::get('/comments/post/{id}','App\Http\Controllers\Api\PostsController@comments');
Route::get('/post-comments/{id}','App\Http\Controllers\Api\PostsController@postWithComments');
Route::get('/post-author-comments/{id}','App\Http\Controllers\Api\PostsController@postWithAuthorWithComments');
Route::delete('/post-delete/{id}','App\Http\Controllers\Api\PostsController@destroy');
 

// comment related
Route::group(array('prefix'=>'comments','namespace'=>'App\Http\Controllers\Api'),function(){
    Route::get('/','CommentsController@index');
    Route::get('/{id}','CommentsController@show');
    Route::post('/comment-add','CommentsController@store');
    Route::post('/comment-update/{id}','CommentsController@update');
    Route::delete('/comment-delete/{id}','CommentsController@destroy');
   

});

//category related
//Route::get('/categories', 'App\Http\Controllers\Api\CategoriesController@index');
Route::get('/category/{id}', 'App\Http\Controllers\Api\CategoriesController@show');
//Route::get('posts/category/{id}', 'App\Http\Controllers\Api\CategoriesController@posts');
//Route::post('store','App\Http\Controllers\Api\CategoriesController@store');
Route::post('update/category/{id}','App\Http\Controllers\Api\CategoriesController@update');
Route::delete('delete/category/{id}','App\Http\Controllers\Api\CategoriesController@destroy');
Route::get('category-with-posts/{id}','App\Http\Controllers\Api\CategoriesController@caetgoryWithPosts');

Route::group(array('prefix' =>'categories', 'namespace'=>'App\Http\Controllers\Api'), function(){
    Route::get('/','CategoriesController@index');
    Route::get('/{id}','CategoriesController@show');
    Route::post('/category-add','CategoriesController@store');
    Route::post('/category-update/{id}','CategoriesController@update');
    Route::delete('/category-delete/{id}','CategoriesController@destroy');

});

//device related
Route::get('devices','App\Http\Controllers\Api\deviceController@index');
Route::get('device/{id}','App\Http\Controllers\Api\deviceController@show');

//rules related
Route::get('/roles','App\Http\Controllers\Api\RolesController@index');
Route::post('/role/insert','App\Http\Controllers\Api\RolesController@insert');

//auth related
//Route::post('/register','App\Http\Controllers\Api\AuthController@show');


Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post("/logout",[AuthController::class,'logout']);
});
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    
});
*/


//----------------------------------
//----------------------------------
//----------------------------------

Route::group(array('prefix' => 'usersV2'), function () {
    Route::post('/register', [UserControler::class, 'store']);
    Route::post('/login', [UserControler::class, 'login']);
    Route::get('/get', [UserControler::class, 'index']);
    Route::post('/doctors-filter', [UserControler::class, 'getDocctorsFilter']);
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/update', [UserControler::class, 'update']);
    });
});

Route::group(array('prefix' => 'usersV3'), function () {

    Route::get('/get', [UserControler::class, 'getUsers']);
    Route::get('/get-by-id', [UserControler::class, 'show']);
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/update-password', [UserControler::class, 'changePassword']);
    //    Route::post('/update', [UserControler::class, 'update']);
    });
});

Route::group(array('prefix' => 'phoneV2'), function () {
    Route:: get('/phone', [PhoneController::class, 'index']);
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/phone', [PhoneController::class, 'store']);
        Route::post('/phone-update', [PhoneController::class, 'update']);
    });
});

Route::group(array('prefix' => 'postsV2'), function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/seen', [PostController::class, 'show']);
    Route::get('/posts-by-date', [PostController::class, 'getRecentPosts']);
    Route::post('/posts-by-doctor', [PostController::class, 'getDoctorPosts']);
    Route::middleware(['auth:api'])->group(function () {
        Route::resource('posts', PostController::class);
        Route::resource('likes', LikeControler::class,); 
    });
});

Route::group(array('prefix' => 'facilityV2'), function () {
    Route:: get('/facility-hospitals', [facilityController::class, 'getHospitals']);
    Route:: get('/facility-clinics', [facilityController::class, 'getFacilities']);
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/facility-add', [facilityController::class, 'store']);
        Route::post('/facility-update', [facilityController::class, 'update']);
    });
});
Route::group(array('prefix' => 'locationV2'), function () {
    Route:: get('/directorates-get  ', [LocationController::class, 'index']);
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/country-add', [CountryController::class, 'store']);
        Route::post('/city-add', [CityController::class, 'update']);
    });
});
Route::group(array('prefix' => 'specializitionV2'), function () {
    Route:: get('/', [ControllersSpecializitionController::class, 'index']);
    Route:: get('/facility-clinics', [facilityController::class, 'getFacilities']);
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/pecializition-add', [ControllersSpecializitionController::class, 'store']);
       // Route::post('/facility-update', [facilityController::class, 'update']);
    });
});
Route::group(array('prefix' => 'stateV2'), function () {
    Route:: get('/', [StateController::class, 'index']);
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/state-add', [StateController::class, 'store']);
       // Route::post('/facility-update', [facilityController::class, 'update']);
    });
});
Route::group(array('prefix' => 'appointmentV2'), function () {
    Route:: get('/', [AppointmentController::class, 'index']);
    Route:: post('/appointment-check', [AppointmentController::class, 'checkAppointedPeriods']);
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/appointment-add', [AppointmentController::class, 'store']);
        Route::get('/appointments-by-user', [AppointmentController::class, 'getUserAppointments']);
        Route::get('/appointments-by-doctor', [AppointmentController::class, 'getDoctorAppointments']);
        Route::post('/appointment-state-update', [AppointmentController::class, 'updateAppointmentState']);

       // Route::post('/facility-update', [facilityController::class, 'update']);
    });
});
Route::group(array('prefix' => 'rateV2'), function () {
    Route:: get('/', [RateController::class, 'index']);
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/rate-add', [RateController::class, 'store']);
       // Route::post('/facility-update', [facilityController::class, 'update']);
    });
});

Route::group(array('prefix' => 'periodV2'), function () {
    Route:: get('/', [WorkdayPeriodController::class, 'index']);
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/period-add', [WorkdayPeriodController::class, 'store']);
       // Route::post('/facility-update', [facilityController::class, 'update']);
    });
});
Route::group(array('prefix' => 'categoryV2'), function () {
    Route:: get('/', [CategoryController::class, 'index']);
    Route:: post('/get-posts-by-category', [CategoryController::class, 'getPostsByCategory']);
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/category-add', [CategoryController::class, 'store']);
       // Route::post('/facility-update', [facilityController::class, 'update']);
    });
});
Route::group(array('prefix' => 'clinicV2'), function () {
    Route:: get('/', [ClinicController::class, 'getDoctorClinics']);
    Route::post('/clinics-filter', [ClinicController::class, 'getClinicsFilter']);
    Route:: post('/get-posts-by-category', [CategoryController::class, 'getPostsByCategory']);
    Route:: post('/get-doctor-clinic-workday', [ClinicController::class, 'getDoctorClinicWOrkday']);
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/category-add', [CategoryController::class, 'store']);
       // Route::post('/facility-update', [facilityController::class, 'update']);
    });
});
Route::group(array('prefix' => 'doctorsV2'), function () {
    Route::get('/', [DoctorController::class, 'getAllDoctors']);
    Route::get('/doctors-by-rate', [DoctorController::class, 'getDoctorsByRate']);
    Route::post('/doctors-filter', [DoctorController::class, 'doctorsFilter']);
    Route::middleware(['auth:api'])->group(function () {
       // Route::post('/facility-update', [facilityController::class, 'update']);
    });
});