<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        Model::unguard();

        $this->truncateMultiple([
            'cache',
            'failed_jobs',
            'ledgers',
            'jobs',
            'sessions',
        ]);

        $this->call(AuthTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(OfficeTypesTableSeeder::class);
        $this->call(OfficesTableSeeder::class);
        $this->call(DivisionsTableSeeder::class);
        $this->call(ClientTypesTableSeeder::class);
        $this->call(RequestTypesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SubCategoriesTableSeeder::class);
        $this->call(PriorityLevelsTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(MediaTableSeeder::class);
        $this->call(HostsTableSeeder::class);

        Model::reguard();
    }
}
