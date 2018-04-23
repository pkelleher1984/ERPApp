<?php

use Illuminate\Database\Seeder;

use App\RefFinish;

class FinishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    function buildFinish ($name) {
        RefFinish::create(['name' => $name]);
        
    }
    public function run()
    {
        //
        echo(" -- FinishTableSeeder:");
        $this->buildFinish ('none'); // Should only occur during testing
        $this->buildFinish ('staple');
        $this->buildFinish ('cut');
        $this->buildFinish ('booklet');
        
        
    }
}
