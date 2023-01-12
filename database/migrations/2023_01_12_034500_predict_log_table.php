<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $table = 'predict_logs';

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->integer('status');
            $table->string('content');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
};
