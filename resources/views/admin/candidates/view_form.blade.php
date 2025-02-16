<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Candidate Details</h3>
    </div> <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Item</th>
                    <th>Information</th>
                </tr>
            </thead>
            <tbody>
                <tr class="align-middle">
                    <td>1.</td>
                    <td>Name: </td>
                    <td>{{ $candidate->name }}</td>
                </tr>
                <tr class="align-middle">
                    <td>2.</td>
                    <td>Voting Position:</td>
                    <td>{{ getElectionName($candidate->position, 'position') }}</td>
                </tr>
                <tr class="align-middle">
                    <td>3.</td>
                    <td>Election:</td>
                    <td>{{ getElectionName($candidate->election_id) }}</td>
                </tr>
                <tr class="align-middle">
                    <td>4.</td>
                    <td>More Information: </td>
                    <td>{{ $candidate->description }}</td>
                </tr>
                <tr class="align-middle">
                    <td>5.</td>
                    <td>Election Status: </td>
                    <td>{!! getStatus(\App\Models\ElectionSettings::find($candidate->election_id)->status) !!}</td>
                </tr>
            <tr>
                <td colspan="5" align="center">
                    @isset($candidate->picture)
                        <img src="/storage/{{ $candidate->picture }}" alt="Image" style="width: 200px; border-radius: 50%;">
                    @endisset
                </td>
            </tr>
            </tbody>
        </table>
    </div> <!-- /.card-body -->
</div> <!-- /.card -->
