<?php

namespace App\Http\Livewire\Gabinete;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Gabinete;
use App\Models\User;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;

class RegisterAdmin extends Component
{
    use PasswordValidationRules;

    public $gabinete;

    public User $user;

    public $password = '';

    public $passwordConfirmation = '';

    public $terms;

    public function rules()
    {
        return [
            'user.name' => 'required|min:3',
            'user.last_name' => '',
            'user.email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            //        'password' => $this->passwordRules(),
            'password' => 'required|min:8|same:passwordConfirmation',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ];
    }

    public function mount($token)
    {
        $this->user = User::make(['is_ative' => true]);
        $this->gabinete = Gabinete::where('create_main_user_token', $token)->first();
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        $this->validate(
            $this->rules(),
            [
                'terms.required' => __('Tienes que aceptar los términos'),
                'terms.accepted' => __('Tienes que aceptar los términos'),
            ]
        );

        $this->user->password = Hash::make($this->password);

        $this->user->save();

        $this->user->assignRole('Administrator');

        $this->gabinete->users()->attach($this->user->id, ['favorite' => 1]);
        $this->gabinete->update([
            'create_main_user_token' => null,
            'token_expires' => null,
        ]);

        $this->user->sendEmailVerificationNotification();

        \Auth::loginUsingId($this->user->id);
        redirect('/email/verify');
//        redirect(route(''))
    }

    public function render()
    {
        if ($this->gabinete?->token_expires > now()) {
            return view('livewire.gabinete.register-admin')
                ->layout('layouts.auth');
        } else {
            return view('errors.token_expired')
                ->layout('layouts.auth');
        }
    }
}
