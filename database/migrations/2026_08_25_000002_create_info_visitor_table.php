<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('info_visitor', function (Blueprint $table) {
            $table->id('Serial');
            $table->string('Name');
            $table->string('Contact', 20);
            $table->string('Purpose');
            $table->string('meetingTo');
            $table->date('Date');
            $table->dateTime('TimeIN');
            $table->dateTime('TimeOUT')->nullable();
            $table->string('Status')->default('Active');
            $table->text('Comment')->nullable();
            $table->unsignedInteger('receipt_id')->unique()->nullable();
            $table->timestamps();
            $table->index(['Date', 'Status']);
        });
    }
    public function down(): void { Schema::dropIfExists('info_visitor'); }
};
