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
use Illuminate\Validation\Rule;

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
        // $duplicate_grp = StudentDetails::where('group_key','=', $group_key)->groupBy('id')->count();        

        return new StudentDetails([
            'roll_no' => $row['roll_no'] ?? $row['RN'] ?? $row['Roll Number'] ?? $row['Roll no.'] ?? $row['Roll'] ?? null,
            'student_id' => $row['student_id'] ?? $row['Stu.ID.'] ?? $row['Student ID'] ?? null,
            'div' => $row['div'] ?? $row['DIV'] ?? $row['Div'] ?? null,
            'name' => $row['name'] ?? $row['Name'] ?? $row['Name of Student'] ?? $row['Student Name'] ?? null,
            'gender' => $row['gender'] ?? $row['Gender'] ?? $row['M/F'] ?? $row['sex'] ?? $row['SEX'] ?? null,
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
                Rule::unique('student_details', 'student_id')->where(function ($query) {
                    return $query->where('user_key', session()->get("user_id"));
                })
            ],
            'div' =>[
                'required',
                'in:'.current($divs).','.next($divs).','.next($divs).','.next($divs)
            ],
            'roll_no' =>[
                'required',
                'integer',
                Rule::unique('student_details', 'roll_no')->where(function ($query){
                    return $query->where("user_key", session()->get("user_id"));
                })
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
