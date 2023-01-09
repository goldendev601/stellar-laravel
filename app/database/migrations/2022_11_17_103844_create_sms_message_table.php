<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_message', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('message_bird_id', 100);
            $table->string('sender_msisdn', 50);
            $table->string('receiver_msisdn', 50);
            $table->string('body', 3000);
            $table->string('status', 50);
            $table->string('status_reason', 350)->nullable();
            $table->string('recipient_country', 250)->nullable();
            $table->string('recipient_operator', 250)->nullable();
            $table->decimal('price_amount', 10, 4)->nullable();
            $table->string('price_currency', 50)->nullable();
            $table->dateTime('status_date_time');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->unique(['receiver_msisdn', 'sender_msisdn', 'message_bird_id'], 'uq_sms_message_unique_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_message');
    }
}
