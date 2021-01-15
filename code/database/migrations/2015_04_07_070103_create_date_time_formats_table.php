<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateDateTimeFormatsTable extends Migration {
	public function up()
	{
		Schema::create('date_time_formats', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
		});
	}
	public function down()
	{
		Schema::drop('date_time_formats');
	}
}
