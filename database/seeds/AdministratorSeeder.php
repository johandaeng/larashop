<?php

use Illuminate\Database\Seeder;
use App\User;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new User;
        $administrator->username = "administrator";
        $administrator->name = "Site Administrator";
        $administrator->email= "administrator@mail.com";
        $administrator->roles = json_encode(["ADMIN"]);
        $administrator->password = \Hash::make("larashop");
        $administrator->save();

        $this->command->info("User Admin berhasil diinsert");
    }
}
