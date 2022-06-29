<?php

namespace App\Http\Livewire\Payment;

use App\Models\Insurance\Company;
use Carbon\Carbon;
use Livewire\Component;

class Gabinete extends Component
{
    public $gabinetes;

    public function render()
    {
        $user = request()->user();
        $gabinete = \App\Models\Gabinete::whereHas('users', function ($q) use ($user) {
            $q->where('user_id', $user->id)->whereHas('roles', function ($q) use ($user) {
                $q->where('name', 'Administrative');
            });
        })->with('subscriptions')->get();
//        dd($gabinete->toarray(),Carbon::now());
        $this->gabinetes = $gabinete;

        return view('livewire.payment.gabinete');
    }
}
