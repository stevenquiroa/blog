<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nadd = User::where('email','steven@nadd.co')->first();
        if (!$nadd) {
            $nadd = new User();
            $nadd->email = 'steven@nadd.co';
            $nadd->name = 'Steven Quiroa';
            $nadd->password = bcrypt('pantalon');
            $nadd->status = 'active';
            $nadd->save();  
        }
    }
}
