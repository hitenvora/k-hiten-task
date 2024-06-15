<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductPerKgPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Products = Product::get();

        foreach ($Products as $Product) {

            // $gst = '';
            // $gstList = json_decode($Product->gst);
            // foreach ($gstList as $list) {
            //     try {
            //         $gst = (float)$gst + (float)reset($list);
            //     } catch (\Throwable $th) {
            //     }
            // }
            // if ($gst != 0) {
            //     $text_prize = round((float)$Product->per_kg_price / (($gst / 100) + 1), 3);
            //     $Product->text_prize =  $text_prize;
            //     $Product->save();
            // } else {
            //     $Product->text_prize =  0;
            //     $Product->save();
            // }
            // $Inventory = Inventory::where('product_id', $Product->id)->first();

            // if ($Inventory == null) {
            //     $Inventory = new Inventory();
            //     $Inventory->product_id = $Product->id;
            //     $Inventory->inventorie = 10;
            // }
            // $Inventory->save();

            $Product->price_1 = 50;
            $Product->price_2 = 100;
            $Product->price_3 = 200;
            $Product->price_4 = 300;
            $Product->kg_1 = 0.250;
            $Product->kg_2 = 0.500;
            $Product->kg_3 = 0.750;
            $Product->kg_4 = 1;
            $Product->save();
        }
    }
}
