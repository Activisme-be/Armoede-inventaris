<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreatePeopleTable
 */
class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('people', static function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->string('voornaam');
            $table->string('achternaam');
            $table->string('email')->unique();
            $table->string('telefoon_nummer')->nullable();
            $table->string('straat_huisnummer')->nullable();
            $table->string('postcode')->nullable();
            $table->string('stad_of_gemeente')->nullable();
            $table->string('land')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
}
