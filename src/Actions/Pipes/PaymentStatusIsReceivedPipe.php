<?php

namespace Loot\Tenge\Actions\Pipes;

use Loot\Tenge\TengePayment;

class PaymentStatusIsReceivedPipe
{
    /**
     * Check that payment exists.
     *
     * @param TengePayment $payment
     * @param \Closure $next
     * @throws \Exception
     * @return mixed
     */
    public function handle($payment, \Closure $next)
    {
        if ($payment->status !== TengePayment::STATUS_RECEIVED) {
            throw new \Exception('payment with id '.$payment->id.' should has status '.TengePayment::STATUS_RECEIVED);
        }

        resolve('tenge_logger')->info('payment '.$payment->id.' has correct status', $payment->toArray());

        return $next($payment);
    }
}
