@extends('layouts.main')

@section('title', 'Detail Performance Appraisal')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Performance Appraisal</h1>
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
    <form>
        @csrf
        <input type="hidden" name="employee_uuid" value="{{ $employee->uuid }}">
        @if ($data->type == 'For Annual')
        <div class="card col-12 mt-3">
            <div class="card-header">
                <h4>Part I - Personal Particulars / Data Pribadi</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control mb-2" id="name" name="name" disabled
                                value="{{ $employee->name }}">

                            <label for="staff_identity_card_no">Staff Identity Card No:</label>
                            <input type="text" class="form-control mb-2" id="staff_identity_card_no"
                                name="staff_identity_card_no" disabled value="{{ $employee->staffIdentityCardNo }}">

                            <label for="department">Department:</label>
                            <input type="text" class="form-control mb-2" id="department" name="department" disabled
                                value="{{ $employee->department }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date_joined">Date joined:</label>
                            <input type="date" class="form-control mb-2" id="date_joined" name="date_joined" disabled
                                value="{{ $employee->dateJoined }}">

                            <label for="position">Position:</label>
                            <input type="text" class="form-control mb-2" id="position" name="position" disabled
                                value="{{ $employee->position }}">

                            <label for="date_in_present_position">Date in the present position:</label>
                            <input type="date" class="form-control mb-2" id="date_in_present_position"
                                name="date_in_present_position" disabled
                                value="{{ $employee->dateInThePresentPosition }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<div class="card col-12 mt-3">
    <div class="card-header">
        <h4>Part II - Performance / Hasil Kerja</h4>
    </div>
    <div class="card-body table-responsive">
        <table class="table" id="part_ii_table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Keterangan Terperinci</th>
                    <th>9</th>
                    <th>8</th>
                    <th>7</th>
                    <th>6</th>
                    <th>5</th>
                    <th>Remarks/Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php
                $categories = [
                'Job Knowledge',
                'Quality of Work',
                'Quantity of Work',
                'Stability',
                'Communication',
                'Diplomacy',
                'Judgement',
                'Salesmanship',
                'Customer Relations',
                'Supervisory Skills',
                ];
                @endphp
                @foreach ($categories as $index => $category)
                @php
                        $categoryKey = strtolower(str_replace(' ', '_', $category));
                        $performanceValue = $performance ? $performance->$categoryKey : null;
                        $remarksName = $categoryKey . '_remarks';
                        $remarksValue = $performance ? $performance->$remarksName : '';
                        $readOnly = Auth::user()->role == 'Karyawan' ? 'readonly' : '';
                        @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $category }}</td>
                    <td><input type="radio" name="{{ $categoryKey }}" value="9" {{ $performanceValue==9 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                    <td><input type="radio" name="{{ $categoryKey }}" value="8" {{ $performanceValue==8 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                    <td><input type="radio" name="{{ $categoryKey }}" value="7" {{ $performanceValue==7 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                    <td><input type="radio" name="{{ $categoryKey }}" value="6" {{ $performanceValue==6 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                    <td><input type="radio" name="{{ $categoryKey }}" value="5" {{ $performanceValue==5 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                    <td><input type="text" class="form-control" value="{{$remarksValue}}"
                            name="{{ $remarksName }}"></td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="1" class="text-right"><strong>Total :</strong></td>
                    <td colspan="10"><input type="text" class="form-control" id="part_ii_total" name="part_ii_total"
                            readonly></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

        <div class="card col-12 mt-3">
            <div class="card-header">
                <h4>Part III – Attitude Towards Work / Sikap terhadap pekerjaan</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table" id="part_iii_table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Keterangan Terperinci</th>
                            <th>9</th>
                            <th>8</th>
                            <th>7</th>
                            <th>6</th>
                            <th>5</th>
                            <th>Remarks/Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $attitudeCategories = [
                        'Attitude to Supervisor',
                        'Attitude to Colleagues',
                        'Initiative',
                        'Attendance',
                        'Punctuality',
                        ];
                        @endphp

                        @foreach ($attitudeCategories as $index => $category)
                        @php
                        $categoryKey = strtolower(str_replace(' ', '_', $category));
                        $attitudeValue = $attitudeTowardsWork ? $attitudeTowardsWork->$categoryKey : null;
                        $remarksName = $categoryKey . '_remarks';
                        $remarksValue = $attitudeTowardsWork ? $attitudeTowardsWork->$remarksName : '';
                        $readOnly = Auth::user()->role == 'Karyawan' ? 'readonly' : '';
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category }}</td>
                            <td><input type="radio" name="{{ $categoryKey }}" value="9" {{ $attitudeValue==9 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                            <td><input type="radio" name="{{ $categoryKey }}" value="8" {{ $attitudeValue==8 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                            <td><input type="radio" name="{{ $categoryKey }}" value="7" {{ $attitudeValue==7 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                            <td><input type="radio" name="{{ $categoryKey }}" value="6" {{ $attitudeValue==6 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                            <td><input type="radio" name="{{ $categoryKey }}" value="5" {{ $attitudeValue==5 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                            <td><input type="text" class="form-control" name="{{ $remarksName }}"
                                    value="{{ $remarksValue }}" {{ $readOnly }}></td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="1" class="text-right"><strong>Total :</strong></td>
                            <td colspan="10"><input type="text" class="form-control" id="part_iii_total"
                                    name="part_iii_total" readonly></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card col-12 mt-3">
            <div class="card-header">
                <h4>Part IV – Overall Rating / Penilaian Keseluruhan</h4>
            </div>
            <div class="card-body">
                <!-- Menambahkan input untuk total Part IV -->
                <input type="hidden" class="form-control" id="part_iv_total" name="part_iv_total" readonly>
                <label for="overall_rating">Overall Rating:</label>
                <input type="text" class="form-control" value="{{ $overallRating->overall_rating }}" id="overall_rating"
                    name="overall_rating" readonly>
            </div>
        </div>
        <div class="card col-12 mt-3">
            <div class="card-header">
                <h4>Part V – General Rating / Penilaian Keseluruhan</h4>
            </div>
            <div class="card-body">
                <label for="strengths">1. Strengths of the staff:</label>
                <textarea class="form-control mb-2" id="strengths" name="strengths" rows="3" {{
                    Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}>{{ $generalRating->strengths }}</textarea>


                <label for="weaknesses">2. Weaknesses of the staff:</label>
                <textarea class="form-control mb-2" id="weaknesses" name="weakness" rows="3" {{
                    Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}> {{ $generalRating->weakness }}</textarea>

                <label for="suggestions">3. Suggestions (e.g., Training required to improve weaknesses, development
                    to
                    optimize strengths, etc):</label>
                <textarea class="form-control mb-2" id="suggestions" name="suggestions" rows="3" {{
                    Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}> {{ $generalRating->suggestions }}</textarea>

                <div class="form-group">
                    <label for="promotability">4. Promotability:</label>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="promotability" id="promotable_now"
                            value="promotable_now" {{ $generalRating->promotability == 'promotable_now' ? 'checked' : ''
                        }} {{
                        Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}>
                        <label class="form-check-label mb-2" for="promotable_now">Promotable now to:</label>
                        <input type="text" class="form-control" id="promotable_now_position"
                            name="promotable_now_position" value="{{ $generalRating->promotable_now_position }}" {{
                            Auth::user()->role == 'Karyawan' ?
                        'readonly' : '' }}>
                        <label class="form-check-label mb-2" for="promotable_now_successor">Possible Successor:</label>
                        <input type="text" class="form-control" id="promotable_now_successor"
                            name="promotable_now_successor" value="{{ $generalRating->promotable_now_successor }}" {{
                            Auth::user()->role == 'Karyawan' ?
                        'readonly' : '' }}>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="promotability" id="promotable_1_2_years"
                            value="promotable_1_2_years" {{ $generalRating->promotability == 'promotable_1_2_years' ?
                        'checked'
                        : '' }} {{ Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}>
                        <label class="form-check-label mb-2" for="promotable_1_2_years">Promotable in 1-2 years
                            to:</label>
                        <input type="text" class="form-control" id="promotable_1_2_years_position"
                            name="promotable_1_2_years_position"
                            value="{{ $generalRating->promotable_1_2_years_position }}" {{ Auth::user()->role ==
                        'Karyawan' ? 'readonly' : '' }}>
                        <label class="form-check-label mb-2" for="promotable_1_2_years_successor">Possible
                            Successor:</label>
                        <input type="text" class="form-control" id="promotable_1_2_years_successor"
                            name="promotable_1_2_years_successor"
                            value="{{ $generalRating->promotable_1_2_years_successor }}" {{ Auth::user()->role ==
                        'Karyawan' ? 'readonly' : '' }}>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="promotability"
                            id="limited_to_current_position" value="limited_to_current_position" {{
                            $generalRating->promotability ==
                        'limited_to_current_position' ? 'checked' : '' }} {{ Auth::user()->role == 'Karyawan' ?
                        'readonly' : ''
                        }}>
                        <label class="form-check-label mb-2" for="limited_to_current_position">Capability limited to
                            Current
                            Position</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card col-12 mt-3">
            <div class="card-header">
                <h4>Part VI – Certification/Sertifikasi</h4>
            </div>
            <div class="card-body">
                <!-- Menambahkan input untuk total Part IV -->
                <label for="staff_suggestions">Staff Suggestions:</label>
                <textarea class="form-control mb-2" id="staff_suggestion" name="staff_suggestion"
                    rows="3">{{ $certification->staff_suggestion ?? '' }}</textarea>
            </div>
        </div>
        @elseif ($data->type == 'For Probation')
        <div class="card col-12 mt-3">
            <div class="card-header">
                <h4>Part I - Personal Particulars / Data Pribadi</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control mb-2" id="name" name="name" disabled
                                value="{{ $employee->name }}">

                            <label for="staff_identity_card_no">Staff Identity Card No:</label>
                            <input type="text" class="form-control mb-2" id="staff_identity_card_no"
                                name="staff_identity_card_no" disabled value="{{ $employee->staffIdentityCardNo }}">

                            <label for="department">Department:</label>
                            <input type="text" class="form-control mb-2" id="department" name="department" disabled
                                value="{{ $employee->department }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date_joined">Date joined:</label>
                            <input type="date" class="form-control mb-2" id="date_joined" name="date_joined" disabled
                                value="{{ $employee->dateJoined }}">

                            <label for="position">Position:</label>
                            <input type="text" class="form-control mb-2" id="position" name="position" disabled
                                value="{{ $employee->position }}">

                            <label for="date_in_present_position">Date in the present position:</label>
                            <input type="date" class="form-control mb-2" id="date_in_present_position"
                                name="date_in_present_position" disabled
                                value="{{ $employee->dateInThePresentPosition }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card col-12 mt-3">
            <div class="card-header">
                <h4>Part III – Attitude Towards Work / Sikap terhadap pekerjaan</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table" id="part_iii_table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Keterangan Terperinci</th>
                            <th>9</th>
                            <th>8</th>
                            <th>7</th>
                            <th>6</th>
                            <th>5</th>
                            <th>Remarks/Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $attitudeCategories = [
                        'Attitude to Supervisor',
                        'Attitude to Colleagues',
                        'Initiative',
                        'Attendance',
                        'Punctuality',
                        ];
                        @endphp

                        @foreach ($attitudeCategories as $index => $category)
                        @php
                        $categoryKey = strtolower(str_replace(' ', '_', $category));
                        $attitudeValue = $attitudeTowardsWork ? $attitudeTowardsWork->$categoryKey : null;
                        $remarksName = $categoryKey . '_remarks';
                        $remarksValue = $attitudeTowardsWork ? $attitudeTowardsWork->$remarksName : '';
                        $readOnly = Auth::user()->role == 'Karyawan' ? 'readonly' : '';
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category }}</td>
                            <td><input type="radio" name="{{ $categoryKey }}" value="9" {{ $attitudeValue==9 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                            <td><input type="radio" name="{{ $categoryKey }}" value="8" {{ $attitudeValue==8 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                            <td><input type="radio" name="{{ $categoryKey }}" value="7" {{ $attitudeValue==7 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                            <td><input type="radio" name="{{ $categoryKey }}" value="6" {{ $attitudeValue==6 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                            <td><input type="radio" name="{{ $categoryKey }}" value="5" {{ $attitudeValue==5 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                            <td><input type="text" class="form-control" name="{{ $remarksName }}"
                                    value="{{ $remarksValue }}" {{ $readOnly }}></td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="1" class="text-right"><strong>Total :</strong></td>
                            <td colspan="10"><input type="text" class="form-control" id="part_iii_total"
                                    name="part_iii_total" readonly></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card col-12 mt-3">
            <div class="card-header">
                <h4>Part IV – Overall Rating / Penilaian Keseluruhan</h4>
            </div>
            <div class="card-body">
                <!-- Menambahkan input untuk total Part IV -->
                <input type="hidden" class="form-control" id="part_iv_total" name="part_iv_total" readonly>
                <label for="overall_rating">Overall Rating:</label>
                <input type="text" class="form-control" value="{{ $overallRating->overall_rating }}" id="overall_rating"
                    name="overall_rating" readonly>
            </div>
        </div>
        <div class="card col-12 mt-3">
            <div class="card-header">
                <h4>Part V – General Rating / Penilaian Keseluruhan</h4>
            </div>
            <div class="card-body">
                <label for="strengths">1. Strengths of the staff:</label>
                <textarea class="form-control mb-2" id="strengths" name="strengths" rows="3" {{
                    Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}>{{ $generalRating->strengths }}</textarea>


                <label for="weaknesses">2. Weaknesses of the staff:</label>
                <textarea class="form-control mb-2" id="weaknesses" name="weakness" rows="3" {{
                    Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}> {{ $generalRating->weakness }}</textarea>

                <label for="suggestions">3. Suggestions (e.g., Training required to improve weaknesses, development
                    to
                    optimize strengths, etc):</label>
                <textarea class="form-control mb-2" id="suggestions" name="suggestions" rows="3" {{
                    Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}> {{ $generalRating->suggestions }}</textarea>

                <div class="form-group">
                    <label for="promotability">4. Promotability:</label>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="promotability" id="promotable_now"
                            value="promotable_now" {{ $generalRating->promotability == 'promotable_now' ? 'checked' : ''
                        }} {{
                        Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}>
                        <label class="form-check-label mb-2" for="promotable_now">Promotable now to:</label>
                        <input type="text" class="form-control" id="promotable_now_position"
                            name="promotable_now_position" value="{{ $generalRating->promotable_now_position }}" {{
                            Auth::user()->role == 'Karyawan' ?
                        'readonly' : '' }}>
                        <label class="form-check-label mb-2" for="promotable_now_successor">Possible Successor:</label>
                        <input type="text" class="form-control" id="promotable_now_successor"
                            name="promotable_now_successor" value="{{ $generalRating->promotable_now_successor }}" {{
                            Auth::user()->role == 'Karyawan' ?
                        'readonly' : '' }}>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="promotability" id="promotable_1_2_years"
                            value="promotable_1_2_years" {{ $generalRating->promotability == 'promotable_1_2_years' ?
                        'checked'
                        : '' }} {{ Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}>
                        <label class="form-check-label mb-2" for="promotable_1_2_years">Promotable in 1-2 years
                            to:</label>
                        <input type="text" class="form-control" id="promotable_1_2_years_position"
                            name="promotable_1_2_years_position"
                            value="{{ $generalRating->promotable_1_2_years_position }}" {{ Auth::user()->role ==
                        'Karyawan' ? 'readonly' : '' }}>
                        <label class="form-check-label mb-2" for="promotable_1_2_years_successor">Possible
                            Successor:</label>
                        <input type="text" class="form-control" id="promotable_1_2_years_successor"
                            name="promotable_1_2_years_successor"
                            value="{{ $generalRating->promotable_1_2_years_successor }}" {{ Auth::user()->role ==
                        'Karyawan' ? 'readonly' : '' }}>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="promotability"
                            id="limited_to_current_position" value="limited_to_current_position" {{
                            $generalRating->promotability ==
                        'limited_to_current_position' ? 'checked' : '' }} {{ Auth::user()->role == 'Karyawan' ?
                        'readonly' : ''
                        }}>
                        <label class="form-check-label mb-2" for="limited_to_current_position">Capability limited to
                            Current
                            Position</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card col-12 mt-3">
            <div class="card-header">
                <h4>Part VI – Certification/Sertifikasi</h4>
            </div>
            <div class="card-body">
                <!-- Menambahkan input untuk total Part IV -->
                <label for="staff_suggestions">Staff Suggestions:</label>
                <textarea class="form-control mb-2" id="staff_suggestion" name="staff_suggestion"
                    rows="3">{{ $certification->staff_suggestion ?? '' }}</textarea>
            </div>
        </div>
        <div class="card col-12 mt-3">
            <div class="card-header">
                <h4>Part VII – Probation (For Probationers only)/ Masa Percobaan (Hanya untuk Masa Percobaan)</h4>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="confirmed_date">Confirmed as an Employee effective:</label>
                    <input type="date" name="confirmed_date" class="form-control mb-2"
                        value="{{ $probation->confirmed_date }}" readonly>

                    <!-- Extension From -->
                    <label for="extension_from">Extension of Probation From:</label>
                    <input type="date" name="extension_from" class="form-control mb-2"
                        value="{{ $probation->extension_from }}" readonly>

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
        @elseif ($data->type == 'For Promotion Recommendation')
        <div class="card col-12 mt-3">
            <div class="card-header">
                <h4>Part I - Personal Particulars / Data Pribadi</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control mb-2" id="name" name="name" disabled
                                value="{{ $employee->name }}">

                            <label for="staff_identity_card_no">Staff Identity Card No:</label>
                            <input type="text" class="form-control mb-2" id="staff_identity_card_no"
                                name="staff_identity_card_no" disabled value="{{ $employee->staffIdentityCardNo }}">

                            <label for="department">Department:</label>
                            <input type="text" class="form-control mb-2" id="department" name="department" disabled
                                value="{{ $employee->department }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date_joined">Date joined:</label>
                            <input type="date" class="form-control mb-2" id="date_joined" name="date_joined" disabled
                                value="{{ $employee->dateJoined }}">

                            <label for="position">Position:</label>
                            <input type="text" class="form-control mb-2" id="position" name="position" disabled
                                value="{{ $employee->position }}">

                            <label for="date_in_present_position">Date in the present position:</label>
                            <input type="date" class="form-control mb-2" id="date_in_present_position"
                                name="date_in_present_position" disabled
                                value="{{ $employee->dateInThePresentPosition }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card col-12 mt-3">
            <div class="card-header">
                <h4>Part III – Attitude Towards Work / Sikap terhadap pekerjaan</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table" id="part_iii_table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Keterangan Terperinci</th>
                            <th>9</th>
                            <th>8</th>
                            <th>7</th>
                            <th>6</th>
                            <th>5</th>
                            <th>Remarks/Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $attitudeCategories = [
                        'Attitude to Supervisor',
                        'Attitude to Colleagues',
                        'Initiative',
                        'Attendance',
                        'Punctuality',
                        ];
                        @endphp

                        @foreach ($attitudeCategories as $index => $category)
                        @php
                        $categoryKey = strtolower(str_replace(' ', '_', $category));
                        $attitudeValue = $attitudeTowardsWork ? $attitudeTowardsWork->$categoryKey : null;
                        $remarksName = $categoryKey . '_remarks';
                        $remarksValue = $attitudeTowardsWork ? $attitudeTowardsWork->$remarksName : '';
                        $readOnly = Auth::user()->role == 'Karyawan' ? 'readonly' : '';
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category }}</td>
                            <td><input type="radio" name="{{ $categoryKey }}" value="9" {{ $attitudeValue==9 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                            <td><input type="radio" name="{{ $categoryKey }}" value="8" {{ $attitudeValue==8 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                            <td><input type="radio" name="{{ $categoryKey }}" value="7" {{ $attitudeValue==7 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                            <td><input type="radio" name="{{ $categoryKey }}" value="6" {{ $attitudeValue==6 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                            <td><input type="radio" name="{{ $categoryKey }}" value="5" {{ $attitudeValue==5 ? 'checked'
                                    : '' }} required {{ $readOnly }}></td>
                            <td><input type="text" class="form-control" name="{{ $remarksName }}"
                                    value="{{ $remarksValue }}" {{ $readOnly }}></td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="1" class="text-right"><strong>Total :</strong></td>
                            <td colspan="10"><input type="text" class="form-control" id="part_iii_total"
                                    name="part_iii_total" readonly></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card col-12 mt-3">
            <div class="card-header">
                <h4>Part IV – Overall Rating / Penilaian Keseluruhan</h4>
            </div>
            <div class="card-body">
                <!-- Menambahkan input untuk total Part IV -->
                <input type="hidden" class="form-control" id="part_iv_total" name="part_iv_total" readonly>
                <label for="overall_rating">Overall Rating:</label>
                <input type="text" class="form-control" value="{{ $overallRating->overall_rating }}" id="overall_rating"
                    name="overall_rating" readonly>
            </div>
        </div>
        <div class="card col-12 mt-3">
            <div class="card-header">
                <h4>Part V – General Rating / Penilaian Keseluruhan</h4>
            </div>
            <div class="card-body">
                <label for="strengths">1. Strengths of the staff:</label>
                <textarea class="form-control mb-2" id="strengths" name="strengths" rows="3" {{
                    Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}>{{ $generalRating->strengths }}</textarea>


                <label for="weaknesses">2. Weaknesses of the staff:</label>
                <textarea class="form-control mb-2" id="weaknesses" name="weakness" rows="3" {{
                    Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}> {{ $generalRating->weakness }}</textarea>

                <label for="suggestions">3. Suggestions (e.g., Training required to improve weaknesses, development
                    to
                    optimize strengths, etc):</label>
                <textarea class="form-control mb-2" id="suggestions" name="suggestions" rows="3" {{
                    Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}> {{ $generalRating->suggestions }}</textarea>

                <div class="form-group">
                    <label for="promotability">4. Promotability:</label>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="promotability" id="promotable_now"
                            value="promotable_now" {{ $generalRating->promotability == 'promotable_now' ? 'checked' : ''
                        }} {{
                        Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}>
                        <label class="form-check-label mb-2" for="promotable_now">Promotable now to:</label>
                        <input type="text" class="form-control" id="promotable_now_position"
                            name="promotable_now_position" value="{{ $generalRating->promotable_now_position }}" {{
                            Auth::user()->role == 'Karyawan' ?
                        'readonly' : '' }}>
                        <label class="form-check-label mb-2" for="promotable_now_successor">Possible Successor:</label>
                        <input type="text" class="form-control" id="promotable_now_successor"
                            name="promotable_now_successor" value="{{ $generalRating->promotable_now_successor }}" {{
                            Auth::user()->role == 'Karyawan' ?
                        'readonly' : '' }}>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="promotability" id="promotable_1_2_years"
                            value="promotable_1_2_years" {{ $generalRating->promotability == 'promotable_1_2_years' ?
                        'checked'
                        : '' }} {{ Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}>
                        <label class="form-check-label mb-2" for="promotable_1_2_years">Promotable in 1-2 years
                            to:</label>
                        <input type="text" class="form-control" id="promotable_1_2_years_position"
                            name="promotable_1_2_years_position"
                            value="{{ $generalRating->promotable_1_2_years_position }}" {{ Auth::user()->role ==
                        'Karyawan' ? 'readonly' : '' }}>
                        <label class="form-check-label mb-2" for="promotable_1_2_years_successor">Possible
                            Successor:</label>
                        <input type="text" class="form-control" id="promotable_1_2_years_successor"
                            name="promotable_1_2_years_successor"
                            value="{{ $generalRating->promotable_1_2_years_successor }}" {{ Auth::user()->role ==
                        'Karyawan' ? 'readonly' : '' }}>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="promotability"
                            id="limited_to_current_position" value="limited_to_current_position" {{
                            $generalRating->promotability ==
                        'limited_to_current_position' ? 'checked' : '' }} {{ Auth::user()->role == 'Karyawan' ?
                        'readonly' : ''
                        }}>
                        <label class="form-check-label mb-2" for="limited_to_current_position">Capability limited to
                            Current
                            Position</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card col-12 mt-3">
            <div class="card-header">
                <h4>Part VI – Certification/Sertifikasi</h4>
            </div>
            <div class="card-body">
                <!-- Menambahkan input untuk total Part IV -->
                <label for="staff_suggestions">Staff Suggestions:</label>
                <textarea class="form-control mb-2" id="staff_suggestion" name="staff_suggestion"
                    rows="3">{{ $certification->staff_suggestion ?? '' }}</textarea>
            </div>
        </div>
        <div class="card col-12 mt-3">
            <div class="card-header">
                <h4>Part VIII – Promotion/Promosi (Pengangkatan Jabatan)</h4>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <!-- New Position -->
                    <label for="new_position">New Position:</label>
                    <input type="text" name="new_position" class="form-control mb-2"
                        value="{{ $promotion->new_position }}" readonly>

                    <!-- Level -->
                    <label for="level">Level:</label>
                    <input type="text" name="level" class="form-control mb-2" value="{{ $promotion->level }}" readonly>

                    <!-- Present Salary -->
                    <label for="present_salary">Present Salary:</label>
                    <input type="text" name="present_salary" class="form-control mb-2"
                        value="{{ $promotion->present_salary }}" readonly>

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
        @endif
        <div class="d-flex">
            <a href="{{ route('dashboard.index') }}" class="btn btn-primary ml-auto w-100">Kembali</a>
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