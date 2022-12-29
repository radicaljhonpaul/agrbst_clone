<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
       
        $this->call(UserSeeder::class);
        $this->call(UserDetailSeeder::class);
        $this->call(BusinessDetailSeeder::class);
        $this->call(FarmDetailSeeder::class);
        $this->call(CropSeeder::class);
        $this->call(CropProductionSeeder::class);
        $this->call(CropPricingSeeder::class);
        $this->call(CropProductionHarvestingModelSeeder::class);
        $this->call(AuthorizedPersonSeeder::class);
        $this->call(CropVarietySeeder::class);
        $this->call(MappedTransactionSeeder::class);
        $this->call(ConsolidatedDemandSeeder::class);
        $this->call(DemandSeeder::class);
        $this->call(CommitSeeder::class);
        $this->call(CommitDemandTransactionSeeder::class);
        $this->call(AdminFarmerRequestSeeder::class);
        $this->call(DepositTransactionSeeder::class);
        $this->call(ShelfLifeSeeder::class);
        $this->call(AgrihubShelfSeeder::class);
        $this->call(PaymentHistorySeeder::class);
        // $this->call(DemandSeeder::class);
        
    }
}
