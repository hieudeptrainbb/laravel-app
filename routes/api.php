    <?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\TuController;
    use App\Http\Controllers\PhanloaiNganController;
    use App\Http\Controllers\ThemNganController;
    use App\Http\Controllers\ThueTuController;


    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    //Quan ly Phan Loai Tu (Tu controller)

    Route::post('/add-tu', [TuController::class, 'storeAPI']);
    Route::put('/add-tu/{phanLoai}', [TuController::class, 'updateAPI']);
    Route::delete('/add-tu/{phanLoai}', [TuController::class, 'destroyAPI']);

    //Quan ly Phan Loai Ngan (PhanLoaiNgan controller)

    Route::post('/phan-loai-ngan', [PhanloaiNganController::class, 'storeAPI']);
    Route::put('/phan-loai-ngan/{id}', [PhanloaiNganController::class, 'updateAPI']);
    Route::delete('/phan-loai-ngan/{id}', [PhanloaiNganController::class, 'destroyAPI']);

    //Quan ly  Ngan (Ngan controller)

    Route::post('/them-ngan', [ThemNganController::class, 'storeAPI']);
    Route::put('/them-ngan/{id}', [ThemNganController::class, 'updateAPI']);
    Route::delete('/them-ngan/{id}', [ThemNganController::class, 'destroyAPI']);

    //Thue Tu (ThueTu controller)

    Route::post('/thue-tu', [ThueTuController::class, 'storeAPI']);
    Route::put('/thue-tu/{id}', [ThueTuController::class, 'tratuAPI']);
