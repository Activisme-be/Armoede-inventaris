<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateNotesTable
 */
class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('notes', static function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->boolean('is_public')->default(true);
            $table->string('titel');
            $table->timestamps();

            // Foreign keys
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('set_null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
}
