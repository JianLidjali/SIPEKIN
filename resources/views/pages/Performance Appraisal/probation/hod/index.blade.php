@extends('layouts.main')

@section('title', 'Form Probation Appraisal')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Form Probation Appraisal</h1>
        </div>
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                {{ session('success') }}
            </div>
        </div>
        @elseif (session()->has('error'))
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                {{ session('error') }}
            </div>
        </div>
        @endif
    </section>
    <form action="{{ route('probation.store', $employee->uuid) }}" method="post">
        @csrf
        <input type="hidden" name="employee_uuid" value="{{ $employee->uuid }}">
        @include('pages.Performance Appraisal.form.personalParticulars')
        @include('pages.Performance Appraisal.form.performance')
        @include('pages.Performance Appraisal.form.attitudeTowardsWork')
        @include('pages.Performance Appraisal.form.overallRating')
        @include('pages.Performance Appraisal.form.generalRating')
        @include('pages.Performance Appraisal.form.certification')
        @include('pages.Performance Appraisal.form.probation')
        <div class="d-flex">
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>
    function calculateTotal(tableId, totalId) {
        var total = 0;
        $('#' + tableId + ' input[type="radio"]:checked').each(function () {
            total += parseInt($(this).val());
        });
        $('#' + totalId).val(total);

        // Panggil fungsi untuk mengupdate Part IV total dan overall rating
        updatePartIVTotal();
    }

    function updatePartIVTotal() {
        // Ambil nilai dari Part II dan Part III
        var partIITotal = parseInt(document.getElementById('part_ii_total').value) || 0;
        var partIIITotal = parseInt(document.getElementById('part_iii_total').value) || 0;

        // Hitung total Part IV
        var partIVTotal = partIITotal + partIIITotal;

        // Update nilai di input Total Part IV
        $('#part_iv_total').val(partIVTotal);

        // Sesuaikan Overall Rating berdasarkan total
        var overallRatingSelect = document.getElementById('overall_rating');

        if (partIVTotal >= 130 && partIVTotal <= 135) {
            overallRatingSelect.value = 'A - Outstanding Performance | Sangat Memuaskan';
        } else if (partIVTotal >= 115 && partIVTotal <= 120) {
            overallRatingSelect.value = 'B - Good Performance | Baik';
        } else if (partIVTotal >= 95 && partIVTotal <= 105) {
            overallRatingSelect.value = 'C - Meets Job Requirements | Memenuhi Permintaan Pekerjaan';
        } else if (partIVTotal >= 80 && partIVTotal <= 90) {
            overallRatingSelect.value = 'D - Improvement Required |  Perlu Peningkatan';
        } else if (partIVTotal >= 75 && partIVTotal <= 85) {
            overallRatingSelect.value = 'E -  Below Expectations | Kurang';
        }
    }

    // Panggil fungsi pertama kali untuk inisialisasi
    updatePartIVTotal();

    // Tambahkan event listener untuk setiap kali nilai di Part II atau Part III berubah
    $('#part_ii_table input[type="radio"]').change(function () {
        calculateTotal('part_ii_table', 'part_ii_total');
    });

    $('#part_iii_table input[type="radio"]').change(function () {
        calculateTotal('part_iii_table', 'part_iii_total');
    });
</script>
@endpush