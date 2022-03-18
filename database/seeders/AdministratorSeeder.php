<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $administrator = new \App\Models\User;
        $administrator->username = "administrator";
        $administrator->name = "Site Administrator";
        $administrator->email = "administrator@larashop.test";
        $administrator->roles = json_encode(["ADMIN"]);
        $administrator->password = \Hash::make("12345");
        $administrator->avatar = "saat-ini-tidak-ada-file.png";
        $administrator->address = "Sumbang, Banyumas";

        $administrator->save();

        $this->command->info("User admin berhasil diinsert");
    }
}
