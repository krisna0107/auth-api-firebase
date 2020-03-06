# Auth API Firebase for Laravel
## Instalisasi

Paket ini berfungsi untuk Laravel 5.8 keatas
```bash
composer require krisna0107/auth-api-firebase
```

## Konfigurasi

Publish paket dengan perintah
```bash
php artisan vendor:publish --provider="krisna0107\AuthAPIFirebase\FirebaseAuthProvider" --tag=config
```
Selanjutnya buka file .env dan tambahkan konfigurasi project id nya
```bash
FIREBASE_PROJECT_ID=NAMA_PROJECT_ID_MU 
```
Terakhir Buka file App/Http/Kernel.php dan tambahkan kode pada $routeMiddleware dibawah ini
```php
'authfirebase' => \krisna0107\\AuthAPIFirebase\AuthFirebase::class,
```
Contoh :
```php
protected $routeMiddleware = [
    ...
    'authfirebase' => \krisna0107\\AuthAPIFirebase\AuthFirebase::class,
];
```

## Pemakaian
Buke file routes/api.php lalu buat middlewareGroup untuk membungkus API dengan Auth firebase
```php
Route::group(['prefix' => 'v1', 'middleware' => 'authfirebase'], function(){ // v1 ini routeGroup untuk membungkus Api dengan Auth firebase
    Route::group(['prefix' => 'makanans'], function () {
        Route::get('/me', function () {
            return 'Hello ini route makanan';
        });
    });

    Route::group(['prefix' => 'minumans'], function(){
        Route::get('foo', function () {
            return 'Hello ini route minuman';
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
