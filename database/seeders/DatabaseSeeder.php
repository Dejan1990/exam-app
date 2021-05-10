<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $admin = new User();
    	$admin->name="admin";
    	$admin->email="admin@mail.com";
    	$admin->password =  Hash::make('password');
    	$admin->email_verified_at = NOW();
    	$admin->occupation="CEO";
    	$admin->address="Australia";
    	$admin->phone="03453494";
    	$admin->is_admin=1;
    	$admin->save();
    }
}
