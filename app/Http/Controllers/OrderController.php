<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    public function store()
    {
        $user = User::find(1);

        $order = Order::create([
            'amount' => 123.45,
            'user_id' => $user->id,
        ]);

        $user->notify(new OrderRegistered($order));

        if ($user->notifications->count()) {
            dd($user->notifications);
        }
    }
}
