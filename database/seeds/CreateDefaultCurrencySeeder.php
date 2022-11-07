<?php

use App\Models\SalaryCurrency;
use Illuminate\Database\Seeder;

class CreateDefaultCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            [
                'currency_name' => 'USD US Dollar',
            ],
            [
                'currency_name' => 'EUR Euro',
            ],
            [
                'currency_name' => 'HKD Hong Kong Dollar',
            ],
            [
                'currency_name' => 'INR Indian Rupee',
            ],
            [
                'currency_name' => 'AUD Australian Dollar',
            ],
            [
                'currency_name' => 'JMD Jamaican Dollar',
            ],
            [
                'currency_name' => 'CAD Canadian Dollar',
            ],
        ];

        foreach ($input as $data) {
            SalaryCurrency::create($data);
        }
    }
}
