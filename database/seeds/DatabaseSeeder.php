<?php

use Illuminate\Database\Seeder;
use App\UserMetas;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
       
       
       /* $user=factory(App\User::class,4000)->create()
        	 ->each(function ($u) {
        	 		 $default = array('license_id','fullname_en', 'fullname_kh','address',
		            'dob', 'gender','telephone',
		            'nationality', 'province','password',
		            'generation', 'guide_certified','behavior_certified',
		            'id_card', 'partner_id','cv_provided',
		            'first_name', 'last_name','first_name_kh','guide_type_id',
		            'domicile_certified','new_renew','issued_date','expired_date',
		            'date_in_service','profile'
		            );
        	 			for($i=0;$i<sizeof($default);$i++){
	                        $user_meta = new UserMetas([
		                        'user_id' => $u->id,
		                        'meta_key' => $default[$i],
		                        'meta_value' => 'TEST'.$default[$i].time().'METAVALUE'
		                    ]);
	                		$user_meta->save();
                		}

            	});*/
        
       $user=factory(App\User::class,10000)->create()
             ->each(function ($u) {
                    $faker = Faker\Factory::create();
                    $default=[];
                    $default[] = array('user_id' => $u->id,"meta_key"=>"role_id","meta_value"=>7);
                     $default[] = array('user_id' => $u->id,"meta_key"=>"license_id","meta_value"=>"TG".rand(1,9)."8".rand(2000,9999));
                     $default[] = array('user_id' => $u->id,"meta_key"=>"fullname_en","meta_value"=>$faker->name);
                     $default[] = array('user_id' => $u->id,"meta_key"=>"fullname_kh","meta_value"=>$faker->name);
                     $default[] = array('user_id' => $u->id,"meta_key"=>"address","meta_value"=>$faker->address);
                     $default[] = array('user_id' => $u->id,"meta_key"=>"dob","meta_value"=>$faker->date);
                      $default[] = array('user_id' => $u->id,"meta_key"=>"gender","meta_value"=>rand(67,68));
                     $default[] = array('user_id' => $u->id,"meta_key"=>"telephone","meta_value"=>$faker->phoneNumber);
                     $default[] = array('user_id' => $u->id,"meta_key"=>"nationality_id","meta_value"=> rand(56,57));
                     $default[] = array('user_id' => $u->id,"meta_key"=>"province_id","meta_value"=>rand(58,59));
                     $default[] = array('user_id' => $u->id,"meta_key"=>"language_id","meta_value"=>rand(65,66));
                     $default[] = array('user_id' => $u->id,"meta_key"=>"guide_price","meta_value"=>rand(50,100));
                     $default[] = array('user_id' => $u->id,"meta_key"=>"password","meta_value"=>$faker->password);
                     $default[] = array('user_id' => $u->id,"meta_key"=>"generation","meta_value"=>rand(1,10));
                     $default[] = array('user_id' => $u->id,"meta_key"=>"guide_certified","meta_value"=>rand(0,1));
                     $default[] = array('user_id' => $u->id,"meta_key"=>"behavior_certified","meta_value"=>rand(0,1));
                     $default[] = array('user_id' => $u->id,"meta_key"=>"id_card","meta_value"=>"TG2145687");
                     $default[] = array('user_id' => $u->id,"meta_key"=>"partner_id","meta_value"=>rand(60,61));
                     $default[] = array('user_id' => $u->id,"meta_key"=>"cv_provided","meta_value"=>rand(0,1));
                     $default[] = array('user_id' => $u->id,"meta_key"=>"first_name","meta_value"=>$faker->name);
                     $default[] = array('user_id' => $u->id,"meta_key"=>"last_name","meta_value"=>$faker->name);
                     $default[] = array('user_id' => $u->id,"meta_key"=>"first_name_kh","meta_value"=>$faker->name);
                     $default[] = array('user_id' => $u->id,"meta_key"=>"guide_type_id","meta_value"=>rand(62,64));
                     $default[] = array('user_id' => $u->id,"meta_key"=>"domicile_certified","meta_value"=>rand(0,1));
                     $default[] = array('user_id' => $u->id,"meta_key"=>"new_renew","meta_value"=>rand(0,1));
                     $default[] = array('user_id' => $u->id,"meta_key"=>"issued_date","meta_value"=>$faker->date);
                     $default[] = array('user_id' => $u->id,"meta_key"=>"expired_date","meta_value"=>$faker->date);
                     $default[] = array('user_id' => $u->id,"meta_key"=>"date_in_service","meta_value"=>$faker->date);
                    $default[] = array('user_id' => $u->id,"meta_key"=>"photo","meta_value"=>rand(1,10).".jpg");

                     
                        for($i=0;$i<sizeof($default);$i++){
                            $user_meta = new UserMetas($default[$i]);
                            $user_meta->save();
                        }

                });
        	
        
       
    }
}
