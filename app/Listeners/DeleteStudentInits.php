<?php

namespace App\Listeners;

use App\Events\StudentDeleted;
use App\Models\AssignmentModel;
use App\Models\Co_Total_Expt;
use App\Models\Co_Total_Ia;
use App\Models\EndsemModel;
use App\Models\ExperimentModel;
use App\Models\IaModel;
use App\Models\OralModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteStudentInits
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
     * @param  \App\Events\StudentDeleted  $event
     * @return void
     */
    public function handle(StudentDeleted $event)
    {
        $oral_record = OralModel::where("id", "=", $event->student['id'])->delete();
        $endsem_record = EndsemModel::where("id", "=", $event->student['id'])->delete();
        $assign_record = AssignmentModel::where("id", "=", $event->student['id'])->delete();
        $ia_record = IaModel::where("id", "=", $event->student['id'])->delete();
        $expt_record = ExperimentModel::where("id", "=", $event->student['id'])->delete();
        $co_ia_record = Co_Total_Ia::where("id", "=", $event->student['id'])->delete();
        $co_expt_record = Co_Total_Expt::where("id", "=", $event->student['id'])->delete();
    }
}
