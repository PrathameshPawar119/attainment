<?php

namespace App\Imports;

use App\Events\StudentCreated;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\StudentDetails;

class StudentsImport implements ToModel, SkipsOnFailure, WithValidation, WithHeadingRow
{
    use Importable, SkipsFailures;

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        //stu.id = 0, div = 1, roll = 2, name = 3, gender = 4
        // Group key is composite of roll_no + div + user_key
        // it will be useful to avoid duplictate entries for per user pre div
        $group_key = strval($row['roll_no'])."-".strval($row['div'])."-".strval(session()->get('user_id'));
        // $duplicate = StudentDetails::where('group_key','=', $group_key)->get();
        

        return new StudentDetails([
            'roll_no' => $row['roll_no'],
            'student_id' => $row['student_id'],
            'div' => $row['div'],
            'name' => $row['name'],
            'gender' => $row['gender'],
            'user_key' => session()->get('user_id'),
            'group_key' => $group_key
        ]);
    }

    public function onFailure(Failure ...$failures)
    {
        // Handle the failures how you'd like.
    }

    public function rules(): array
    {
        $divs = StudentDetails::Divs;
        $genders = StudentDetails::Genders;

        return [
            'student_id'  =>[
                'required',
                'string',
                'unique:student_details'
            ],
            'div' =>[
                'required',
                'in:'.current($divs).','.next($divs).','.next($divs).','.next($divs)
            ],
            'roll_no' =>[
                'required',
                'integer'
            ],
            'name' => [
                'required',
                'string',
            ],
            'gender' =>[
                'required',
                'in:'.current($genders).','.next($genders).','.next($genders).','.next($genders)
            ],

        ];
    }

}
