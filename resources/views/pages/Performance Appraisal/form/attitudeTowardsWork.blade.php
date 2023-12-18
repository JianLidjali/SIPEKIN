@if (Auth::user()->role == 'Karyawan')
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
                    <td><input type="radio" name="{{ $categoryKey }}" value="9" {{ $attitudeValue==9 ? 'checked' : '' }}
                            required {{ $readOnly }}></td>
                    <td><input type="radio" name="{{ $categoryKey }}" value="8" {{ $attitudeValue==8 ? 'checked' : '' }}
                            required {{ $readOnly }}></td>
                    <td><input type="radio" name="{{ $categoryKey }}" value="7" {{ $attitudeValue==7 ? 'checked' : '' }}
                            required {{ $readOnly }}></td>
                    <td><input type="radio" name="{{ $categoryKey }}" value="6" {{ $attitudeValue==6 ? 'checked' : '' }}
                            required {{ $readOnly }}></td>
                    <td><input type="radio" name="{{ $categoryKey }}" value="5" {{ $attitudeValue==5 ? 'checked' : '' }}
                            required {{ $readOnly }}></td>
                    <td><input type="text" class="form-control" name="{{ $remarksName }}" value="{{ $remarksValue }}" {{
                            $readOnly }}></td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="1" class="text-right"><strong>Total :</strong></td>
                    <td colspan="10"><input type="text" class="form-control" id="part_iii_total" name="part_iii_total"
                            readonly></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@else
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
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $category }}</td>
                    <td><input type="radio" name="{{ strtolower(str_replace(' ', '_', $category)) }}" value="9"></td>
                    <td><input type="radio" name="{{ strtolower(str_replace(' ', '_', $category)) }}" value="8"></td>
                    <td><input type="radio" name="{{ strtolower(str_replace(' ', '_', $category)) }}" value="7"></td>
                    <td><input type="radio" name="{{ strtolower(str_replace(' ', '_', $category)) }}" value="6"></td>
                    <td><input type="radio" name="{{ strtolower(str_replace(' ', '_', $category)) }}" value="5"></td>
                    <td><input type="text" class="form-control"
                            name="{{ strtolower(str_replace(' ', '_', $category . '_remarks')) }}"></td>

                </tr>
                @endforeach
                <tr>
                    <td colspan="1" class="text-right"><strong>Total :</strong></td>
                    <td colspan="10"><input type="text" class="form-control" id="part_iii_total" name="part_iii_total"
                            readonly></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endif