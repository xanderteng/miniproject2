<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('locations', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique(); 
        $table->timestamps();
    });

    $locations = [];
    for ($i = 1; $i <= 10; $i++) {
        $locations[] = ['name' => 'A' . $i, 'created_at' => now(), 'updated_at' => now()];
    }
    DB::table('locations')->insert($locations);
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
