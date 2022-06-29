<?php

namespace App\Http\Livewire\Payment\Transaction;

use App\Models\Admin\Currency;
use App\Models\Sales\Contract;
use App\Models\Sales\Sale;
use App\Models\TransactionAttempt;
use Carbon\Carbon;
use Livewire\Component;

class Status extends Component
{
    public $transaction;

    public $payment;

    public $money_format;

    public function render()
    {
        $this->money_format = money_format_country(Currency::find(2));
        $user = auth()->user();

        $this->transaction = $details = TransactionAttempt::where('session_id', request()->get('session_id'))->first();
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET_KEY')
        );
        if (! $details) {
            return redirect(route('gabinetes.index'));
        }
        $checkoutid = request()->session()->get('checkoutsession', $details->stripe_checkout_session_id);
        $tra = $stripe->checkout->sessions->retrieve(
            $checkoutid,
            []
        );
        if ($tra->subscription) {
            $sub = $stripe->subscriptions->retrieve(
                $tra->subscription,
                []
            );
        }

        $details->load('plan', 'currentPlan');

        if ($details->updated) {
            $this->payment = Contract::find($details->contract_id);
        } elseif ($tra->status == 'complete' && $tra->payment_status == 'paid') {
            $time = Carbon::parse($sub->current_period_start);
            $endtime = Carbon::parse($sub->current_period_end);
            $expedients = $details->plan->expedients;
            $video_minutes = $details->plan->video_minutes;

            if ($details->renewal_time == 'yearly') {
                $expedients *= 12;
                $video_minutes *= 12;
            }
            $contract = [
                'gabinete_id' => (int) $details->gabinete_id,
                'purchase_time' => $time,
                'user_id' => $user->id,
                'auto_renewal' => true,
                'renewal_time' => $time,
                'contract_length' => $details->renewal_time,
                'expiration_time' => $endtime,
                'package_id' => $details->package_id,
                'expedients' => $expedients,
                'users' => $details->plan->users,
                'video_minutes' => $video_minutes,
                'total_users' => 0,
                'usd_renewal' => $details->usd_renewal,
                'usd_expedient' => $details->plan->usd_expedient,
                'usd_user' => $details->plan->usd_user,
                'subscription_id' => $tra->subscription,
            ];
            $this->payment = Contract::create($contract);
            $sales = [
                'contract_id' => $this->payment->id,
                'date' => $time,
                'payment_id' => $sub->latest_invoice,
                'taxes' => $tra->total_details->amount_tax / 100,
                'paid_amount' => $tra->amount_total / 100,
                'currency' => $tra->currency,
            ];
            $sales = Sale::create($sales);
            $details->updated = 1;
            $details->contract_id = $this->payment->id;
            $details->save();
        } else {
            if ($tra->status != 'expired') {
                $stripe->checkout->sessions->expire($checkoutid, []);
            }
        }

        return view('livewire.payment.transaction.status');
    }
}
