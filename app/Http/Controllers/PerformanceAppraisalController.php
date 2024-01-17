<?php

namespace App\Http\Controllers;

use App\Models\Employee;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Requests\StoreAnnualApprasial;
use App\Http\Requests\StoreProbationAppraisal;
use App\Http\Requests\StoreRecommendationApraisal;
use App\Http\Requests\UpdateRecommendationApraisal;
use App\Http\Requests\UpdateAnnualApraisalCertification;
use App\Http\Requests\UpdateProbationAppraisalProbation;

class PerformanceAppraisalController extends Controller
{
    public function index()
    {
        $data = employee::orderBy('department')->get();
        return view('pages.Performance Appraisal.annual.index', compact('data'));
    }
    public function show($id)
    {
        $data = PerformanceAppraisal::where('id', $id)->first();
        $employee = Employee::where('uuid', $data->employee_uuid)->first();
        $performance = Performance::where('performance_appraisal_id', $data->id)->latest()->first();
        $attitudeTowardsWork = AttitudeTowardsWork::where('performance_appraisal_id', $data->id)->latest()->first();
        $overallRating = OverallRating::where('performance_appraisal_id', $data->id)->latest()->first();
        $generalRating = GeneralRating::where('performance_appraisal_id', $data->id)->latest()->first();
        $certification = Certification::where('performance_appraisal_id', $data->id)->latest()->first();
        $probation = Probation::where('performance_appraisal_id', $data->id)->latest()->first();
        $promotion = Promotion::where('performance_appraisal_id', $data->id)->latest()->first();

        return view('pages.Performance Appraisal.show', compact('employee', 'data', 'performance', 'attitudeTowardsWork', 'overallRating', 'generalRating', 'certification', 'probation', 'promotion'));
    }
    public function form(Employee $employee)
    {
        return view('pages.Performance Appraisal.annual.hod.index', compact('employee'));
    }

