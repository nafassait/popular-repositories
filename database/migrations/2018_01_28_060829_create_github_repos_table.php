<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGithubReposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('github_repos', function (Blueprint $table) {
            $table->bigInteger('repo_id');
            $table->primary('repo_id');
            $table->string('name', 255);
            $table->string('url', 255);
            $table->dateTime('created_at');
            $table->dateTime('last_push_date');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('stars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('github_repos');
    }
}
