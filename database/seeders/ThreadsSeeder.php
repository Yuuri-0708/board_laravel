<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ThreadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('threads')->insert([
            [
                'thread_name' => '今までで一番面白いアニメ挙げてけ', 
                'user_id' => 1,
                'show_count' => 3, 
                'created_at' => '2023-09-01 12:47', 
                'updated_at' => '2023-09-01 12:47',
            ], 
            [
                'thread_name' => '俺「おすすめは」店員「大切な方への贈り物ですか？」俺「あ、はい」　2月が誕生日の嫁の為にチョコレート買ったんだが…', 
                'user_id' => 1, 
                'show_count' => 10, 
                'created_at' => '2023-08-29 15:07', 
                'updated_at' => '2023-08-29 15:07',
            ], 
            [
                'thread_name' => '取引先の人に今度結婚するということで彼女を紹介されたんだが、なんか見た事あるなと思った', 
                'user_id' => 1, 
                'show_count' => 5, 
                'created_at' => '2023-07-23 12:07', 
                'updated_at' => '2023-07-23 12:07',
            ], 
        ]);
    }
}
