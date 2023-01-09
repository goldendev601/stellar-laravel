<?php

use App\ModelsExtended\Vendor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $vendors = Vendor::all();
        $faker = Faker\Factory::create();
        $uniqueVendorNameList = $vendors->pluck('alias')->toArray();
        foreach($vendors as $vendor){
            if($vendor->alias == null){
                if(in_array($vendor->name, $uniqueVendorNameList)){

                    $uniqueAlias = $vendor->name.'-'.Str::random(20);
                }else{
                    $uniqueAlias = $vendor->name;
                }
                array_push($uniqueVendorNameList, $uniqueAlias);
                $vendor->update(['alias' => $uniqueAlias]);
            }
        };

        foreach ($vendors->groupBy('address') as $key => $vendor)
        {
            if($key != null){
                if(count($vendor) > 1){
                    foreach ($vendor as $key => $item){
                        if($key !=0){
                            $item->update([
                                'address' => $item->address.''.$key
                            ]);
                        }
                    }
                }
            }else{
                foreach ($vendor as $item){
                    $item->update([
                        'address' => $faker->address
                    ]);
                }
            }

        }
        Schema::table('vendor', function (Blueprint $table) {
            $table->string('alias')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor', function (Blueprint $table) {
            $table->string('alias')->nullable()->change();
        });
    }
};
