<?php

namespace Modules\Store\Observers;


use Illuminate\Support\Facades\Mail;
use Modules\Store\Emails\Orders\OrderIsSendEmail;
use Modules\Store\Entities\Order;
use Modules\Store\Notifications\Orders\RegisterOrderNotification;

class OrderObserver
{

    /**
     * Notify client for
     * @param Order $order
     */
    public function created(Order $order)
    {
        $client = $order->getClient();
        $client->notify(new RegisterOrderNotification($order));
    }

    /**
     * @param Order $order
     */
    public function saved(Order $order)
    {
        $this->notifyUserWhenOrderIsSend($order);

        /// increment product available when order cancelled or returned
        $this->incrementAvailableProducts($order);
    }

    /**
     * Increment product availability when order status
     * changed to [cancelled, returned]
     * @param Order $order
     */
    private function incrementAvailableProducts(Order $order)
    {
        $data = $order->getChanges();
        if (isset($data['status']) && in_array($data['status'], ['cancelled', 'returned'])) {
            $orderProducts = $order->getProducts()->get();
            $orderProducts->map(function ($orderProduct) {
                $orderProduct->incrementAvailableCount();
            });
        }
    }


    /**
     * @param Order $order
     */
    private function notifyUserWhenOrderIsSend(Order $order)
    {
        $data = $order->getChanges();
        if (isset($data['status']) && $data['status'] == 'send') {
            $client = $order->getClient();
            Mail::to($client->email)->send(new OrderIsSendEmail($order));
        }
    }
}
