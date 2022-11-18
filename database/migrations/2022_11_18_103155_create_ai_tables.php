<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $tableIntents = "ai_intents";
    private $tablePatterns = "ai_patterns";
    private $tableResponses = "ai_responses";

    public function up()
    {
        if(!Schema::hasTable($this->tableIntents)){
            Schema::create($this->tableIntents, function (Blueprint $table) {
                $table->id();
                $table->string("tag", 50)->nullable(false);
                $table->text("description")->nullable(true);
                $table->boolean("static")->default(false);
                $table->integer("project_id")->nullable(true)->default(0);
                $table->timestamps();
            });
        }
        if(!Schema::hasTable($this->tablePatterns)){
            Schema::create($this->tablePatterns, function (Blueprint $table) {
                $table->id();
                $table->text("pattern")->nullable(false);
                $table->integer("intent_id")->nullable(false);
                $table->text("description")->nullable(true);
                $table->timestamps();
            });
        }
        if(!Schema::hasTable($this->tableResponses)){
            Schema::create($this->tableResponses, function (Blueprint $table) {
                $table->id();
                $table->text("response")->nullable(false);
                $table->integer("intent_id")->nullable(false);
                $table->text("description")->nullable(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableResponses);
        Schema::dropIfExists($this->tablePatterns);
        Schema::dropIfExists($this->tableIntents);
    }
};
