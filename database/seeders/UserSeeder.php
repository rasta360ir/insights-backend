<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::connection('mysql2')
            ->select('SELECT * FROM users ORDER BY id ASC');

        foreach($users as $user) {
            DB::table('users')->insert([
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at,
                'password' => $user->password,
                'remember_token' => $user->remember_token,
                'phone' => $user->phone,
                'business' => $user->business,
                'position' => $user->position,
                'intention' => $user->intention,
                'google_id' => $user->google_id,
                'linkedin_id' => $user->linkedin_id,
                'avatar' => $user->image_url,
                'deleted_at' => $user->deleted_at,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]);
        }
    }
}
