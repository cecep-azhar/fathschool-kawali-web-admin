<?php

namespace App\Imports;

use App\Models\ExamMark;
use App\Models\ResultRule;
use App\Models\Subject;
use App\Models\UserProfile;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ExamMarkImport implements WithHeadingRow, ToModel
{
    // ToModel, WithStartRow, WithHeadingRow,
    public $exam_id;

    public function __construct($exam_id)
    {
        $this->exam_id = $exam_id;
    }

     public function model(array $row)
     {
         $user = UserProfile::where('student_id', 'LIKE', "%{$row['student_id']}%")->orWhere('student_id', $row['student_id'])->first() ?? null;

         if ($user && $this->exam_id) {
             $row_values = array_values($row);
             $row_keys = array_keys($row);

             foreach ($row_keys as $key => $row_key) {

                 if ($key > 0) {
                     $subject = Subject::where('name', 'LIKE', "%{$row_key}%")->orWhere('name', $row_key)->first();
                     $mark = $row_values[$key];

                     if ($subject && $mark) {
                         $result_rule = ResultRule::where('min_mark', '<=', $mark)->where('max_mark', '>=', $mark)->first();
                         // info($user['user_id'].' - '.$subject->name.' - '.$mark.' - '.$result_rule->gpa);
                         $check_mark_exists = ExamMark::where([
                             'user_id' => $user['user_id'],
                             'exam_id' => $this->exam_id,
                             'subject' => $subject->name,
                         ])->exists();

                         // $check_mark_exists = ExamMark::where(['user_id' => $user['user_id'], ['exam_id' => $this->exam_id], ['subject' => $subject->name]])->exists();
                         if (! $check_mark_exists) {
                             ExamMark::create([
                                 'user_id' => $user['user_id'],
                                 'exam_id' => $this->exam_id,
                                 'subject' => $subject->name ?? 'N/A',
                                 'grade' => $result_rule->gpa ?? 'N/A',
                                 'marks' => $mark,
                                 'grade_remarks' => $result_rule->grade_remark ?? 'N/A',
                             ]);
                         }
                     }
                 }
             }
         }

     }

    public function startRow(): int
    {
        return 2;
    }
}
