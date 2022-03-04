<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::where('id', 1)->first();
        Category::insert([
            [
                'name' => 'Smartphone',
                'description' => 'This category belongs to Smartphone',
                'created_by' => $admin->id,
                'edited_by' => null,
                'status' => 1,
            ],
            [
                'name' => 'Laptop',
                'description' => 'This category belongs to Laptop',
                'created_by' => $admin->id,
                'edited_by' => null,
                'status' => 1,
            ],
            [
                'name' => 'Monitor',
                'description' => 'This category belongs to Monitor',
                'created_by' => $admin->id,
                'edited_by' => null,
                'status' => 1,
            ],
            [
                'name' => 'Accessories',
                'description' => 'This category belongs to Accessories',
                'created_by' => $admin->id,
                'edited_by' => null,
                'status' => 1,
            ],
            [
                'name' => 'Others',
                'description' => 'This category belongs to Others',
                'created_by' => $admin->id,
                'edited_by' => null,
                'status' => 1,
            ],
        ]);
    }
}
