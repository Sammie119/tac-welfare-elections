<form method="POST" action="{{ route('candidates.store') }}" enctype="multipart/form-data">
    @csrf
    @isset($candidate)
        @method('put')
        <input type="hidden" name="id" value="{{ $candidate->id }}">
    @endisset

    <div class="hideInputs">
        <div class="mb-3 row">
            <label for="" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="name" value="@isset($candidate) {{ $candidate->name }} @endisset" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="" class="col-sm-3 col-form-label">Election</label>
            <div class="col-sm-9">
                <x-input-select :options="$election" :selected="isset($candidate) ? $candidate->election_id : 0" name="election_id" id="selectElection" required/>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="" class="col-sm-3 col-form-label">Position</label>
            <div class="col-sm-9">
                <x-input-select :options="$voting_position" :selected="isset($candidate) ? $candidate->position : 0" name="position" id="selectPosition" required/>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="" class="col-sm-3 col-form-label">Description</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="description" value="@isset($candidate) {{ $candidate->description }} @endisset" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="" class="col-sm-3 col-form-label">Picture</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" name="picture" @empty($candidate) required @endempty>
            </div>
            <div class="input-group mb-1">
                @isset($candidate->picture)
                    <img src="/storage/{{ $candidate->picture }}" alt="Image" width="150">
                @endisset
            </div>
        </div>
    </div>
    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<script>
    $("#selectElection").change(function(){
        let election = $("#selectElection").val();
        $.ajax({
            type:'GET',
            url:'get_voting_positions',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                election
            },
            success:function(data) {
                $("#selectPosition").empty();
                $("#selectPosition").html(data);
            }
        });
    });
</script>


