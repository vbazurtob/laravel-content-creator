<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\User::class, 4)->create()->each(function($u) {

        $entries =  factory(App\Entry::class, 4)->make();


        foreach($entries as $e){
          $e->author = $u->id;

          //dd($e);
          $e->save();
                  // $u->entries()->save($e);
        }

        // dd($entries);

        // $u->entries()->save($entries);

        $u->save();

      });
    }
}
