<form method="POST" action="{{ route('reports.view') }}">
    @csrf

    <div class="mb-3 row">
        <label for="" class="col-sm-3 col-form-label">Election</label>
        <div class="col-sm-9">
            <x-input-select :options="$election" :selected="isset($voter) ? $voter->election_id : 0" name="election_id" class="textInput" />
        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
