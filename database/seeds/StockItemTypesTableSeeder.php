<?php

use Illuminate\Database\Seeder;

use App\RefStockItemType;

class StockItemTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    function buildProdType ($name) {
        RefStockItemType::create(['name' => $name]);
        
    }
    public function run()
    {
        //
        echo(" -- StockItemTypesTableSeeder:");
        $this->buildProdType ('none'); // Should only occur during testing
        $this->buildProdType ('Book');
        $this->buildProdType ('Disc');
        $this->buildProdType ('Combo');
        $this->buildProdType ('Paper');
        $this->buildProdType ('Cover');
        $this->buildProdType ('Coil');
        $this->buildProdType ('Binder');
        $this->buildProdType ('Box');
        $this->buildProdType ('Other');
    }
}
