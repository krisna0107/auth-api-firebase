<?php

namespace krisna0107\AuthAPIFirebase;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class FirebaseAuthProvider extends BaseServiceProvider {

  /**
  * Perform post-registration booting of services.
  *
  * @return void
  */
  public function boot()
  {
    $this->publishes([
        __DIR__ . '/config.php' => config_path('firebase.php'),
    ]);
  }

  /**
  * Register bindings in the container.
  *
  * @return void
  */
  public function register()
  {
    //
  }

}