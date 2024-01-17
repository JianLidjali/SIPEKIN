<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreAnnualApprasial extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        //dd($this->all());
        return [
            'employee_uuid' => 'required|exists:employees,uuid',

            // Validation for Part II
            'job_knowledge' => 'required|integer|between:5,9',
            'job_knowledge_remarks' => 'nullable',
            'quality_of_work' => 'required|integer|between:5,9',
            'quality_of_work_remarks' => 'nullable',
            'quantity_of_work' => 'required|integer|between:5,9',
            'quantity_of_work_remarks' => 'nullable',
            'stability' => 'required|integer|between:5,9',
            'stability_remarks' => 'nullable',
            'communication' => 'required|integer|between:5,9',
            'communication_remarks' => 'nullable',
            'diplomacy' => 'required|integer|between:5,9',
            'diplomacy_remarks' => 'nullable',
            'judgement' => 'required|integer|between:5,9',
            'judgement_remarks' => 'nullable',
            'salesmanship' => 'required|integer|between:5,9',
            'salesmanship_remarks' => 'nullable',
            'customer_relations' => 'required|integer|between:5,9',
            'customer_relations_remarks' => 'nullable',
            'supervisory_skills' => 'required|integer|between:5,9',
            'supervisory_skills_remarks' => 'nullable',


            // Validation for Part III
            'attitude_to_supervisor' => 'required|integer|between:5,9',
            'attitude_to_supervisors_remarks' => 'nullable',
            'attitude_to_colleagues' => 'required|integer|between:5,9',
            'attitude_to_colleagues_remarks' => 'nullable',
            'initiative' => 'required|string',
            'initiative_remarks' => 'nullable',
            'attendance' => 'required|string',
            'attendance_remarks' => 'nullable',
            'punctuality' => 'required|string',
            'punctuality_remarks' => 'nullable',


            // Validation for Part IV
            'overall_rating' => [
                'required',
                Rule::in(['A - Outstanding Performance | Sangat Memuaskan', 'B - Good Performance | Baik', 'C - Meets Job Requirements | Memenuhi Permintaan Pekerjaan', 'D - Improvement Required | Perlu Peningkatan', 'E - Below Expectations | Kurang']),
            ],

            // Validation for Part V
            'strengths' => 'required|string',
            'weakness' => 'required|string',
            'suggestions' => 'required|string',
            'promotability' => 'nullable|in:promotable_now,promotable_1_2_years,limited_to_current_position',
            'promotable_now_position' => 'nullable|string|required_if:promotability,promotable_now',
            'promotable_now_successor' => 'nullable|string|required_if:promotability,promotable_now',
            'promotable_1_2_years_position' => 'nullable|string|required_if:promotability,promotable_1_2_years',
            'promotable_1_2_years_successor' => 'nullable|string|required_if:promotability,promotable_1_2_years',
            'limited_to_current_position' => 'nullable|string|required_if:promotability,limited_to_current_position',
            'capability_limited_to_current_position' => 'nullable|string|required_if:promotability,capability_limited_to_current_position',



            // Validation for Part VI
            'staff_suggestion' => 'nullable|string',
        ];
    }
}
