<?php

use App\Models\Sales\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'dashboard');
Route::get('/error/forbidden', App\Http\Livewire\Error\Forbidden::class)->name('error.forbidden');
Route::get('/terms-of-service', App\Http\Livewire\Auth\Terms::class)->name('terms.show');
Route::get('/privacy-policy', App\Http\Livewire\Auth\Privacy::class)->name('privacy.show');
Route::get('/registerNewUser/{token}', \App\Http\Livewire\Gabinete\RegisterAdmin::class)->name('register.newUser');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::middleware('can:administration')->group(function () {
        Route::get('/administration/company/{company}', \App\Http\Livewire\Administration\Company\Edit::class)->name('administration.company.show');
        Route::get('/administration/country/ramo/{ramo}', \App\Http\Livewire\Country\Ramo::class)->name('administration.country.ramo.show');
        Route::get('/administration/country/{country}', \App\Http\Livewire\Administration\Country::class)->name('administration.country.show');
        Route::get('/administration/gabinete/{gabinete}', \App\Http\Livewire\Administration\Gabinete\Gabinete::class)->name('administration.gabinete.show');
        Route::get('/administration/user/{user}', \App\Http\Livewire\Administration\User\User::class)->name('administration.user.show');
        Route::get('/administration', \App\Http\Livewire\Administration\Administration::class)->name('administration.index');
    });

    //Calendar
    Route::get('/calendar', \App\Http\Livewire\Calendar::class)->name('calendar.index');

    Route::get('/company/{company}', \App\Http\Livewire\Insurance\Company::class)->name('company.show');
    Route::get('/dashboard', \App\Http\Livewire\Dashboard::class)->name('dashboard.index');
    Route::get('/defaultProduct/{product}', \App\Http\Livewire\Administration\DefaultProduct::class)->name('default_product.show');
    Route::get('/expedient/createCompany', \App\Http\Livewire\Expedient\Create\Company::class)->name('expedient.createCompany');
    Route::get('/expedient/createParticular', \App\Http\Livewire\Expedient\Create\Particular::class)->name('expedient.createParticular');
    Route::get('/expedient/newExpedient/{expedient?}', \App\Http\Livewire\Expedient\NewExpedient::class)->name('expedient.new_expedient');
//    Route::get('/expedient/create', \App\Http\Livewire\Expedient\Create::class)->name('expedient.create');
    Route::get('/expedient/{expedient}', \App\Http\Livewire\Expedient\Edit::class)->name('expedient.edit');
    Route::get('/expedients', \App\Http\Livewire\Expedients::class)->name('expedient.index');
    Route::get('/my_gabinetes/company/{gabinete}/{company}', \App\Http\Livewire\MyGabinetes\Company\Edit::class)->name('my_gabinetes.company.show');
    Route::get('/my_gabinetes/subcontractor/{gabinete}/{subcontractor}', \App\Http\Livewire\MyGabinetes\Subcontractor\Edit::class)->name('my_gabinetes.subcontractor.show');
    Route::get('/my_gabinetes/user/{gabinete}/{user}/{subcontractor?}', \App\Http\Livewire\MyGabinetes\User\Edit::class)->name('my_gabinetes.user.show');
    Route::get('/my_gabinetes', \App\Http\Livewire\MyGabinetes\MyGabinetes::class)->name('my_gabinetes.show');
    Route::get('/gabinetes', \App\Http\Livewire\Gabinetes::class)->name('gabinetes.index');
    Route::get('/product/{product}', \App\Http\Livewire\Insurance\Product::class)->name('product.show');

    Route::get('/calendar/dev', \App\Http\Livewire\ContactCalender::class)->name('contacts.index');

    Route::get('gabinetes/contact', \App\Http\Livewire\Payment\Gabinete::class)->name('gabinete.contact.index');
    Route::get('gabinetes/{gabinete}/pricing', \App\Http\Livewire\Payment\Pricing::class)->name('pricing.index');
    Route::get('transaction/status', \App\Http\Livewire\Payment\Transaction\Status::class)->name('payment.transaction.status');
});


