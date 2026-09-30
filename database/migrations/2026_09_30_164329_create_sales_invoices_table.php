<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('sales_invoices', function (Blueprint $table) {

            $table->id();


            $table->string('invoice_number')
                ->unique();


            $table->foreignId('customer_id')
                ->constrained();


            $table->foreignId('sales_order_id')
                ->nullable()
                ->constrained();


            $table->decimal('subtotal', 15, 2)
                ->default(0);


            $table->decimal('discount', 15, 2)
                ->default(0);


            $table->decimal('tax', 15, 2)
                ->default(0);


            $table->decimal('total_amount', 15, 2)
                ->default(0);


            $table->enum('payment_status', [

                'unpaid',
                'partial',
                'paid'

            ])
                ->default('unpaid');


            $table->date('invoice_date');


            $table->date('due_date')
                ->nullable();


            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('sales_invoices');
    }
};
