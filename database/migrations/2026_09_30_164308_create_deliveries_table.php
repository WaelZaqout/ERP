<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('deliveries', function (Blueprint $table) {

            $table->id();


            $table->string('delivery_number')
                ->unique();


            $table->foreignId('sales_order_id')
                ->constrained();


            $table->foreignId('warehouse_id')
                ->constrained();


            $table->foreignId('delivered_by')
                ->constrained('users');


            $table->enum('status', [

                'pending',
                'completed',
                'cancelled'

            ])
                ->default('pending');


            $table->date('delivery_date');


            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
