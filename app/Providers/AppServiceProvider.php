<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\UpdateBook;
use App\Book;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Request::macro('introduce', function () {
            $nos = UpdateBook::count();
            $nosBook = Book::where('upload', 1)->count();
            //This code show the sum of both ready to upload in sync with remote sql.
            // echo $nos + $nosBook;

            // Here is modified code for CSV notified ifor for books table only
            echo $nosBook;
        });

        View::composer('layouts.admin', function ($view) {
            $nosBook = Book::where('upload', 1)->count();
            $view->with('booksToUpload', $nosBook);
        });

        View::composer('layouts.admin', function ($view) {
            $nos = UpdateBook::all()->count();
            $view->with('numbers', $nos);
        });

        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
