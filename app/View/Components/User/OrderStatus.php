<?php

namespace App\View\Components\User;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\View\Component;

class OrderStatus extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $status;
    public $statusClass;
    public function __construct($id)
    {
        $transaction = Transaction::with(['orders.training'])->find($id);

        if ($transaction->payment_amount > 0) {
            if ($transaction->payment_method == 'Midtrans') {
                if ($transaction->status_order == 'success') {
                    $this->status = 'Success';
                    $this->statusClass = 'bg-success';
                } elseif ($transaction->status_order ==  'settlement') {
                    $this->status = 'Settlement';
                    $this->statusClass = 'bg-success';
                } elseif ($transaction->status_order == 'pending') {
                    $this->status = 'Pending';
                    $this->statusClass = 'bg-info';
                } elseif ($transaction->status_order == 'denied') {
                    $this->status = 'Denied';
                    $this->statusClass = 'bg-danger';
                } elseif ($transaction->status_order == 'expired') {
                    $this->status = 'Expired';
                    $this->statusClass = 'bg-warning';
                } else {
                    $this->status = 'Menunggu Pembayaran';
                    $this->statusClass = 'bg-secondary';
                }
            } else {
                if ($transaction->status == 'Lunas') {
                    $this->status = 'Lunas';
                    $this->statusClass = 'bg-success';
                } elseif ($transaction->status == 'Expired') {
                    $this->status = 'Expired';
                    $this->statusClass = 'bg-warning';
                } else {
                    $this->status = 'Menunggu Pembayaran';
                    $this->statusClass = 'bg-info';
                }
            }
        } else {
            $this->status = 'Gratis';
            $this->statusClass = 'bg-success';
        }


        // $this->status = $order->payment_method->name;
        // $this->statusClass = 'bg-dark';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.order-status');
    }
}
