<!DOCTYPE html>
<html>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    /*tr:nth-child(even) {*/
    /*    background-color: #dddddd;*/
    /*}*/
</style>
<body>

    <div>
        <div style="text-align: center; line-height: 16px;">
            <h1>The Apostolic Church-Ghana</h1>
            <h2>Non-Ministerial Support Staff Welfare Association</h2>
            <h2>{{ $votes[0]->election_name }}</h2>
            <h3>Report</h3>
        </div>

        @forelse($voting_positions as $position)
            @php
                $count = 1;
            @endphp
            <table border="1">
                <thead>
                    <tr>
                        <th colspan="50">{{ $position->position_name }}</th>
                    </tr>
                    <tr>
                        <th style="width: 5%"><strong>#</strong></th>
                        <th style="width: 60%">Candidate</th>
                        <th style="width: 25%">Position</th>
                        <th style="width: 10%">Votes</th>
                        <th style="width: 10%">Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($votes->where('voting_position_id', $position->id) as $vote)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $vote->candidate_name }}</td>
                            <td>{{ $vote->position_name }}</td>
                            <td>{{ $vote->votes }}</td>
                            <td>{{ $vote->votes }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="50">No Data Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <br>
        @empty
            <tr>
                <td colspan="50">No Data Found</td>
            </tr>
        @endforelse
    </div> <!-- /.card-body -->

    <div>
        <p>Name of Returning Officer:</p>
        <p>Signature:</p>
        <p>Date:</p>
    </div>

</body>
</html>
