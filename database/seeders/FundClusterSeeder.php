<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FundCluster;

class FundClusterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fundClusters = [
            ['name' => 'General Fund', 'code' => 'GF-001'],
            ['name' => 'Special Purpose Fund', 'code' => 'SPF-001'],
            ['name' => 'Trust Fund', 'code' => 'TF-001'],
            ['name' => 'Other Funds', 'code' => 'OF-001'],
            ['name' => 'Revolving Fund', 'code' => 'RF-001'],
            ['name' => 'Capital Outlay Fund', 'code' => 'COF-001'],
            ['name' => 'Disaster Risk Reduction and Management Fund', 'code' => 'DRRMF-001'],
            ['name' => 'Local Development Fund', 'code' => 'LDF-001'],
            ['name' => 'Special Education Fund', 'code' => 'SEF-001'],
            ['name' => 'Gender and Development Fund', 'code' => 'GDF-001'],
        ];

        foreach ($fundClusters as $fundCluster) {
            FundCluster::create($fundCluster);
        }
    }
}