    public function store(StoreAnnualApprasial $request, Employee $employee)
    {
        try {
            $performanceAppraisal = new PerformanceAppraisal([
                'employee_id' => $employee->id,
                'employee_uuid' => $request->employee_uuid,
                'date' => now(),
                'type' => 'For Annual',
                'status' => 'pending',
            ]);
            $performanceAppraisal->save();

            $performance = new Performance([
                'performance_appraisal_id' => $performanceAppraisal->id,
                'job_knowledge' => $request->job_knowledge,
                'job_knowledge_remarks' => $request->job_knowledge_remarks,
                'quality_of_work' => $request->quality_of_work,
                'quality_of_work_remarks' => $request->quality_of_work_remarks,
                'quantity_of_work' => $request->quantity_of_work,
                'quantity_of_work_remarks' => $request->quantity_of_work_remarks,
                'stability' => $request->stability,
                'stability_remarks' => $request->stability_remarks,
                'communication' => $request->communication,
                'communication_remarks' => $request->communication_remarks,
                'diplomacy' => $request->diplomacy,
                'diplomacy_remarks' => $request->diplomacy_remarks,
                'judgement' => $request->judgement,
                'judgement_remarks' => $request->judgement_remarks,
                'salesmanship' => $request->salesmanship,
                'salesmanship_remarks' => $request->salesmanship_remarks,
                'customer_relations' => $request->customer_relations,
                'customer_relations_remarks' => $request->customer_relations_remarks,
                'supervisory_skills' => $request->supervisory_skills,
                'supervisory_skills_remarks' => $request->supervisory_skills_remarks
            ]);
            $performance->save();

            $attitudeTowardsWork = new AttitudeTowardsWork([
                'performance_appraisal_id' => $performanceAppraisal->id,
                'attitude_to_supervisor' => $request->attitude_to_supervisor,
                'attitude_to_supervisor_remarks' => $request->attitude_to_supervisor_remarks,
                'attitude_to_colleagues' => $request->attitude_to_colleagues,
                'attitude_to_colleagues_remarks' => $request->attitude_to_colleagues_remarks,
                'initiative' => $request->initiative,
                'initiative_remarks' => $request->initiative_remarks,
                'attendance' => $request->attendance,
                'attendance_remarks' => $request->attendance_remarks,
                'punctuality' => $request->punctuality,
                'punctuality_remarks' => $request->punctuality_remarks,
            ]);
            $attitudeTowardsWork->save();

            $overallRating = new OverallRating([
                'performance_appraisal_id' => $performanceAppraisal->id,
                'overall_rating' => $request->overall_rating,
            ]);
            $overallRating->save();

            $generalRating = new GeneralRating([
                'performance_appraisal_id' => $performanceAppraisal->id,
                'strengths' => $request->strengths,
                'weakness' => $request->weakness,
                'suggestions' => $request->suggestions,
                'promotability' => $request->promotability,
                'promotable_now_position' => $request->promotable_now_position,
                'promotable_now_successor' => $request->promotable_now_successor,
                'promotable_1_2_years_position' => $request->promotable_1_2_years_position,
                'promotable_1_2_years_successor' => $request->promotable_1_2_years_successor,
                'capability_limited_to_current_position' => $request->capability_limited_to_current_position,
            ]);
            $generalRating->save();
            $certification = new Certification([
                'performance_appraisal_id' => $performanceAppraisal->id,
                'staff_suggestion' => $request->staff_suggestion,
            ]);
            $certification->save();

            return redirect()->route('performance-appraisal.index')->with('success', 'Data created successfully');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function update(UpdateAnnualApraisalCertification $request, Employee $employee)
    {
        if (Auth::user()->role == 'Karyawan' && Auth::user()->employee_id == $employee->uuid) {
            $appraisal = PerformanceAppraisal::where('employee_id', $employee->id)->latest()->first();
            $appraisal->update([
                'status' => 'Diisi oleh Karyawan'
            ]);

            $certification = Certification::updateOrCreate([
                'performance_appraisal_id' => $appraisal->id,
                'staff_suggestion' => $request->staff_suggestion
            ]);

            return redirect()->route('performance-appraisal.index')->with('success', 'Data created successfully');
        }
    }

    public function masaPercobaan()
    {
        $data = employee::orderBy('department')->get();

        return view('pages.performance appraisal.probation.index', compact('data'));
    }
    public function formProbation(Employee $employee)
    {

        return view('pages.Performance Appraisal.probation.hod.index', compact('employee'));
    }

    public function storeProbation(StoreProbationAppraisal $request, Employee $employee)
    {
        try {

            $performanceAppraisal = new PerformanceAppraisal();
            $performanceAppraisal->employee_id = $employee->id;
            $performanceAppraisal->employee_uuid = $request->employee_uuid;
            $performanceAppraisal->date = now();
            $performanceAppraisal->type = 'For Probation';
            $performanceAppraisal->status = 'pending';
            $performanceAppraisal->save();

            $performance = new Performance([
                'performance_appraisal_id' => $performanceAppraisal->id,
                'job_knowledge' => $request->job_knowledge,
                'job_knowledge_remarks' => $request->job_knowledge_remarks,
                'quality_of_work' => $request->quality_of_work,
                'quality_of_work_remarks' => $request->quality_of_work_remarks,
                'quantity_of_work' => $request->quantity_of_work,
                'quantity_of_work_remarks' => $request->quantity_of_work_remarks,
                'stability' => $request->stability,
                'stability_remarks' => $request->stability_remarks,
                'communication' => $request->communication,
                'communication_remarks' => $request->communication_remarks,
                'diplomacy' => $request->diplomacy,
                'diplomacy_remarks' => $request->diplomacy_remarks,
                'judgement' => $request->judgement,
                'judgement_remarks' => $request->judgement_remarks,
                'salesmanship' => $request->salesmanship,
                'salesmanship_remarks' => $request->salesmanship_remarks,
                'customer_relations' => $request->customer_relations,
                'customer_relations_remarks' => $request->customer_relations_remarks,
                'supervisory_skills' => $request->supervisory_skills,
                'supervisory_skills_remarks' => $request->supervisory_skills_remarks
            ]);
            $performance->save();

            $attitudeTowardsWork = new AttitudeTowardsWork([
                'performance_appraisal_id' => $performanceAppraisal->id,
                'attitude_to_supervisor' => $request->attitude_to_supervisor,
                'attitude_to_supervisor_remarks' => $request->attitude_to_supervisor_remarks,
                'attitude_to_colleagues' => $request->attitude_to_colleagues,
                'attitude_to_colleagues_remarks' => $request->attitude_to_colleagues_remarks,
                'initiative' => $request->initiative,
                'initiative_remarks' => $request->initiative_remarks,
                'attendance' => $request->attendance,
                'attendance_remarks' => $request->attendance_remarks,
                'punctuality' => $request->punctuality,
                'punctuality_remarks' => $request->punctuality_remarks,
            ]);
            $attitudeTowardsWork->save();

            $overallRating = new OverallRating([
                'performance_appraisal_id' => $performanceAppraisal->id,
                'overall_rating' => $request->overall_rating,
            ]);
            $overallRating->save();

            $generalRating = new GeneralRating([
                'performance_appraisal_id' => $performanceAppraisal->id,
                'strengths' => $request->strengths,
                'weakness' => $request->weakness,
                'suggestions' => $request->suggestions,
                'promotability' => $request->promotability,
                'promotable_now_position' => $request->promotable_now_position,
                'promotable_now_successor' => $request->promotable_now_successor,
                'promotable_1_2_years_position' => $request->promotable_1_2_years_position,
                'promotable_1_2_years_successor' => $request->promotable_1_2_years_successor,
                'capability_limited_to_current_position' => $request->capability_limited_to_current_position,

            ]);
            $generalRating->save();

            $certification = new Certification([
                'performance_appraisal_id' => $performanceAppraisal->id,
                'staff_suggestion' => $request->staff_suggestion,
            ]);
            $certification->save();


            $probation = new Probation([
                'performance_appraisal_id' => $performanceAppraisal->id,
                'confirmed_date' => $request->confirmed_date,
                'extension_from' => $request->extension_from,
                'extension_reason' => $request->extension_reason,
                'termination_date' => $request->termination_date,
                'termination_reason' => $request->termination_reason,
            ]);
            $probation->save();

            return redirect()->route('performance-appraisal.masaPercobaan')->with('success', 'Data created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function updateProbation(UpdateProbationAppraisalProbation $request, Employee $employee)
    {
        if (Auth::user()->role == 'Karyawan' && Auth::user()->employee_id == $employee->uuid) {
            $appraisal = PerformanceAppraisal::where('employee_id', $employee->id)->latest()->first();
            $appraisal->update([
                'status' => 'Diisi oleh Karyawan'
            ]);

            $certification = Certification::updateOrCreate([
                'performance_appraisal_id' => $appraisal->id,
                'staff_suggestion' => $request->staff_suggestion
            ]);
            return redirect()->route('performance-appraisal.masaPercobaan')->with('success', 'Data created successfully');
        }
    }
    public function rekomendasi()
    {
        $data = Employee::orderBy('department')->get();

        return view('pages.performance appraisal.recomendation.index', compact('data'));
    }
    public function formRecommendation(Employee $employee)
    {

        return view('pages.Performance Appraisal.recomendation.hod.index', compact('employee'));
    }
    public function storeRecommendation(Request $request, Employee $employee)
    {
        try {

            $performanceAppraisal = new PerformanceAppraisal();
            $performanceAppraisal->employee_id = $employee->id;
            $performanceAppraisal->employee_uuid = $request->employee_uuid;
            $performanceAppraisal->date = now();
            $performanceAppraisal->type = 'For Promotion Recommendation';
            $performanceAppraisal->status = 'pending';
            $performanceAppraisal->save();

            $performance = new Performance([
                'performance_appraisal_id' => $performanceAppraisal->id,
                'job_knowledge' => $request->job_knowledge,
                'job_knowledge_remarks' => $request->job_knowledge_remarks,
                'quality_of_work' => $request->quality_of_work,
                'quality_of_work_remarks' => $request->quality_of_work_remarks,
                'quantity_of_work' => $request->quantity_of_work,
                'quantity_of_work_remarks' => $request->quantity_of_work_remarks,
                'stability' => $request->stability,
                'stability_remarks' => $request->stability_remarks,
                'communication' => $request->communication,
                'communication_remarks' => $request->communication_remarks,
                'diplomacy' => $request->diplomacy,
                'diplomacy_remarks' => $request->diplomacy_remarks,
                'judgement' => $request->judgement,
                'judgement_remarks' => $request->judgement_remarks,
                'salesmanship' => $request->salesmanship,
                'salesmanship_remarks' => $request->salesmanship_remarks,
                'customer_relations' => $request->customer_relations,
                'customer_relations_remarks' => $request->customer_relations_remarks,
                'supervisory_skills' => $request->supervisory_skills,
                'supervisory_skills_remarks' => $request->supervisory_skills_remarks
            ]);
            $performance->save();

            $attitudeTowardsWork = new AttitudeTowardsWork([
                'performance_appraisal_id' => $performanceAppraisal->id,
                'attitude_to_supervisor' => $request->attitude_to_supervisor,
                'attitude_to_supervisor_remarks' => $request->attitude_to_supervisor_remarks,
                'attitude_to_colleagues' => $request->attitude_to_colleagues,
                'attitude_to_colleagues_remarks' => $request->attitude_to_colleagues_remarks,
                'initiative' => $request->initiative,
                'initiative_remarks' => $request->initiative_remarks,
                'attendance' => $request->attendance,
                'attendance_remarks' => $request->attendance_remarks,
                'punctuality' => $request->punctuality,
                'punctuality_remarks' => $request->punctuality_remarks,
            ]);
            $attitudeTowardsWork->save();

            $overallRating = new OverallRating([
                'performance_appraisal_id' => $performanceAppraisal->id,
                'overall_rating' => $request->overall_rating,
            ]);
            $overallRating->save();

            $generalRating = new GeneralRating([
                'performance_appraisal_id' => $performanceAppraisal->id,
                'strengths' => $request->strengths,
                'weakness' => $request->weakness,
                'suggestions' => $request->suggestions,
                'promotability' => $request->promotability,
                'promotable_now_position' => $request->promotable_now_position,
                'promotable_now_successor' => $request->promotable_now_successor,
                'promotable_1_2_years_position' => $request->promotable_1_2_years_position,
                'promotable_1_2_years_successor' => $request->promotable_1_2_years_successor,
                'capability_limited_to_current_position' => $request->capability_limited_to_current_position,
            ]);
            $generalRating->save();
            $certification = new Certification([
                'performance_appraisal_id' => $performanceAppraisal->id,
                'staff_suggestion' => $request->staff_suggestion,
            ]);
            $certification->save();

            $promotion = new Promotion([
                'performance_appraisal_id' => $performanceAppraisal->id,
                'new_position' => $request->new_position,
                'level' => $request->level,
                'present_salary' => $request->present_salary,
                'proposed_salary' => $request->proposed_salary,
                'date_of_promotion' => $request->date_of_promotion,
                'additional_comments' => $request->additional_comments,
            ]);
            $promotion->save();
            return redirect()->route('performance-appraisal.rekomendasi')->with('success', 'Data created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function updateRecommendation(UpdateRecommendationApraisal $request, Employee $employee)
    {
        if (Auth::user()->role == 'Karyawan' && Auth::user()->employee_id == $employee->uuid) {
            $appraisal = PerformanceAppraisal::where('employee_id', $employee->id)->latest()->first();
            $appraisal->update([
                'status' => 'Diisi oleh Karyawan'
            ]);

            $certification = Certification::updateOrCreate([
                'performance_appraisal_id' => $appraisal->id,
                'staff_suggestion' => $request->staff_suggestion
            ]);
            return redirect()->route('performance-appraisal.rekomendasi')->with('success', 'Data created successfully');
        }
    }
}
