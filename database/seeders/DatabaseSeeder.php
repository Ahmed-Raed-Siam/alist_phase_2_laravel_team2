<?php

namespace Database\Seeders;

// use App\Models\Category;
use App\Models\Orders;
use Database\Factories\OrderFactory;
use Database\Factories\OrderProductFactory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(100)->create();

        $this->call(AdminSeeder::class);
        $this->call(OrderCasesSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(AdSeeder::class);
        // Orders::factory(100)->has(
        //     OrderProductFactory::factory(rand(1, 5))
        // )->create( );

    }
}
