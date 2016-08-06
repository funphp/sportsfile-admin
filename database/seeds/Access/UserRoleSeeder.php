<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as Carbon;

class UserRoleSeeder extends Seeder {

	public function run() {

		if(env('DB_DRIVER') == 'mysql')
			DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		if(env('DB_DRIVER') == 'mysql')
			DB::table(config('access.assigned_roles_table'))->truncate();
		elseif(env('DB_DRIVER') == 'sqlite')
			DB::statement("DELETE FROM ".config('access.assigned_roles_table'));
		else //For PostgreSQL or anything else
			DB::statement("TRUNCATE TABLE ".config('access.assigned_roles_table')." CASCADE");

		//Attach admin role to admin user
		/*$user_model = config('auth.model');
		$user_model = new $user_model;
		$user_model::find(15635)->attachRole(1);
		*/
		$user_model = config('auth.model');
		$user = new $user_model;
		$user->name = 'Admin Istrator';
		$user->email = 'admin@admin.com';
		$user->password = bcrypt('1234');
		$user->confirmation_code =  md5(uniqid(mt_rand(), true));
		$user->confirmed = true;
		$user->created_at = Carbon::now();
		$user->updated_at = Carbon::now();
		$user->save();
		$user->attachRole(1);

		//Attach user role to general user
		$user1 = new $user_model;
		$user1->name = 'Default User';
		$user1->email = 'user@user.com';
		$user1->password = bcrypt('1234');
		$user1->confirmation_code =  md5(uniqid(mt_rand(), true));
		$user1->confirmed = true;
		$user1->created_at = Carbon::now();
		$user1->updated_at = Carbon::now();
		$user1->save();
		$user1->attachRole(2);
		/*$user_model = config('auth.model');
		$user_model = new $user_model;
		$user_model::find(15636)->attachRole(2);*/

		if(env('DB_DRIVER') == 'mysql')
			DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
