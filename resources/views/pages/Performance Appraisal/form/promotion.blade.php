@if (Auth::user()->role == 'Karyawan')
<div class="card col-12 mt-3">
    <div class="card-header">
        <h4>Part VIII – Promotion/Promosi (Pengangkatan Jabatan)</h4>
    </div>

    <div class="card-body">
        <div class="form-group">
            <!-- New Position -->
            <label for="new_position">New Position:</label>
            <input type="text" name="new_position" class="form-control mb-2" value="{{ $promotion->new_position }}"
                readonly>

            <!-- Level -->
            <label for="level">Level:</label>
            <input type="text" name="level" class="form-control mb-2" value="{{ $promotion->level }}" readonly>

            <!-- Present Salary -->
            <label for="present_salary">Present Salary:</label>
            <input type="text" name="present_salary" class="form-control mb-2" value="{{ $promotion->present_salary }}"
                readonly>

            <!-- Proposed Salary -->
            <label for="proposed_salary">Proposed Salary:</label>
            <input type="text" name="proposed_salary" class="form-control mb-2"
                value="{{ $promotion->proposed_salary }}" readonly>

            <!-- Date of Promotion -->
            <label for="date_of_promotion">Date of Promotion:</label>
            <input type="date" name="date_of_promotion" class="form-control mb-2"
                value="{{ $promotion->date_of_promotion }}" readonly>

            <!-- Additional Comments by General Manager -->
            <label for="additional_comments">Additional Comments by General Manager:</label>
            <textarea name="additional_comments" class="form-control mb-2"
                readonly>{{ $promotion->additional_comments }}</textarea>
        </div>
    </div>
</div>
@else
<div class="card col-12 mt-3">
    <div class="card-header">
        <h4>Part VIII – Promotion/Promosi (Pengangkatan Jabatan)</h4>
    </div>

    <div class="card-body">
        <div class="form-group">
            <!-- New Position -->
            <label for="new_position">New Position:</label>
            <input type="text" name="new_position" class="form-control mb-2">

            <!-- Level -->
            <label for="level">Level:</label>
            <input type="text" name="level" class="form-control mb-2">

            <!-- Present Salary -->
            <label for="present_salary">Present Salary:</label>
            <input type="text" name="present_salary" class="form-control mb-2">

            <!-- Proposed Salary -->
            <label for="proposed_salary">Proposed Salary:</label>
            <input type="text" name="proposed_salary" class="form-control mb-2">

            <!-- Date of Promotion -->
            <label for="date_of_promotion">Date of Promotion:</label>
            <input type="date" name="date_of_promotion" class="form-control mb-2">

            <!-- Additional Comments by General Manager -->
            <label for="additional_comments">Additional Comments by General Manager:</label>
            <textarea name="additional_comments" class="form-control mb-2"></textarea>
        </div>
    </div>
</div>
@endif