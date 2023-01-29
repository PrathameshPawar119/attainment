<?php

namespace App\Listeners;

use App\Events\StudentCreated;
use App\Models\AssignmentModel;
use App\Models\Co_Total_Expt;
use App\Models\Co_Total_Ia;
use App\Models\EndsemModel;
use App\Models\ExperimentModel;
use App\Models\IaModel;
use App\Models\OralModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InitStudentTables
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
     * @param  \App\Events\StudentCreated  $event
     * @return void
     */
    public function handle(StudentCreated $event)
    {
        // here all data is encpsulated inside $event
        // init oral entry
            $oral_tuple = new OralModel();
            $oral_tuple->oral_marks = 0;
            $oral_tuple->id = $event->student['id'];
            $oral_tuple->save();

        //init endsem entry
            $endsem_tuple = new EndsemModel();
            $endsem_tuple->endsem_mark = 0;
            $endsem_tuple->id = $event->student['id'];
            $endsem_tuple->save();
            
        //init assignments entry
            $assign_tuple = new  AssignmentModel();
            $assign_tuple->id = $event->student['id'];
            $assign_tuple->save();

        // init ia entry
            $ia_tuple = new IaModel();
            $ia_tuple->id = $event->student['id'];
            $ia_tuple->save();

        // init experiments entry
            $expt_tuple = new ExperimentModel();
            $expt_tuple->id = $event->student['id'];
            $expt_tuple->save();

        // init co_total_ia table
            $co_ia_tuple = new Co_Total_Ia();
            $co_ia_tuple->id = $event->student['id'];
            $co_ia_tuple->save();
        // init co_total_expt_ table
            $co_expt_table = new Co_Total_Expt();
            $co_expt_table->id =  $event->student['id'];
            $co_expt_table->save();
    }
}
