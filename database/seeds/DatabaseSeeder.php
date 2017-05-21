<?php

use App\User;
use App\Product;
use App\Category;
use App\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        $countUsers = 200;
        $countCategories = 30;
        $countProducts = 1000;
        $countTransactions = 1000;


        factory(User::class, $countUsers)->create();
        factory(Category::class, $countCategories)->create();

        factory(Product::class, $countTransactions)->create()->each(
        	function($product) {
        		$categories = Category::all()->random(mt_rand(1,5))->pluck('id');

        		$product->categories()->attach($categories);
        	}
        );

        factory(Transaction::class, $countTransactions)->create();

    }
}
