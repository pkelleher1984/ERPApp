<?php

use Illuminate\Database\Seeder;

use App\RefBinding;

class BindingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    function buildBinding ($name) {
        RefBinding::create(['name' => $name]);
        
    }
    public function run()
    {
        //
        echo(" -- BindingTableSeeder:");
        $this->buildBinding ('coil'); // Should only occur during testing
        $this->buildBinding ('binder');
        $this->buildBinding ('bag');
        $this->buildBinding ('pad');
        $this->buildBinding ('shrink');
        $this->buildBinding ('glue');
        
    }
}
