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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id(); // Tạo cột id auto-increment
            $table->unsignedBigInteger('user_id'); // Khóa ngoại liên kết đến bảng users
            $table->string('month', 7); // Dạng "YYYY-MM" để lưu tháng
            $table->integer('valid_days'); // Số ngày hợp lệ
            $table->integer('invalid_days'); // Số ngày không hợp lệ
            $table->decimal('salary_received', 15, 2); // Lương nhận (lưu giá trị số với 2 chữ số thập phân)
            $table->timestamps(); // Tạo 2 cột created_at và updated_at

            $table->foreign('user_id')
          ->references('id')->on('users')
          ->onDelete('cascade')
          ->onUpdate('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
