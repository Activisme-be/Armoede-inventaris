<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateItemsTable
 */
class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('items', static function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->bigInteger('product_code')->unique()->index();
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('naam');
            $table->bigInteger('aantal');
            $table->string('opslag_locatie');
            $table->text('notitie')->nullable();
            $table->timestamps();

            // Indexes and foreign keys
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
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
        Schema::dropIfExists('items');
    }
}
