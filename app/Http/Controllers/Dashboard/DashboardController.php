<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CustomerManagment;
use App\Models\Orders;
use App\Models\OrdersProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $total_items = DB::table('orders_products')->sum('total_items');
        $customaer = CustomerManagment::count();
        $orders = OrdersProduct::all(); //with('customers','products')->get();
        // dd($orders);
        return response()->view('dashboard.index',compact('total_items','customaer', 'orders'));
    }
    public function orderChart(Request $request)
    {
        $year = $request->input('year');
        $entries = OrdersProduct::select([
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_items) as total'),
            DB::raw('COUNT(*) as count'),
        ])
            ->whereYear('created_at', $year)

            ->orderBy('month')->groupBy([
                'month',
            ])
            ->get();

        $labels = [
            1 => 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];
        $total = $count = [];
        foreach ($entries as $entry) {
            $total[$entry->month] = $entry->total;
            $count[$entry->month] = $entry->count;
        }
        foreach ($labels as $month => $name) {
            if (!array_key_exists($month, $total)) {
                $total[$month] = 0;
            }
            if (!array_key_exists($month, $count)) {
                $count[$month] = 0;
            }
        }
        ksort($total);
        ksort($count);

        return [

            'labels' => array_values($labels),
            'datasets' => [
                [
                    'label' => 'Total Sales',
                    'borderColor' =>   'rgba(255, 99, 132, 1)',
                    'backgroundColor' =>   'rgba(255, 99, 132, 1)',
                    'data' => array_values($total),
                ],



            ],
        ];
    }
}
