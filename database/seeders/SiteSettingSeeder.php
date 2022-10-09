<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Setting\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SiteSetting::create([
            "title" => "Phone Book",
            "phone" => "",
            "email" => "",
            "website" => "",
            "address" => "",
            "description" => "It is a contact store system",
            "logo" => "backend/setting/sitesetting/logo.png",
            "favicon" => "backend/setting/sitesetting/favicon.png",
        ]);
    }
}
