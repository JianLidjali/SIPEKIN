@if (Auth::user()->role == 'Karyawan')
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
                $categoryValue = $performance ? $performance->$categoryKey : null;
                $remarksName = $categoryKey . '_remarks';
                $remarksValue = $performance ? $performance->$remarksName : '';
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $category }}</td>
                    <td><input type="radio" name="{{ $categoryKey }}" value="9" {{ $categoryValue==9 ? 'checked' : '' }}
                            required {{ Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}></td>
                    <td><input type="radio" name="{{ $categoryKey }}" value="8" {{ $categoryValue==8 ? 'checked' : '' }}
                            required {{ Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}></td>
                    <td><input type="radio" name="{{ $categoryKey }}" value="7" {{ $categoryValue==7 ? 'checked' : '' }}
                            required {{ Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}></td>
                    <td><input type="radio" name="{{ $categoryKey }}" value="6" {{ $categoryValue==6 ? 'checked' : '' }}
                            required {{ Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}></td>
                    <td><input type="radio" name="{{ $categoryKey }}" value="5" {{ $categoryValue==5 ? 'checked' : '' }}
                            required {{ Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}></td>
                    <td><input type="text" class="form-control" name="{{ $remarksName }}" value="{{ $remarksValue }}" {{
                            Auth::user()->role == 'Karyawan' ? 'readonly' : '' }}></td>
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

@else
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
                    <td colspan="10"><input type="text" class="form-control" id="part_ii_total" name="part_ii_total"
                            readonly></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endif