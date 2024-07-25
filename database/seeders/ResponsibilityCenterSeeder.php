<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResponsibilityCenter;

class ResponsibilityCenterSeeder extends Seeder
{
    public function run()
    {
        $responsibilityCenters = [
            ['name' => 'Marketing', 'description' => 'Handles marketing strategies and campaigns.'],
            ['name' => 'Finance', 'description' => 'Responsible for financial management.'],
            ['name' => 'Human Resources', 'description' => 'Manages recruitment and employee relations.'],
            ['name' => 'IT', 'description' => 'Oversees technology and systems.'],
            ['name' => 'Operations', 'description' => 'Responsible for daily business operations.'],
        ];

        foreach ($responsibilityCenters as $center) {
            ResponsibilityCenter::create($center);
        }
    }
}