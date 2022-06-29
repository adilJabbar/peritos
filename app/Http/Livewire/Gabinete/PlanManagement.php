<?php

namespace App\Http\Livewire\Gabinete;

use App\Models\Admin\Currency;
use App\Models\Sales\Package;
use App\Models\TransactionAttempt;
use Carbon\Carbon;
use Livewire\Component;

class PlanManagement extends Component
{
    public \App\Models\Gabinete $gabinete;

    public $packages;

    public $money_format;

    public $is_monthly = 1;

    public $user;

    public $currntSubscription;

    public $uses;

    public Package $package;

//    public function mount($gabinete)
//    {
//        $this->gabinete = $gabinete;
//    }

    public function mount(\App\Models\Gabinete $gabinete)
    {
        $this->gabinete = $gabinete;

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET_KEY')
        );
        $this->user = $user = request()->user();
//        $gabinete->load(['users' => function ($q) use ($user) {
//            $q->where('user_id', $user->id)->whereHas('roles', function ($q) use ($user) {
//                $q->where('name', "Administrative");
//            });
//        }]);

        $this->currntSubscription = $gabinete->currentSubscription();
//        dd($this->gabinete->users);
//        if ($gabinete->users->count() <= 0) {
//            return redirect(route('gabinete.contact.index'));
//        }

//        if (!$this->currntSubscription) {
//            $this->createFreeSubscription();
//        }

        if ($this->currntSubscription) {
            $this->currntSubscription->load('transaction');
            if ($this->currntSubscription->contract_length == 'yearly') {
                $this->is_monthly = 0;
            } else {
                $this->is_monthly = 1;
            }
            $subscription_id = $this->currntSubscription->subscription_id;

            $currentPlan = $this->currntSubscription->plan;
            $subscriptions = $stripe->subscriptions->retrieve(
                $subscription_id,
                []
            );
            $Uitems = [];
            $ntimeperiod = $this->currntSubscription->contract_length == 'monthly' ? ' Monthly' : ' Yearly';
            foreach ($subscriptions->items->data as $data) {
                if ($data->price->lookup_key == $currentPlan->name.' User'.$ntimeperiod) {
                    $Uitems['user'] = ['use' => getUsagesRecode($data->id), 'price' => $currentPlan->usd_user, 'free' => $currentPlan->users];
                } elseif ($data->price->lookup_key == $currentPlan->name.' Expedient'.$ntimeperiod) {
                    $Uitems['expedient'] = ['use' => getUsagesRecode($data->id), 'price' => $currentPlan->usd_expedient, 'free' => $currentPlan->expedients];
                }
            }
            $this->uses = $Uitems;
        }
    }

    public function createFreeSubscription()
    {
        $this->selectPlan(Package::where('name', 'Free')->first());
    }

    public function changePlan($disable = null)
    {
        if ($disable) {
            $this->notify(__('Error'), __('Do not change downgrade plan'), 'error');
        } else {
            $this->is_monthly = $this->is_monthly ? 0 : 1;
        }
    }

    public function selectPlan(Package $plan)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET_KEY')
        );
