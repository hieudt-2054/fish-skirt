<?php

use Illuminate\Database\Seeder;
use App\SpendCategory;

class SpendCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Ăn uống',
            'Làm đẹp',
            'Thời trang',
            'Công Việc'
        ];

        foreach ($data as $item) {
            SpendCategory::firstOrCreate(['name' => $item]);
        }
    }
}
