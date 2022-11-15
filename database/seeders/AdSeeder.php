<?php

namespace Database\Seeders;

use App\Models\Ad;
use Illuminate\Database\Seeder;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ad::create([
            'title' => 'اعلان اول',
            'description' => 'وصف اول',
            'image' => '',
            'link' => 'رابط اول',
        ]);
        Ad::create([
            'title' => 'اعلان ثاني',
            'description' => 'وصف ثاني',
            'image' => '',
            'link' => 'رابط ثاني',
        ]);
        Ad::create([
            'title' => 'اعلان ثالث',
            'description' => 'وصف ثالث',
            'image' => '',
            'link' => 'رابط ثالث',
        ]);

    }
}
