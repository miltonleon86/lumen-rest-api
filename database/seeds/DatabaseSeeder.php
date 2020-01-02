<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    /** Create 6 items */
	    factory(\App\Models\Item::class, 6)->create();

	    /** Create 2 carts */
	    factory(\App\Models\Cart::class, 2)->create();
    }
}
