<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Livewire\Component;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Component::macro('notify', function ($title, $message, $result = 'success') {
            $this->dispatchBrowserEvent('notify', ['title' => $title, 'message' => $message, 'result' => $result]);
//            $this->dispatchBrowserEvent('notify', ['title' => $title, 'message' > $message]);
        });

        Builder::macro('search', function ($field, $string) {
            return $string ? $this->where($field, 'like', '%'.$string.'%') : $this;
        });

        Builder::macro('toCsv', function () {
            $results = $this->get();

            if ($results->count() < 1) {
                return;
            }

            $titles = implode(',', array_keys((array) $results->first()->getAttributes()));

            $values = $results->map(function ($result) {
                return implode(',', collect($result->getAttributes())->map(function ($thing) {
                    return '"'.$thing.'"';
                })->toArray());
            });

            $values->prepend($titles);

            return $values->implode("\n");
        });

        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
    }
}
