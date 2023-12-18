<a type="button" data-bs-toggle="modal" data-bs-target="#{{ $id }}" class="badge bg-warning">
    <i class="fa-solid fa-info" aria-hidden="true"></i>
    {{ isset($text) ? $text : null }}
</a>
<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Label">Detail Penilaian: {{ $employee->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('pages.Performance Appraisal.form.personalParticulars')
                @include('pages.Performance Appraisal.form.performance')
                @include('pages.Performance Appraisal.form.attitudeTowardsWork')
                @include('pages.Performance Appraisal.form.overallRating')
                @include('pages.Performance Appraisal.form.generalRating')
                @include('pages.Performance Appraisal.form.certification')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Ok</button>
            </div>
        </div>
    </div>