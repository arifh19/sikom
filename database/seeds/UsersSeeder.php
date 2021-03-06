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
        $memberRole->display_name = "Mahasiswa";
        $memberRole->save();

        // Create Dosen role
        $dosenRole = new Role();
        $dosenRole->name = "dosen";
        $dosenRole->display_name = "Dosen";
        $dosenRole->save();

        // Create Staff role
        $staffRole = new Role();
        $staffRole->name = "staff";
        $staffRole->display_name = "Staff";
        $staffRole->save();
    

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
        $member->name = 'Mahasiswa Member';
        $member->email = 'member@gmail.com';
        $member->password = bcrypt('rahasia');
        $member->avatar = "member_avatar.png";
        $member->is_verified = 1;
        $member->save();
        $member->attachRole($memberRole);

        // Create Sample Dosen
        $member = new User();
        $member->name = 'Dosen';
        $member->email = 'dosen@gmail.com';
        $member->password = bcrypt('rahasia');
        $member->avatar = "member_avatar.png";
        $member->is_verified = 1;
        $member->save();
        $member->attachRole($dosenRole);

        // Create Sample Staff
        $member = new User();
        $member->name = 'Staff';
        $member->email = 'staff@gmail.com';
        $member->password = bcrypt('rahasia');
        $member->avatar = "member_avatar.png";
        $member->is_verified = 1;
        $member->save();
        $member->attachRole($staffRole);


    }
}
