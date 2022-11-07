<?php

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
        $this->call(DefaultTrialPlanSeeder::class);
        $this->call(MakeCountriesSeeder::class);
        $this->call(DefaultUserSeeder::class);
        $this->call(DefaultRoleSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(DefaultCompanySizeSeeder::class);
        $this->call(MaritalStatusTableSeeder::class);
        $this->call(CreateDefaultIndustriesSeeder::class);
        $this->call(CreateDefaultOwnerShipTypeSeeder::class);
        $this->call(CreateDefaultJobTypeSeeder::class);
        $this->call(CreateDefaultCareerLevelSeeder::class);
        $this->call(CreateDefaultJobShiftSeeder::class);
        $this->call(CreateDefaultCurrencySeeder::class);
        $this->call(CreateDefaultSalaryPeriodSeeder::class);
        $this->call(CreateDefaultFunctionalAreaSeeder::class);
        $this->call(CreateDefaultDegreeLevelSeeder::class);
        $this->call(JobCategorySeeder::class);
        $this->call(SkillTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(CreateDefaultPostCategorySeeder::class);
        $this->call(CreateFrontSettingSeeder::class);
        $this->call(UpdateSettingsTableSeeder::class);
    }
}
