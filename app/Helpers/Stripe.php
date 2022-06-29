<?php

use Carbon\Carbon;

/*
 *          Find Subscription By Gabinate ID
 */
function getGebineteStripeSubscriptionId($gabinateId)
{
    $gabinate = \App\Models\Gabinete::find($gabinateId);
    if ($gabinate && $gabinate->subscriptions) {
        $sub = $gabinate->currentSubscription();
        if ($sub) {
            $sub->load('plan');

            return $sub;
        }
    }

    return null;
}

function getUsagesRecode($SubscriptionItemId, $invoiceId = null)
{
    $stripe = new \Stripe\StripeClient(
        env('STRIPE_SECRET_KEY')
    );
    $uses = $stripe->subscriptionItems->allUsageRecordSummaries(
        $SubscriptionItemId,
        []
    );

    foreach ($uses->data as $recode) {
        if ($recode->invoice == $invoiceId) {
            return $recode->total_usage;
        }
    }

    return 0;
}

/*
 *          Subscription Used Item Add In Stripe
 */
function updateUsageRecord($subscription, $type = 'Expedient' /*Expedient,User*/, $quantity = 1, $action = 'increment' /* increment or set*/)
{
    $ntimeperiod = $subscription->contract_length == 'monthly' ? ' Monthly' : ' Yearly';
    $plan = $subscription->plan->name;
    $subscription_id = $subscription->subscription_id;
    if (! $subscription->subscription_id) {
        return false;
    }
    $stripe = new \Stripe\StripeClient(
        env('STRIPE_SECRET_KEY')
    );
    $StripeSubscription = $stripe->subscriptions->retrieve(
        $subscription_id,
        []
    );
    if (! $StripeSubscription) {
        return false;
    }
    $userItem = [];
    foreach ($StripeSubscription->items->data as $data) {
        if ($data->price->lookup_key == $plan.' User'.$ntimeperiod) {
            $userItem['Expedient'] = $data->id;
        } elseif ($data->price->lookup_key == $plan.' Expedient'.$ntimeperiod) {
            $userItem['User'] = $data->id;
        }
    }
    if (isset($userItem[$type]) && ! empty($userItem[$type])) {
        $time = Carbon::now()->timestamp;
        $update_qty = ['quantity' => $quantity, 'timestamp' => $time];
        if ($action != 'increment') {
            $update_qty['action'] = 'set';
        }
        $subscriptionItemsUpdate = $stripe->subscriptionItems->createUsageRecord(
            $userItem[$type],
            $update_qty
        );
        if ($subscriptionItemsUpdate) {
            return true;
        }
    }

    return false;
}
