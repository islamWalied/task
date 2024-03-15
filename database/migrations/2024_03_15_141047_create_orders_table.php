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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('order_number')->unique();
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('pending');
            $table->string('payment_method');
            $table->string('payment_status')->default('pending');
            $table->text('shipping_address');
            $table->text('billing_address')->nullable();
            $table->string('shipping_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
