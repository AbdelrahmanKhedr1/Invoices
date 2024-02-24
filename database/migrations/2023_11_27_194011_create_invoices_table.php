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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('product');                          // المنتج
            $table->string('user');                             // اللي عامل الفاتوره
            $table->string('file')->nullable();                 // الفايل
            $table->string('invoice_number')->unique();         // رقم الفاتوره
            $table->string('rate_vat');                         // نسبه الضريبه
            $table->decimal('value_vat', 15, 2);                 // قيمه الضريبه
            $table->decimal('discount', 15, 2);                  // الخصم
            $table->date('due_date')->nullable();               // تاريخ الاستحقاق
            $table->decimal('total', 15, 2);                     // الاجمالي
            $table->text('note')->nullable();                   // ملاحظات
            $table->decimal('amount_collection',8,2)->nullable();;  // مبلغ التحصيل
            $table->decimal('amount_commission',8,2);               // مبلغ العموله
            $table->foreignId('section_id')->constrained('sections')->references('id')->cascadeOnDelete();
            $table->foreignId('status_id')->constrained('statuses')->references('id')->default(1)->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
