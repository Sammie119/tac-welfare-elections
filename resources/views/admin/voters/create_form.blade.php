<form method="POST" action="{{ route('voters.store') }}" enctype="multipart/form-data">
    @csrf
    @isset($voter)
        @method('put')
        <input type="hidden" name="id" value="{{ $voter->id }}">
    @endisset

    @empty($voter)
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" role="switch" id="checkFileUpload" value="1">
            <label class="form-check-label" for="flexSwitchCheckChecked">Upload an Excel File</label>
        </div>
    @endempty

    <div id="getFileUpload" style="display: none">
        <div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label">File</label>
            <div class="col-sm-10">
                <input type="file" class="form-control fileUpload" name="file">
            </div>
        </div>
    </div>

    <div class="hideInputs">
        <div class="mb-3 row">
            <label for="" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control textInput" name="name" value="@isset($voter) {{ $voter->name }} @endisset">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="" class="col-sm-3 col-form-label">Voter ID</label>
            <div class="col-sm-9">
                <input type="text" class="form-control textInput" name="voters_id" value="@isset($voter) {{ $voter->voters_id }} @endisset">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="" class="col-sm-3 col-form-label">Mobile Number</label>
            <div class="col-sm-9">
                <input type="text" class="form-control textInput" name="mobile_number" value="@isset($voter) {{ $voter->mobile_number }} @endisset">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="" class="col-sm-3 col-form-label">Election</label>
            <div class="col-sm-9">
                <x-input-select :options="$election" :selected="isset($voter) ? $voter->election_id : 0" name="election_id" class="textInput" />
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
    $("#checkFileUpload").change(function(){
        if($('#checkFileUpload').is(":checked")){
            $("#getFileUpload").css("display","block");
            $(".fileUpload").attr("required", true);

            $(".hideInputs").css("display","none");
            $(".textInput").attr("required", false);

        } else {
            $("#getFileUpload").css("display","none");
            $(".fileUpload").attr("required", false);

            $(".hideInputs").css("display","block");
            $(".textInput").attr("required", true);
        }
    });
</script>

