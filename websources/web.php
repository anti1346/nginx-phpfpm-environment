// www/routes/web.php
use Illuminate\Support\Facades\Redis;

Route::get('/redis-test', function () {
    // 1. 데이터 저장
    Redis::set('system_check', 'Redis is working at ' . now());

    // 2. 데이터 조회
    $value = Redis::get('system_check');

    return response()->json([
        'message' => 'Connection Successful',
        'data' => $value,
        'host' => config('database.redis.default.host')
    ]);
});