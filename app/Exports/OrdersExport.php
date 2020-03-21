<?php

namespace App\Exports;

use App\Order;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrdersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::query()
        ->where('state', '<>', 'pending')
        ->orderByDesc('order_date')
        ->orderByDesc('estimated_time')
        ->get();
    }
}
