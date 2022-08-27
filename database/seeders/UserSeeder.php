<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'admin@example.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Administrator S.";
            $user->role = 'ADMIN';
            $user->agency = null;
            $user->email = 'admin@example.com';
            $user->password = Hash::make('adminpass');
            $user->save();
        }
//        ['การลงทะเบียน','อุปกรณ์ในห้องเรียน','สิ่งแวดล้อมในมหาวิทยาลัย','รถโดยสารภายในมหาวิทยาลัย','บุคลากร','อื่นๆ'];
        $user = User::where('email', 'staff@example.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Staff L.";
            $user->role = 'STAFF';
            $user->agency = "อื่นๆ";
            $user->email = 'staff@example.com';
            $user->password = Hash::make('staffpass');
            $user->save();
        }

        $user = User::where('email', 'rosesarin@example.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Rosesarin R.";
            $user->role = 'STAFF';
            $user->agency = "การลงทะเบียน";
            $user->email = 'rosesarin@example.com';
            $user->password = Hash::make('rosesarinpass');
            $user->save();
        }

        $user = User::where('email', 'chokchai@example.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Chokchai A.";
            $user->role = 'STAFF';
            $user->agency = "รถโดยสารภายในมหาวิทยาลัย";
            $user->email = 'chokchai@example.com';
            $user->password = Hash::make('chokchaipass');
            $user->save();
        }
        $user = User::where('email', 'somsri@example.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Somsri L.";
            $user->role = 'STAFF';
            $user->agency = "บุคลากร";
            $user->email = 'somsri@example.com';
            $user->password = Hash::make('somsripass');
            $user->save();
        }

        $user = User::where('email', 'jinda@example.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Jinda R.";
            $user->role = 'STAFF';
            $user->agency = "อุปกรณ์ในห้องเรียน";
            $user->email = 'jinda@example.com';
            $user->password = Hash::make('jindapass');
            $user->save();
        }

        $user = User::where('email', 'anan@example.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Anan A.";
            $user->role = 'STAFF';
            $user->agency = "สิ่งแวดล้อมในมหาวิทยาลัย";
            $user->email = 'anan@example.com';
            $user->password = Hash::make('ananpass');
            $user->save();
        }

        $user = User::where('email', 'user01@example.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "ยูสเซอร์ 01";
            $user->role = 'USER';
            $user->agency = null;
            $user->email = 'user01@example.com';
            $user->password = Hash::make('userpass');
            $user->save();
        }

        User::factory(5)->create();
    }
}
