<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    public function boot() {
        view()->composer(
            'layouts.master', 'App\Http\Composers\Layouts\MasterComposer'
        );
    }

    public function register() {
        //
    }

}
