<?php

use App\Address;
use App\Category;
use App\Establishment;
use App\Owner;
use App\User;
use Artesaos\Defender\Role;
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
        factory(User::class, 1)->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt(123456),
        ])->each(function(User $user){
            $user->roles()->save(factory(Role::class)->make());
            $user->establishment()->save(factory(Establishment::class)->make());
            $user->establishment()->each(function(Establishment $establishment){
                $establishment->categories()->createMany(factory(Category::class,2)->make()->toArray());
            });
        });

        factory(User::class, 1)->create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt(123456),
        ])->each(function(User $u){
            $u->address()->save(factory(Address::class)->make(['number' => '3333333']));
            $u->roles()->save(factory(Role::class)->make(['name' => 'User']));
        });

        factory(User::class,9)->create()->each(function(User $user){
            $user->address()->save(factory(Address::class)->make());
            $role = Role::findOrFail(2);
            $user->roles()->save($role);
        });

        factory(User::class,9)->create()->each(function(User $user){
            $role = Role::findOrFail(1);
            $user->roles()->save($role);
            $user->establishment()->save(factory(Establishment::class)->make());
            $user->establishment()->each(function(Establishment $establishment){
                $establishment->categories()->createMany(factory(Category::class,2)->make()->toArray());
            });
        });
    }
}
