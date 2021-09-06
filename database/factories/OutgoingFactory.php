<?php

namespace Database\Factories;

use App\Models\Outgoing;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class OutgoingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Outgoing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $user = rand(2,5);
        $destination = DB::table('sender_destinations')->where('department_id',$user)->pluck('id')->toArray();
        $index = array_rand($destination);
        $category = DB::table('category')->where('department_id',$user)->pluck('id')->toArray();
        $i = array_rand($category);

        return [
            'file_no'           =>Str::random(10),
            'dispatched_no'     =>rand(1000,2000),
            'dispatched_date'   =>date_create(rand(2000,2021)."-".rand(1,12)."-".rand(1,30)),
            'year'              =>rand(2000,2021),
            'destination_id'       =>$destination[$index],
            'subject'           =>Str::random(40),
            'status'            =>'Pending',
            'entered_by'        =>$user,
            'department_id'     =>$user,
            'mode'              =>'Post',
            'urgency'           =>'Urgent',
            'remarks'           =>Str::random(4).Str::random(12).Str::random(8).Str::random(4).Str::random(10),
            'category_id'       => $category[$i],
        ];
    }
}
