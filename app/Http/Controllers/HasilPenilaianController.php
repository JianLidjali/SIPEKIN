<?php

namespace App\Http\Controllers;

use App\Models\Probation;
use App\Models\Promotion;
use App\Models\Performance;
use Illuminate\Http\Request;
use App\Models\Certification;
use App\Models\GeneralRating;
use App\Models\OverallRating;
use App\Models\AttitudeTowardsWork;
use App\Http\Controllers\Controller;
use App\Models\PerformanceAppraisal;
use PhpOffice\PhpWord\TemplateProcessor;

class HasilPenilaianController extends Controller
{
    public function index()
    {
        $appraisals = PerformanceAppraisal::whereIn('status', ['pending', 'Diisi oleh Karyawan', 'Diapprove oleh HOD', 'Diapprove oleh HRD', 'Diapprove oleh GM'])->get();

        return view('pages.hasil penilaian.index', compact('appraisals'));
    }
    public function cetak($id)
    {
        try {
            $appraisal = PerformanceAppraisal::findOrFail($id);



            $performance = Performance::where('performance_appraisal_id', $id)->first();
            $attitude = AttitudeTowardsWork::where('performance_appraisal_id', $id)->first();
            $overall = OverallRating::where('performance_appraisal_id', $id)->first();
            $general = GeneralRating::where('performance_appraisal_id', $id)->first();
            $certification = Certification::where('performance_appraisal_id', $id)->first();
            $probation = Probation::where('performance_appraisal_id', $id)->first();
            $promotion = Promotion::where('performance_appraisal_id', $id)->first();



            $date = now()->format('d F Y');
            //$totalPerformance = $performance->job_knowledge + $performance->quality_of_work + $performance->quantity_of_work + $performance->stability + $performance->communication + $performance->diplomacy + $performance->judgement + $performance->salesmanship + $performance->customer_relations + $performance->supervisory_skills;
            //$totalAttitude = $attitude->attitude_to_supervisor + $attitude->attitude_to_colleagues + $attitude->initiative + $attitude->attendance + $attitude->punctuality;


            if ($appraisal->type == 'For Annual') {
                $path = public_path('template/forAnnual.docx');
            } elseif ($appraisal->type == 'For Promotion Recommendation') {
                $path = public_path('template/forPromotion.docx');
            } elseif ($appraisal->type == 'For Probation') {
                $path = public_path('template/forProbation.docx');
            } else {
                return redirect()->back()->with('error', 'Template Tidak Ditemukan');
            };
            $templateProcessor = new TemplateProcessor($path);




            $data = [
                'nama' => $appraisal->employee->name,
                'staffIdentityCardNo' => $appraisal->employee->staffIdentityCardNo,
                'department' => $appraisal->employee->department,
                'position' => $appraisal->employee->position,
                'dateJoined' => date('d F Y', strtotime($appraisal->employee->dateJoined)),
                'dateInThePresentPosition' => date('d F Y', strtotime($appraisal->employee->dateInThePresentPosition)),


                'job_knowledge' => $appraisal->performance->job_knowledge ==  9 ? '✔' : ' ',
                'job_knowledge8' => $appraisal->performance->job_knowledge == 8 ? '✔' : ' ',
                'job_knowledge7' => $appraisal->performance->job_knowledge == 7 ? '✔' : ' ',
                'job_knowledge6' => $appraisal->performance->job_knowledge == 6 ? '✔' : ' ',
                'job_knowledge5' => $appraisal->performance->job_knowledge == 5 ? '✔' : ' ',
                'job_knowledge_remarks' => $appraisal->performance->job_knowledge_remarks,

                'quality_of_work' => $appraisal->performance->quality_of_work == 9 ? '✔' : ' ',
                'quality_of_work8' => $appraisal->performance->quality_of_work == 8 ? '✔' : ' ',
                'quality_of_work7' => $appraisal->performance->quality_of_work == 7 ? '✔' : ' ',
                'quality_of_work6' => $appraisal->performance->quality_of_work == 6 ? '✔' : ' ',
                'quality_of_work5' => $appraisal->performance->quality_of_work == 5 ? '✔' : ' ',
                'quality_of_work_remarks' => $appraisal->performance->quality_of_work_remarks,

                'quantity_of_work' => $appraisal->performance->quantity_of_work == 9 ? '✔' : ' ',
                'quantity_of_work8' => $appraisal->performance->quantity_of_work == 8 ? '✔' : ' ',
                'quantity_of_work7' => $appraisal->performance->quantity_of_work == 7 ? '✔' : ' ',
                'quantity_of_work6' => $appraisal->performance->quantity_of_work == 6 ? '✔' : ' ',
                'quantity_of_work5' => $appraisal->performance->quantity_of_work == 5 ? '✔' : ' ',
                'quantity_of_work_remarks' => $appraisal->performance->quantity_of_work_remarks,

                'stability' => $appraisal->performance->stability == 9 ? '✔' : ' ',
                'stability8' => $appraisal->performance->stability == 8 ? '✔' : ' ',
                'stability7' => $appraisal->performance->stability == 7 ? '✔' : ' ',
                'stability6' => $appraisal->performance->stability == 6 ? '✔' : ' ',
                'stability5' => $appraisal->performance->stability == 5 ? '✔' : ' ',
                'stability_remarks' => $appraisal->performance->stability_remarks,

                'communication' => $appraisal->performance->communication == 9 ? '✔' : ' ',
                'communication8' => $appraisal->performance->communication == 8 ? '✔' : ' ',
                'communication7' => $appraisal->performance->communication == 7 ? '✔' : ' ',
                'communication6' => $appraisal->performance->communication == 6 ? '✔' : ' ',
                'communication5' => $appraisal->performance->communication == 5 ? '✔' : ' ',
                'communication_remarks' => $appraisal->performance->communication_remarks,

                'diplomacy' => $appraisal->performance->diplomacy == 9 ? '✔' : ' ',
                'diplomacy8' => $appraisal->performance->diplomacy == 8 ? '✔' : ' ',
                'diplomacy7' => $appraisal->performance->diplomacy == 7 ? '✔' : ' ',
                'diplomacy6' => $appraisal->performance->diplomacy == 6 ? '✔' : ' ',
                'diplomacy5' => $appraisal->performance->diplomacy == 5 ? '✔' : ' ',
                'diplomacy_remarks' => $appraisal->performance->diplomacy_remarks,

                'judgement' => $appraisal->performance->judgement == 9 ? '✔' : ' ',
                'judgement8' => $appraisal->performance->judgement == 8 ? '✔' : ' ',
                'judgement7' => $appraisal->performance->judgement == 7 ? '✔' : ' ',
                'judgement6' => $appraisal->performance->judgement == 6 ? '✔' : ' ',
                'judgement5' => $appraisal->performance->judgement == 5 ? '✔' : ' ',
                'judgement_remarks' => $appraisal->performance->judgement_remarks,

                'salesmanship' => $appraisal->performance->salesmanship == 9 ? '✔' : ' ',
                'salesmanship8' => $appraisal->performance->salesmanship == 8 ? '✔' : ' ',
                'salesmanship7' => $appraisal->performance->salesmanship == 7 ? '✔' : ' ',
                'salesmanship6' => $appraisal->performance->salesmanship == 6 ? '✔' : ' ',
                'salesmanship5' => $appraisal->performance->salesmanship == 5 ? '✔' : ' ',
                'salesmanship_remarks' => $appraisal->performance->salesmanship_remarks,

                'customer_relations' => $appraisal->performance->customer_relations == 9 ? '✔' : ' ',
                'customer_relations8' => $appraisal->performance->customer_relations == 8 ? '✔' : ' ',
                'customer_relations7' => $appraisal->performance->customer_relations == 7 ? '✔' : ' ',
                'customer_relations6' => $appraisal->performance->customer_relations == 6 ? '✔' : ' ',
                'customer_relations5' => $appraisal->performance->customer_relations == 5 ? '✔' : ' ',
                'customer_relations_remarks' => $appraisal->performance->customer_relations_remarks,

                'supervisory_skills' => $appraisal->performance->supervisory_skills == 9 ? '✔' : ' ',
                'supervisory_skills8' => $appraisal->performance->supervisory_skills == 8 ? '✔' : ' ',
                'supervisory_skills7' => $appraisal->performance->supervisory_skills == 7 ? '✔' : ' ',
                'supervisory_skills6' => $appraisal->performance->supervisory_skills == 6 ? '✔' : ' ',
                'supervisory_skills5' => $appraisal->performance->supervisory_skills == 5 ? '✔' : ' ',
                'supervisory_skills_remarks' => $appraisal->performance->supervisory_skills_remarks,

                'attitude_to_supervisor' => $appraisal->attitudeTowardsWork->attitude_to_supervisor == 9 ? '✔' : ' ',
                'attitude_to_supervisor8' => $appraisal->attitudeTowardsWork->attitude_to_supervisor == 8 ? '✔' : ' ',
                'attitude_to_supervisor7' => $appraisal->attitudeTowardsWork->attitude_to_supervisor == 7 ? '✔' : ' ',
                'attitude_to_supervisor6' => $appraisal->attitudeTowardsWork->attitude_to_supervisor == 6 ? '✔' : ' ',
                'attitude_to_supervisor5' => $appraisal->attitudeTowardsWork->attitude_to_supervisor == 5 ? '✔' : ' ',
                'attitude_to_supervisor_remarks' => $appraisal->attitudeTowardsWork->attitude_to_supervisor_remarks,

                'attitude_to_colleagues' => $appraisal->attitudeTowardsWork->attitude_to_colleagues == 9 ? '✔' : ' ',
                'attitude_to_colleagues8' => $appraisal->attitudeTowardsWork->attitude_to_colleagues == 8 ? '✔' : ' ',
                'attitude_to_colleagues7' => $appraisal->attitudeTowardsWork->attitude_to_colleagues == 7 ? '✔' : ' ',
                'attitude_to_colleagues6' => $appraisal->attitudeTowardsWork->attitude_to_colleagues == 6 ? '✔' : ' ',
                'attitude_to_colleagues5' => $appraisal->attitudeTowardsWork->attitude_to_colleagues == 5 ? '✔' : ' ',
                'attitude_to_colleagues_remarks' => $appraisal->attitudeTowardsWork->attitude_to_colleagues_remarks,

                'initiative' => $appraisal->attitudeTowardsWork->initiative == 9 ? '✔' : ' ',
                'initiative8' => $appraisal->attitudeTowardsWork->initiative == 8 ? '✔' : ' ',
                'initiative7' => $appraisal->attitudeTowardsWork->initiative == 7 ? '✔' : ' ',
                'initiative6' => $appraisal->attitudeTowardsWork->initiative == 6 ? '✔' : ' ',
                'initiative5' => $appraisal->attitudeTowardsWork->initiative == 5 ? '✔' : ' ',
                'initiative_remarks' => $appraisal->attitudeTowardsWork->initiative_remarks,

                'attendance' => $appraisal->attitudeTowardsWork->attendance == 9 ? '✔' : ' ',
                'attendance8' => $appraisal->attitudeTowardsWork->attendance == 8 ? '✔' : ' ',
                'attendance7' => $appraisal->attitudeTowardsWork->attendance == 7 ? '✔' : ' ',
                'attendance6' => $appraisal->attitudeTowardsWork->attendance == 6 ? '✔' : ' ',
                'attendance5' => $appraisal->attitudeTowardsWork->attendance == 5 ? '✔' : ' ',
                'attendance_remarks' => $appraisal->attitudeTowardsWork->attendance_remarks,

                'punctuality' => $appraisal->attitudeTowardsWork->punctuality == 9 ? '✔' : ' ',
                'punctuality8' => $appraisal->attitudeTowardsWork->punctuality == 8 ? '✔' : ' ',
                'punctuality7' => $appraisal->attitudeTowardsWork->punctuality == 7 ? '✔' : ' ',
                'punctuality6' => $appraisal->attitudeTowardsWork->punctuality == 6 ? '✔' : ' ',
                'punctuality5' => $appraisal->attitudeTowardsWork->punctuality == 5 ? '✔' : ' ',
                'punctuality_remarks' => $appraisal->attitudeTowardsWork->punctuality_remarks,

                'overall_rating' => $appraisal->overallRating->overall_rating ?? '',

                'strengths' => $appraisal->generalRating->strengths ?? '',
                'weaknesses' => $appraisal->generalRating->weakness ?? '',
                'suggestions' => $appraisal->generalRating->suggestions ?? '',
                'promotability' => $appraisal->generalRating->promotability == 'promotable_now' ? '✔' : ' ',
                'promotability2' => $appraisal->generalRating->promotability == 'promotable_1_2_years' ? '✔' : ' ',
                'promotability3' => $appraisal->generalRating->promotability == 'limited_to_current_position' ? '✔' : ' ',
                'promotable_now_position' => $appraisal->generalRating->promotable_now_position ?? '',
                'promotable_now_successor' => $appraisal->generalRating->promotable_now_successors ?? '',
                'promotable_1_2_years_position' => $appraisal->generalRating->promotable_1_2_years_position ?? '',
                'promotable_1_2_years_successor' => $appraisal->generalRating->promotable_1_2_years_successors ?? '',


                'staff_suggestion' => $appraisal->certification->staff_suggestion ?? '',

                'confirmed_date' => $appraisal->probation ? date('d F Y', strtotime($appraisal->probation->confirmed_date)) : '',
                'extension_from' => $appraisal->probation ? date('d F Y', strtotime($appraisal->probation->extension_from)) : '',
                'extension_reason' => $appraisal->probation->extension_reason ?? '',
                'termination_date' => $appraisal->probation ? date('d F Y', strtotime($appraisal->probation->termination_date)) : '',
                'termination_reason' => $appraisal->probation->termination_reason ?? '',

                'new_position' => $appraisal->promotion->new_position ?? '',
                'level' => $appraisal->promotion->level ?? '',
                'present_salary' => $appraisal->promotion->present_salary ?? '',
                'proposed_salary' => $appraisal->promotion->proposed_salary ?? '',
                'date_of_promotion' => $appraisal->promotion ? date('d F Y', strtotime($appraisal->promotion->date_of_promotion)) : '',
                'additional_comments' => $appraisal->promotion->additional_comments ?? '',


                'date' => date('d F Y'),


            ];

            foreach ($data as $placeholder => $value) {
                $templateProcessor->setValue($placeholder, $value);
            }
            // Save the modified document
            $newFilePath = public_path('doc/Performance Appraisal Report ' . $appraisal->employee->name . ' ' . $appraisal->type . '.docx');
            $templateProcessor->saveAs($newFilePath);

            return response()->download($newFilePath);
        } catch (\Exception $e) {
            return dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
