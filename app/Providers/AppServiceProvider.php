<?php

namespace App\Providers;

use App\Models\Term;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        view()->composer('*', function ($view) {
            $current_term = \Session::get('current_term') ?? (!is_null(Term::orderBy('number', 'desc')->first()) ? Term::orderBy('number', 'desc')->first()->number : null);
            $current_term_id = \Session::get('current_term_id') ?? (!is_null(Term::orderBy('number', 'desc')->first()) ? Term::orderBy('number', 'desc')->first()->id : null);
            $view->with('current_term', $current_term);

            request()->session()->put('current_term', $current_term);
            request()->session()->put('current_term_id', $current_term_id);
        });
    }
}