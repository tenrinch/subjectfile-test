<?php

namespace Database\Factories;

use App\Models\Incoming;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\SenderDestination;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class IncomingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Incoming::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $user = rand(2,5);
        $sender = DB::table('sender_destinations')->where('department_id',$user)->pluck('id')->toArray();
        $index = array_rand($sender);
        $category = DB::table('category')->where('department_id',$user)->pluck('id')->toArray();
        $i = array_rand($category);

        return [
            'incoming_no'       =>rand(1,100),
            'file_no'           =>Str::random(10),
            'dispatched_no'     =>rand(1000,2000),
            'received_date'     =>date_create(rand(2000,2021)."-".rand(1,12)."-".rand(1,30)),
            'year'              =>rand(2000,2021),
            'sender'            =>$sender[$index],
            'subject'           =>Str::random(40),
            'status'            =>'Pending',
            'entered_by'        =>$user,
            'department_id'     =>$user,
            'mode'              =>'Post',
            'urgency'           =>'Urgent',
            'category_id'       =>$category[$i],
        ];
    }
}
