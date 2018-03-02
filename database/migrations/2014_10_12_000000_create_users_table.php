<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('active')->default(0);
            $table->timestamps();
        });

        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('alias');
            $table->tinyInteger('active')->default(0);
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('active')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('group_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_users')->unsigned()->default(0);
            $table->foreign('id_users')->references('id')->on('users');
            $table->integer('id_groups')->unsigned()->default(0);
            $table->foreign('id_groups')->references('id')->on('groups');
            $table->timestamps();
        });

        Schema::create('area_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_users')->unsigned()->default(0);
            $table->foreign('id_users')->references('id')->on('users');
            $table->integer('id_areas')->unsigned()->default(0);
            $table->foreign('id_areas')->references('id')->on('areas');
            $table->timestamps();
        });

        DB::table('groups')->insert(array(
            'name' => 'admin',
            'active' => '1',
            'created_at' => DB::raw('now()'),
            'updated_at' => DB::raw('now()')
        ));

        DB::table('areas')->insert(array(
            'name' => 'all',
            'alias' => 'all',
            'active' => '1',
            'created_at' => DB::raw('now()'),
            'updated_at' => DB::raw('now()')
        ));

        DB::table('users')->insert(array(
            'name' => 'fianr5750',
            'email' => 'fianr5750@mail.com',
            'active' => '1',
            'password' => bcrypt('721355'),
            'created_at' => DB::raw('now()'),
            'updated_at' => DB::raw('now()')
        ));

        DB::table('group_users')->insert(array(
            'id_users' => '1',
            'id_groups' => '1',
            'created_at' => DB::raw('now()'),
            'updated_at' => DB::raw('now()')
        ));

        DB::table('area_users')->insert(array(
            'id_users' => '1',
            'id_areas' => '1',
            'created_at' => DB::raw('now()'),
            'updated_at' => DB::raw('now()')
        ));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
        Schema::dropIfExists('areas');
        Schema::dropIfExists('users');
        Schema::dropIfExists('group_users');
        Schema::dropIfExists('area_users');
    }
}
