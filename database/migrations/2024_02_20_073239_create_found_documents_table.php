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
        Schema::create('found_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_type_id')->references('id')->on('document_types')->onDelete('cascade');
            $table->foreignId('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->string('serialNumber');
            $table->string('owner_fname');
            $table->string('owner_lname');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('institution_on_document')->nullable();
            $table->string('reprter_email');
            $table->string('reporter_code');
            $table->string('reporter_phoneNumber');
            $table->string('reporter_fname');
            $table->string('reporter_lname');
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('found_documents');
    }
};
