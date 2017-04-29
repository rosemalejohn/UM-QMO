<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('request_number');
            $table->string('branch');
            $table->string('specific_branch')->nullable();
            $table->string('request_nature')->nullable();
            $table->string('document_title')->nullable();
            $table->string('description')->nullable();
            $table->string('reason')->nullable();
            $table->string('request_by');
            $table->string('email')->nullable();
            $table->string('document_id')->nullable();
            $table->date('date_issued')->nullable();
            $table->string('rev_number')->nullable();
            $table->string('remarks')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->date('effective_date')->nullable();
            $table->string('unit_head')->nullable();
            $table->boolean('is_done')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_froms');
    }
}
