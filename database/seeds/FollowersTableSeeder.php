<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $users=User::all();
       $user=$users->first();
       $user_id=$user->id;

       //获取除了1号用户意外其他所有id数组
        $followers=$users->slice(1);
        $follower_ids=$followers->pluck('id')->toArray();

        //1号用户关注除了1号用户其他所有用户

        $user->follow($follower_ids);

        //除了1号用户，其他所有用户都来关注1号用户
        foreach ($followers as $follower){
            $follower->follow($user_id);
        }

    }
}
