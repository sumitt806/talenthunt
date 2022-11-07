<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imageUrl = 'assets/img/th-logo.png';
        $favicon = 'favicon.ico';

        Setting::create(['key' => 'application_name', 'value' => 'Talent Hunt']);
        Setting::create(['key' => 'logo', 'value' => $imageUrl]);
        Setting::create(['key' => 'favicon', 'value' => $favicon]);
        Setting::create(['key' => 'company_description', 'value' => 'Leading Laravel Development Company of India']);
        Setting::create([
            'key'   => 'address',
            'value' => '446, Tulsi Arcade, Nr. Sudama Chowk, Mota Varachha, Surat - 394101, Gujarat, India',
        ]);
        Setting::create(['key' => 'phone', 'value' => '+91 99887 66554']);
        Setting::create(['key' => 'email', 'value' => '#']);
        Setting::create(['key' => 'facebook_url', 'value' => '#']);
        Setting::create(['key' => 'twitter_url', 'value' => '#']);
        Setting::create(['key' => 'google_plus_url', 'value' => '#']);
        Setting::create([
            'key'   => 'linkedIn_url',
            'value' => '#',
        ]);
        Setting::create([
            'key' => 'about_us', 'value' => 'Over past 10+ years of experience and skills in various technologies, we built great scalable products.
Whatever technology we worked with, we just not build products for our clients but we also try to make it generate and available to other lots of developers worldwide. And that\'s the reason we are the only leading company in India who created tools and available it to millions of developers worldwide. Feel free to checkout our Github account. Because we believe that open-source is the future !! We have an open-source lab to which we call Talent Hunt Lab .',
        ]);
    }
}
