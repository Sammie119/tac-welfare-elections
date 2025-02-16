<form method="POST" action="{{ route('voting_positions.store') }}" enctype="multipart/form-data">
    @csrf
    @isset($position)
        @method('put')
        <input type="hidden" name="id" value="{{ $position->id }}">
    @endisset

    <div class="hideInputs">
        <div class="mb-3 row">
            <label for="" class="col-sm-3 col-form-label">Position Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="position_name" value="@isset($position) {{ $position->position_name }} @endisset" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="" class="col-sm-3 col-form-label">Election</label>
            <div class="col-sm-9">
                <x-input-select :options="$election" :selected="isset($position) ? $position->election_id : 0" name="election_id" required/>
            </div>
        </div>
    </div>
    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>


