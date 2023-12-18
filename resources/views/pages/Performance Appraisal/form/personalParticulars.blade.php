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