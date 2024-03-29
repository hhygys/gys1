<?php
class CreateRecordsTable extends Migration{
    public function up(){
        Schema::create('records',function (Blueprint $table){
            $table->increments('id');
            //$table->string('username',30);
            $table->string('email',60);
            //$table->string('password',100);
            $table->string('ip',20);
            $table->tinyInteger('q1')->default(1);
            $table->tinyInteger('q21')->default(0);
            $table->tinyInteger('q22')->default(0);
            $table->tinyInteger('q23')->default(0);
            $table->tinyInteger('q24')->default(0);
            $table->tinyInteger('q25')->default(0);
            //$table->string('remember_token',100)->default(NULL)->nulltable();
            $table->timestamps();
        });
    }
    public function down(){
        Schema::drop('users');
    }
}
