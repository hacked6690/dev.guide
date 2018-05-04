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
       
       
        $user=factory(App\User::class,4000)->create()
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

            	});
       
        	
        
       
    }
}
