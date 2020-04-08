<?php

use Illuminate\Database\Seeder;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // first メソッドでユーザーを一行だけ取得して、その ID を user_id の値に指定
        $user = DB::table('users')->first();

        $titles = ['プライベート', '仕事', '旅行'];

        foreach ($titles as $title) {
            DB::table('folders')->insert([
                'title' => $title,
                'user_id' => $user->id,
                'created_at' => '2020-04-03',
                'updated_at' => '2020-04-03',
            ]);
        }
    }
}