//        dd($plan->toArray());
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $user = auth()->user();
        $temp = time();
        $prices = $stripe->prices->all(['product' => $plan->stripe_id]);

        $priceId = $userPriceId = $expedientPriceId = '';
        $amount = 0;
        $days = 0;
        $timeperiod = $this->is_monthly == 1 ? ' Monthly' : ' Yearly';

        foreach ($prices as $price) {
            if ($price->lookup_key == $plan->name.$timeperiod) {
                $priceId = $price->id;
            } elseif ($price->lookup_key == $plan->name.' User'.$timeperiod) {
                $userPriceId = $price->id;
            } elseif ($price->lookup_key == $plan->name.' Expedient'.$timeperiod) {
                $expedientPriceId = $price->id;
            }
        }

        if (empty($priceId) || empty($userPriceId) || empty($expedientPriceId)) {
            $this->notify(__('Error'), __('invalid plan error'), 'error');
        }
        $cuts = $stripe->customers->all(['email' => $user->email]);
        if (count($cuts) == 0) {
            $customer = $stripe->customers->create([
                'email' => $user->email,
            ]);
        } else {
            $customer = $cuts->first();
        }
        $time = Carbon::now();
        $length = $this->is_monthly ? 'monthly' : 'yearly';
        if ($this->currntSubscription) {
            $subscription_id = $this->currntSubscription->subscription_id;

            $currentPlan = $this->currntSubscription->plan;
            $subscriptions = $stripe->subscriptions->retrieve(
                $subscription_id,
                []
            );
            $Uitems = [];
            $ntimeperiod = $this->currntSubscription->contract_length == 'monthly' ? ' Monthly' : ' Yearly';
            foreach ($subscriptions->items->data as $data) {
                if ($data->price->lookup_key == $currentPlan->name.$ntimeperiod) {
                    $Uitems[] = ['id' => $data->id, 'price' => $priceId];
                } elseif ($data->price->lookup_key == $currentPlan->name.' User'.$ntimeperiod) {
                    $Uitems[] = ['id' => $data->id, 'price' => $userPriceId];
                } elseif ($data->price->lookup_key == $currentPlan->name.' Expedient'.$ntimeperiod) {
                    $Uitems[] = ['id' => $data->id, 'price' => $expedientPriceId];
                }
            }
            $subscriptionsNew = $stripe->subscriptions->update(
                $subscription_id, [
                    'items' => $Uitems,
                ]
            );
            $time1 = Carbon::parse($subscriptionsNew->current_period_start);
            $endtime = Carbon::parse($subscriptionsNew->current_period_end);
            $this->currntSubscription->update([
                'purchase_time' => $time,
                'contract_length' => $length,
                'renewal_time' => $time1,
                'expiration_time' => $endtime,
                'package_id' => $plan->id,
                'expedients' => $plan->expedients,
                'users' => $plan->users,
                'video_minutes' => $plan->video_minutes,
                'usd_renewal' => $this->is_monthly ? $plan->usd_month : $plan->usd_year,
                'usd_expedient' => $plan->usd_expedient,
                'usd_user' => $plan->usd_user,
            ]);
            $this->notify(__('Success'), __('Your subscription upgrade successfully.'), 'Success');
        } else {
            $transactionAttempt = [
                'gabinete_id' => $this->gabinete->id,
                'purchase_time' => $time,
                'user_id' => $user->id,
                'session_id' => $temp,
                'package_id' => $plan->id,
                'renewal_time' => $length,
                'usd_renewal' => $this->is_monthly ? $plan->usd_month : $plan->usd_year,
                'package_amount' => $this->is_monthly ? $plan->usd_month : $plan->usd_year,
                'stripe_price_id' => $priceId,
            ];
            $payment = [
                'success_url' => route('payment.transaction.status').'?session_id='.$temp,
                'cancel_url' => route('payment.transaction.status').'?session_id='.$temp,
                'mode' => 'subscription',  //subscription
                'customer' => $customer->id,
                'line_items' => [[
                    'price' => $priceId,
                    'quantity' => 1,
                ], [
                    'price' => $userPriceId,
                ], [
                    'price' => $expedientPriceId,
                ],
                ],
            ];

            $session = \Stripe\Checkout\Session::create($payment);
//            dd($session->id);
            $transactionAttempt['stripe_checkout_session_id'] = $session->id;
            $tr = TransactionAttempt::create($transactionAttempt);
            request()->session()->flash('checkoutsession', $session->id);

            return redirect($session->url);
        }
    }

    public function render()
    {
        $this->packages = Package::all();
        $this->money_format = money_format_country(Currency::find(2));

        return view('livewire.gabinete.plan-management');
    }
}
