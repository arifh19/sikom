<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin role
        $adminRole = new Role();
        $adminRole->name = "admin";
        $adminRole->display_name = "Admin";
        $adminRole->save();

        // Create Member role
        $memberRole = new Role();
        $memberRole->name = "member";
        $memberRole->display_name = "Member";
        $memberRole->save();
        
        // Create Member role
        // $dosenRole = new Role();
        // $dosenRole->name = "dosen";
        // $dosenRole->display_name = "Dosen";
        // $dosenRole->save();

        // Create Admin sample
        $admin = new User();
        $admin->name = 'Admin SIKOMATIK';
        $admin->email = 'komatik.wg@ugm.ac.id';
        $admin->password = bcrypt('rahasia');
        $admin->avatar = "admin_avatar.png";
        $admin->is_verified = 1;
        $admin->save();
        $admin->attachRole($adminRole);

        // Create Sample member
        $member = new User();
        $member->name = 'Sample Member';
        $member->email = 'member@gmail.com';
        $member->password = bcrypt('rahasia');
        $member->avatar = "member_avatar.png";
        $member->is_verified = 1;
        $member->save();
        $member->attachRole($memberRole);


    }
}
