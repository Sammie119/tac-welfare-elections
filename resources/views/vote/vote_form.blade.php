@php use Illuminate\Support\Facades\Auth; @endphp
<style>
    input[type="checkbox"] {
        width: 4em;
        height: 4em;
        border-color: black;
    }
</style>
<form method="POST" action="{{ route('vote.store') }}">
    @csrf
    <div class="card mb-4">
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Picture</th>
                        <th nowrap>Click to Vote</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ballots as $key => $ballot)
                        @php
                            $candidate = \App\Models\Candidate::find($ballot->candidate_id);
                        @endphp
                        <tr class="align-middle">
                            <td>{{ ++$key }}.</td>
                            <td>{{ $candidate->name }}</td>
                            <td>
                                <img src="/storage/{{ $candidate->picture }}" alt="Image" style="width: 100px; border-radius: 50%;">
                            </td>
                            <td style="width: 20px">
                                <input type="checkbox" class="form-check-input chb" name="ballot_id" value="{{ $ballot->id }}" required>
{{--                                <input type="text" name="candidate_id" value="{{ $ballot->candidate_id }}">--}}
                                <input type="hidden" name="election_id" value="{{ $ballot->election_id }}">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No Candidate Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div> <!-- /.card-body -->
    </div> <!-- /.card -->

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<script>
    $(".chb").change(function() {
        //Getting status before unchecking all
        var status = $(this).prop("checked");

        $(".chb").prop('checked', false);
        $(this).prop('checked', true);
        $(".chb").attr("required", false);

        //false means checkbox was checked and became unchecked on change event, so let it stay unchecked
        if (status === false) {
            $(this).prop('checked', false);
            $(".chb").attr("required", true);
        }
    });
</script>






