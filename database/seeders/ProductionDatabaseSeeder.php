<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductionDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductionUsersSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(ProductionCurrenciesTableSeeder::class);
        $this->call(ProductionCountriesTableSeeder::class);
        $this->call(DestinySeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(GuaranteesTableSeeder::class);
        $this->call(SubguaranteesTableSeeder::class);
        $this->call(DeprecationgroupSeeder::class);
        $this->call(RamosTableSeeder::class);

        $this->call(PreexistenceClassSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(RiskgroupsTableSeeder::class);
        $this->call(RisksubgroupsTableSeeder::class);
        $this->call(RiskdetailsTableSeeder::class);
        $this->call(CapitalsTableSeeder::class);

//        $this->call(CompaniesTableSeeder::class);
//        $this->call(CompanyProductsSeeder::class);
//
//        $this->call(GabinetesTableSeeder::class);
//        $this->call(GabineteUserTableSeeder::class);
//        $this->call(AddressesTableSeeder::class);
//        $this->call(AssessmentsTableSeeder::class);
//        $this->call(AttachmentsTableSeeder::class);
//        $this->call(CapitalPolicyTableSeeder::class);
//        $this->call(CapitalProductTableSeeder::class);
//        $this->call(CompanyRamoTableSeeder::class);
//        $this->call(ContactsTableSeeder::class);
//        $this->call(DeprecationgroupsTableSeeder::class);
//        $this->call(ExpedientsTableSeeder::class);
//        $this->call(DocumentversionsTableSeeder::class);
//        $this->call(EstimationsTableSeeder::class);
//        $this->call(ExpedientTypecaseTableSeeder::class);
//        $this->call(HomePreexistencesTableSeeder::class);
//        $this->call(ImagesTableSeeder::class);
//        $this->call(PeopleTableSeeder::class);
//        $this->call(PicturesTableSeeder::class);
//        $this->call(PoliciesTableSeeder::class);
//        $this->call(StatusesTableSeeder::class);
//        $this->call(TextAdjustersTableSeeder::class);
//        $this->call(TextPreexistencesTableSeeder::class);
//        $this->call(TypecasesTableSeeder::class);
//        $this->call(BuildingDeprecationsTableSeeder::class);
    }
}
