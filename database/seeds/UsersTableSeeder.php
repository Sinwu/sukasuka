<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
		'id' => 'fe472637-66a1-40f6-847f-d91d309da6ae',
		'name' => 'Administrator',
		'email' => 'admin.ediish@edi-indonesia.co.id',
		'password' => bycrypt('EdiiSocialHub2017!'),
		'birthday' => '1991-11-11 00:00:00',
		'active' => 1,
		'admin' => 1,
		'corporate' => 1,
		'created_at' => '1991-11-11 00:00:00',
		'updated_at' => '1991-11-11 00:00:00'
	]);
    }
}
