<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_pref', function (Blueprint $table) {
			$table->id();
			$table->string('tes_string', 255);
			$table->double('tes_double', 10, 8);
			$table->decimal('tes_decimal', $precision = 8, $scale = 8);
			$table->text('tes_text');
            $table->timestamps();
            $table->softDeletes();

		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_pref');
    }
};