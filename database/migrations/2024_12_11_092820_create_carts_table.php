<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // شناسه اصلی
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // کاربر صاحب سبد خرید
            $table->string('session_id')->nullable(); // شناسه جلسه برای کاربران مهمان
            $table->timestamps(); // زمان ایجاد و به‌روزرسانی
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
