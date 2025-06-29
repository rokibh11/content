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
    Schema::create('generated_contents', function (Blueprint $table) {
        $table->id();
        $table->string('keyword')->nullable();
        $table->string('title')->nullable();
        $table->string('meta_title')->nullable();
        $table->text('meta_description')->nullable();
        $table->string('h1')->nullable();
        $table->text('inbound_link')->nullable();
        $table->text('outbound_link')->nullable();
        $table->longText('content')->nullable();
        $table->integer('content_length')->nullable();
        $table->timestamps();
    });
}

};
