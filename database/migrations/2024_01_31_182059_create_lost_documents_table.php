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
        Schema::create('lost_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_type_id')->references('id')->on('document_types')->onDelete('cascade');
            $table->foreignId('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->string('serialNumber');
            $table->string('institution_on_document')->nullable();
            $table->string('location')->nullable();
            $table->string('police_ref_number')->nullable();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email');
            $table->string('code');
            $table->string('phoneNumber');
            $table->string('address');
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_documents');
    }
};
