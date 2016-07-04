<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use App\AdminRoles;
class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('admin_users')->delete();
		$faker = Faker::create();

        $adminRole = AdminRoles::orderByRaw("RAND()")->first();
        foreach (range(1,1000) as $index) {
	        DB::table('admin_users')->insert([
	            'role_id' => $adminRole->id,
	            'email' => $faker->email,
	            'name' => $faker->name,
	            'password' => bcrypt('123123123'),
	            'created_at'	=> $faker->dateTime($max = 'now')
	        ]);
	    }
    }
}
