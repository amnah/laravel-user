<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class SetupLaravelUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
        list ($reminderTable, $roleTable, $userTable, $profileTable) = $this->_getTables();

        /*
		Schema::create($reminderTable, function(Blueprint $table)
		{
            $table->increments('id');
			$table->string('email');
			$table->string('token');
            $table->index("token");
			$table->timestamp('created_at');
		});
        */

        Schema::create($roleTable, function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('admin');
            $table->timestamps();
        });

        Schema::create($userTable, function(Blueprint $table) use ($roleTable) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on($roleTable)->onDelete('cascade')->onUpdate('cascade');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->boolean('status')->default(0);
            $table->string('token')->nullable()->default(null);
            $table->timestamp('banned_at')->nullable()->default(null);
            $table->string('ban_reason')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create($profileTable, function(Blueprint $table) use ($userTable) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on($userTable)->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->string('first_name');
            $table->string('last_name');
        });

        // create initial roles
        DB::table($roleTable)->insert(array(
            array('name' => 'Admin', 'can_admin' => 1),
            array('name' => 'User', 'can_admin' => 0),
        ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        list ($reminderTable, $roleTable, $userTable, $profileTable) = $this->_getTables();

        Schema::drop($profileTable);
        Schema::drop($userTable);
        Schema::drop($roleTable);
//        Schema::drop($reminderTable);
	}

    protected function _getTables() {

        return array(
            Config::get("auth.reminder.table"),
            Config::get("auth.roleTable"),
            Config::get("auth.table"),
            Config::get("auth.profileTable"),
        );
    }

}
