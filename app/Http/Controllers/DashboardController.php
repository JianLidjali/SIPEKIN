<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PerformanceAppraisal;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        $appraisal = PerformanceAppraisal::whereIn('status', ['pending', 'Diapprove oleh HRD', 'Diapprove oleh GM'])->get();

        $status = PerformanceAppraisal::where('status', 'pending')->get();
        $employee = Employee::count();



        $data2 = PerformanceAppraisal::where('type', 'For Annual')->count();
        $data3 = PerformanceAppraisal::where('type', 'For Probation')->count();
        $data4 = PerformanceAppraisal::where('type', 'For Promotion Recommendation')->count();

        $data = Employee::count();

        $department = Employee::distinct('department')->count('department');
        return view('pages.dashboard.index', compact('data', 'department', 'appraisal', 'employee', 'data2', 'data3', 'data4', 'status'));
    }

    public function approveHrd($id)
    {

        try {
            $appraisal = PerformanceAppraisal::findOrFail($id);
            $appraisal->update([
                'status' => 'Diapprove oleh HRD'
            ]);
            return redirect()->back()->with('success', 'Penilaian berhasil diapprove oleh HRD');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function approveGM($id)
    {
        try {
            $appraisal = PerformanceAppraisal::findOrFail($id);
            $appraisal->update([
                'status' => 'Diapprove oleh GM'
            ]);
            return redirect()->back()->with('success', 'Penilaian berhasil diapprove oleh GM');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function reject($id)
    {
        try {
            $appraisal = PerformanceAppraisal::findOrFail($id);
            $appraisal->update([
                'status' => 'Ditolak'
            ]);
            return redirect()->back()->with('success', 'Penilaian berhasil ditolak');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function show($id)
    {
        $appraisal = PerformanceAppraisal::findOrFail($id);
        return view('components.modal.detail', compact('appraisal'));
    }
}
