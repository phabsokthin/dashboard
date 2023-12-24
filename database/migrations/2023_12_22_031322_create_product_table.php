<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("productname");
            $table->unsignedBigInteger("company_id");
            $table->foreign("company_id")->references("id")->on("companies")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade")->onUpdate("cascade");
            $table->string("qty");
            $table->string("price");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
