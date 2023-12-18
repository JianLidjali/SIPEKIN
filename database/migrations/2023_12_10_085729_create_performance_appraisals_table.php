<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('performance_appraisals', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->uuid('employee_uuid');
            $table->date('date');
            $table->string('type');
            $table->string('status');

            $table->timestamps();
        });
        Schema::create('Performances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_appraisal_id')->constrained()->onDelete('cascade');
            $table->bigInteger('job_knowledge');
            $table->text('job_knowledge_remarks')->nullable();
            $table->bigInteger('quality_of_work');
            $table->text('quality_of_work_remarks')->nullable();
            $table->bigInteger('quantity_of_work');
            $table->text('quantity_of_work_remarks')->nullable();
            $table->bigInteger('stability');
            $table->text('stability_remarks')->nullable();
            $table->bigInteger('communication');
            $table->text('communication_remarks')->nullable();
            $table->bigInteger('diplomacy');
            $table->text('diplomacy_remarks')->nullable();
            $table->bigInteger('judgement');
            $table->text('judgement_remarks')->nullable();
            $table->bigInteger('salesmanship');
            $table->text('salesmanship_remarks')->nullable();
            $table->bigInteger('customer_relations');
            $table->text('customer_relations_remarks')->nullable();
            $table->bigInteger('supervisory_skills');
            $table->text('supervisory_skills_remarks')->nullable();
            $table->timestamps();
        });
        Schema::create('AttitudeTowardsWorks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_appraisal_id')->constrained()->onDelete('cascade');
            $table->bigInteger('attitude_to_supervisor');
            $table->text('attitude_to_supervisor_remarks')->nullable();
            $table->bigInteger('attitude_to_colleagues');
            $table->text('attitude_to_colleagues_remarks')->nullable();
            $table->bigInteger('initiative');
            $table->text('initiative_remarks')->nullable();
            $table->bigInteger('attendance');
            $table->text('attendance_remarks')->nullable();
            $table->bigInteger('punctuality');
            $table->text('punctuality_remarks')->nullable();
            $table->timestamps();
        });
        Schema::create('OverallRatings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_appraisal_id')->constrained()->onDelete('cascade');
            $table->text('overall_rating');
            $table->timestamps();
        });
        Schema::create('GeneralRatings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_appraisal_id')->constrained()->onDelete('cascade');
            $table->text('strengths');
            $table->text('weakness');
            $table->text('suggestions');
            $table->text('promotability')->nullable();
            $table->text('promotable_now_position')->nullable();
            $table->text('promotable_now_successor')->nullable();
            $table->text('promotable_1_2_years_position')->nullable();
            $table->text('promotable_1_2_years_successor')->nullable();
            $table->timestamps();
        });
        Schema::create('Certifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_appraisal_id')->constrained()->onDelete('cascade');
            $table->text('staff_suggestion');
            $table->timestamps();
        });
        Schema::create('Probations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_appraisal_id')->constrained()->onDelete('cascade');
            $table->date('confirmed_date')->nullable();
            $table->date('extension_from')->nullable();
            $table->text('extension_reason')->nullable();
            $table->date('termination_date')->nullable();
            $table->text('termination_reason')->nullable();
            $table->timestamps();
        });
        Schema::create('Promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_appraisal_id')->constrained()->onDelete('cascade');
            $table->text('new_position');
            $table->text('level');
            $table->text('present_salary');
            $table->text('proposed_salary');
            $table->date('date_of_promotion');
            $table->text('additional_comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Performances');
        Schema::dropIfExists('AttitudeTowardsWorks');
        Schema::dropIfExists('OverallRatings');
        Schema::dropIfExists('GeneralRatings');
        Schema::dropIfExists('Certifications');
        Schema::dropIfExists('Probations');
        Schema::dropIfExists('Promotions');
        Schema::dropIfExists('performanceAppraisals');
    }
};
