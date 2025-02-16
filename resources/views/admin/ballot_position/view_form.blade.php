<form method="POST" action="{{ route('ballots.update') }}">
    @csrf
    @method('put')
    <div class="card mb-4">
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Picture</th>
                        <th>Position</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ballots as $key => $ballot)
                        @php
                            $candidate = \App\Models\Candidate::find($ballot->candidate_id);
                        @endphp
                        <tr class="align-middle">
                            <td>{{ ++$key }}</td>
                            <td>{{ $candidate->name }}</td>
                            <td>
                                <img src="/storage/{{ $candidate->picture }}" alt="Image" style="width: 100px; border-radius: 50%;">
                            </td>
                            <td style="width: 20px">
                                <input type="text" class="form-control" name="position[]" value="{{ $ballot->position }}" required>
                                <input type="hidden" name="id[]" value="{{ $ballot->id }}">
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






