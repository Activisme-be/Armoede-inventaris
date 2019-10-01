<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
        // (1): The person_id is always required but is set to nullable.
        //
        //      EXAMPLE:
        //      ----------
        //      Notes first will store the note and his author. Later in the process
        //      We attach the person to the note trough the HasMany logic.

        Schema::create('notes', static function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_id')->nullable(); // (1)
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->string('titel');
            $table->text('notitie');
            $table->timestamps();

            // Foreign keys
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('set null');
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
