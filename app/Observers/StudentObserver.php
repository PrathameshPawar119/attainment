<?php

namespace App\Observers;

use App\Events\StudentCreated;
use App\Models\StudentDetails;

class StudentObserver
{
    /**
     * Handle the StudentDetails "created" event.
     *
     * @param  \App\Models\StudentDetails  $studentDetails
     * @return void
     */
    public function created(StudentDetails $studentDetails)
    {
        $data = array('id'=>$studentDetails['id']);
        // Init student entries in all associative tables
        event(new StudentCreated($data));
    }

    /**
     * Handle the StudentDetails "updated" event.
     *
     * @param  \App\Models\StudentDetails  $studentDetails
     * @return void
     */
    public function updated(StudentDetails $studentDetails)
    {
        //
    }

    /**
     * Handle the StudentDetails "deleted" event.
     *
     * @param  \App\Models\StudentDetails  $studentDetails
     * @return void
     */
    public function deleted(StudentDetails $studentDetails)
    {
        //
    }

    /**
     * Handle the StudentDetails "restored" event.
     *
     * @param  \App\Models\StudentDetails  $studentDetails
     * @return void
     */
    public function restored(StudentDetails $studentDetails)
    {
        //
    }

    /**
     * Handle the StudentDetails "force deleted" event.
     *
     * @param  \App\Models\StudentDetails  $studentDetails
     * @return void
     */
    public function forceDeleted(StudentDetails $studentDetails)
    {
        //
    }
}
