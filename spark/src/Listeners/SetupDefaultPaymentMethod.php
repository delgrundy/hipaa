<?php

namespace Spark\Listeners;

use Laravel\Cashier\Cashier;

class SetupDefaultPaymentMethod
{
    /**
     * Handle the event.
     *
     * @param  \Laravel\Cashier\Events\WebhookHandled  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->payload['type'] != 'customer.subscription.created') {
            return;
        }

        $billable = Cashier::findBillable($event->payload['data']['object']['customer']);

        if ($billable) {
            $subscription = $billable->subscriptions()
                ->where('stripe_id', $event->payload['data']['object']['id'])
                ->first();

            if ($subscription) {
                $subscription->updateStripeSubscription([
                    'default_payment_method' => null,
                ]);
            }

            if (! is_null($paymentMethod = $billable->paymentMethods()->first())) {
                $billable->updateDefaultPaymentMethod(
                    $paymentMethod->asStripePaymentMethod()
                );
            }
        }
    }
}
