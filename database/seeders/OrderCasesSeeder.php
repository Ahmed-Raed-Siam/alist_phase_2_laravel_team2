<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\DeliveryDrivers;
use App\Models\OrderCases;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OrderCasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cases = ['تم الاستلام','قيد التوصيل','قيد التجهيز','جديد'];
        foreach ($cases as $case){
            $case_order = OrderCases::create([
                'name' => $case,
            ]);
        }
        $driver = DeliveryDrivers::create([
            'name' => 'محمد احمد',
        ]);

    }
}
