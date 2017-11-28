<?php

use Illuminate\Database\Seeder;
use Delivery\Models\Company;
use Delivery\Models\Cupom;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Company::class,5)->create()->each(function(Company $o){
            for ($i=0;$i<2;$i++)
                $o->cupom()->save(factory(Cupom::class)->make());
        });

    }
}
