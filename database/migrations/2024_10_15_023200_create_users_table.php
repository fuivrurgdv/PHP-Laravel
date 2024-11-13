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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id')->unsigned();  // Khớp kiểu dữ liệu với bảng departments
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('phone_number', 20)->nullable();
            $table->integer('status')->default(1);
            $table->string('position');
            $table->timestamps();
            $table->integer('created_by')->nullable();  // Để không gặp lỗi nếu không có giá trị
            $table->integer('updated_by')->nullable();  // Tương tự

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
