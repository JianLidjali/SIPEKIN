@if (Auth::user()->role == 'Karyawan')
<div class="card col-12 mt-3">
    <div class="card-header">
        <h4>Part VII – Probation (For Probationers only)/ Masa Percobaan (Hanya untuk Masa Percobaan)</h4>
    </div>

    <div class="card-body">
        <div class="form-group">
            <label for="confirmed_date">Confirmed as an Employee effective:</label>
            <input type="date" name="confirmed_date" class="form-control mb-2" value="{{ $probation->confirmed_date }}"
                readonly>

            <!-- Extension From -->
            <label for="extension_from">Extension of Probation From:</label>
            <input type="date" name="extension_from" class="form-control mb-2" value="{{ $probation->extension_from }}"
                readonly>

            <!-- Reason for Extension -->
            <label for="extension_reason">Reason for Extension:</label>
            <textarea name="extension_reason" class="form-control mb-2"
                readonly>{{ $probation->extension_reason }}</textarea>

            <!-- Termination Date -->
            <label for="termination_date">Recommended for Termination effective:</label>
            <input type="date" name="termination_date" class="form-control mb-2"
                value="{{ $probation->termination_date }}" readonly>

            <!-- Reason for Termination -->
            <label for="termination_reason">Reason for Termination:</label>
            <textarea name="termination_reason" class="form-control mb-2"
                readonly>{{ $probation->termination_reason }}</textarea>
        </div>
    </div>
</div>
@endif