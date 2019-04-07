<?php

namespace App\Listeners;
use App\Models\Group;
use App\Models\Student;

use App\Events\GroupsGenerateEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GroupsGenerateListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  GroupsGenerateEvent  $event
     * @return void
     */
    public function handle(GroupsGenerateEvent $event)
    {
        
        $message = "";
        $description = $event->request->note;

        foreach( $event->departments as $department ){
           
            //making group
            \DB::transaction(function () use ($department, $description){

                $isGroupExist = Group::where('department_id', $department->id)
                                ->where('kankoor_year', $department->students[0]->kankor_year)->exists();

                if( !$isGroupExist ){

                    $group = Group::create([
                        'name' => "گروپ" . $department->name . ''. $department->faculty . '' . $department->students[0]->kankor_year,
                        'kankoor_year' => $department->students[0]->kankor_year,
                        'description' => $description,
                        'department_id' => $department->id,
                        'university_id' => $department->university->id
                    ]);

                    //updating student group

                    Student::where([
                        'department_id' => $department->id,
                        'kankor_year' =>  $department->students[0]->kankor_year,
                    ])->update(['group_id' => $group->id]);

                }
            });
        }

        return true;   
    }
}