//Answer a phone calls
Route::get('/twilio/answer_phone', [\App\Http\Controllers\VideoCallController::class, 'answerPhone']);

//Join room for public
Route::get('/twilio/webhook', [\App\Http\Controllers\VideoCallController::class, 'webhook']);
Route::get('/join_room/{roomName}', \App\Http\Livewire\JoinRoom::class)->name('communications.join_room');
Route::view('/view', 'pdfTemplates.demo.main');
Route::get('pdf', function () {
    $pdf = \PDF::loadView('pdfTemplates.demo.main');
    $name = time() . Str::random(40) . '.pdf';

    return $pdf->stream($name);
});

/* stripe webhook without CSRF token */
Route::post('webhook', function (Request $request) {
    $webhook = $request->all();
    /* Subscription auto-renewal webhook  */
    if ($webhook['type'] == 'invoice.paid') {
        Log::info('  invoice.paid start   ');
        $subscription_data = $webhook['data']['object'];

        /* find subscription details form the database */
        $subscription = \App\Models\Sales\Contract::where('subscription_id', $subscription_data['subscription'])->with('plan', 'gabinate')->first();
        if ($subscription) {

            /* find payment details form the database */
            $sale = \App\Models\Sales\Sale::where('payment_id', $subscription_data['id'])->first();

            if (!$sale && $subscription->plan) {
                /* Payment renewal */
                $period = $subscription_data['lines']['data'][0]['period'];
                /* Renewal time period (start and end) */
                $time = Carbon::parse($period['start']);
                $endtime = Carbon::parse($period['end']);

                $video_minutes = $subscription->plan->video_minutes;
                $expedients = $subscription->plan->expedients;
                if ($subscription->contract_length == 'yearly') {
                    /* Calculate Yearly Minutes and expedite  */
                    $expedients *= 12;
                    $video_minutes *= 12;
                }

                /* Reset all the default value */
                $subscription->video_minutes = $video_minutes;
                $subscription->users = $subscription->plan->users;
                $subscription->expedients = $expedients;
                $subscription->total_users = 0;
                $subscription->auto_renewal = 1;
                $subscription->renewal_time = $time;
                $subscription->expiration_time = $endtime;
                $subscription->save();

                /* renewal payment details */
                $sales = [
                    'contract_id' => $subscription->id,
                    'date' => $time,
                    'payment_id' => $subscription_data['id'],
                    'taxes' => $subscription_data['tax'] > 0 ? $subscription_data['tax'] / 100 : 0,
                    'paid_amount' => $subscription_data['total'] / 100,
                    'currency' => $subscription_data['currency'],
                ];
                Sale::create($sales);
                $gebinete = $subscription->gabinate;
                $employeeCount = count($gebinete->employees());
                /*   After Renewal Add Already Exist User   */
                updateUsageRecord($subscription, 'User', $employeeCount);
                Log::info('Sales update => ', [$subscription_data['id']]);
            } else {
                /* Payment already updated */
                Log::info('Sales already updated => ', [$subscription_data['id']]);
            }
        }
        Log::info('  invoice.paid end   ');
    } elseif /* Subscription update webhook */ ($webhook['type'] == 'customer.subscription.updated') {
        Log::info('  customer.subscription.updated  start ');
        $subscription_data = $webhook['data']['object'];
        /* Subscription auto-renewal cancel web hook */
        if ($subscription_data['cancel_at_period_end']) {
            $subscription = \App\Models\Sales\Contract::where('subscription_id', $subscription_data['id'])->with('plan')->first();
            if ($subscription) {
                /* database auto renewal flag change */
                $subscription->auto_renewal = 0;
                $subscription->save();
            }
            Log::info('  customer subscription cancel', [$subscription_data['id']]);
        }
        Log::info('  customer.subscription.updated  End ');
    }

    Log::info('web ==> ', $webhook);
});
