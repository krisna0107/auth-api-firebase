# Auth API Firebase for Laravel
## Instalisasi

Paket ini berfungsi untuk Laravel 5.8 keatas
```bash
composer require kreait/laravel-firebase
```
Selanjutnya clone repository ini dan Simpan pada folder App/Http/Middleware di laravel mu

## Konfigurasi

Buka AuthFirebase.php pada folder Middleware, dan beri nama project-id mu pada line 44
```php
$verifier = IdTokenVerifier::createWithProjectId("project-id-mu");
```
Selanjutnya Buka file App/Http/Kernel.php dan tambahkan kode pada $routeMiddleware dibawah ini
```php
'authfirebase' => \App\Http\Middleware\AuthFirebase::class,
```
Contoh :
```php
protected $routeMiddleware = [
    ...
    'authfirebase' => \App\Http\Middleware\AuthFirebase::class,
];
```

## Pemakaian
Buke file routes/api.php lalu buat middlewareGroup untuk membungkus API dengan Auth firebase
```php
Route::group(['prefix' => 'v1', 'middleware' => 'authfirebase'], function(){ // v1 ini routeGroup untuk membungkus Auth
    Route::group(['prefix' => 'makanans'], function () {
        Route::get('/me', function () {
            return 'Hello ini route makanan';
        });
    });

    Route::group(['prefix' => 'minumans'], function(){
        Route::get('foo', function () {
            return 'Hello ini route minumans';
        });
    });
});
```
untuk memanggil nya sperti dibawah ini, Contoh :

### localhost/api/v1/makanans/me
or
### localhost/api/v1/minumans/me

Untuk mengakses API gunakan Headers
#### Authorization:Bearer tokenmu

Contoh :
#### Authorization:Bearer eyJhb...
