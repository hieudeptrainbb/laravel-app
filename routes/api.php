    <?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\StudentController;
    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\api\UserController;
    use App\Http\Controllers\CabinetController;
    use App\Http\Controllers\RentalController;
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

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::middleware('auth:api')->get('post', [LoginController::class, 'index']);

    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('details', [UserController::class, 'details']);
    });

//    Route Student Controller
    Route::get('/student', [StudentController::class, 'index']);
    Route::post('/student', [StudentController::class, 'store']);
    Route::get('/student/{id}', [StudentController::class, 'show']);
    Route::put('/student/{id}', [StudentController::class, 'update']);
    Route::delete('/student/{id}', [StudentController::class, 'destroy']);

    // Quan ly tu do
    Route::post('/cabinets', [CabinetController::class, 'store']);
    Route::post('/rentals', [RentalController::class, 'store']);
    Route::get('/rentals', [RentalController::class, 'getItems']);
