<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Voters Register</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-end">
                        <li class="page-item">
                            <input class="form-control me-2" type="search" id="search" placeholder="Search" aria-label="Search">
                        </li>
                    </ul>
                </div>
            </div> <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 20px">#</th>
                            <th>Name</th>
                            <th>Voter ID</th>
                            <th>Mobile</th>
                            <th>Election</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="selectVoters">
                        @forelse($voters as $key => $voter)
                            <tr class="align-middle">
                                <td>{{ ++$key }}</td>
                                <td>{{ $voter->name }}</td>
                                <td>{{ $voter->voters_id }}</td>
                                <td>{{ $voter->mobile_number }}</td>
                                <td>{{ getElectionName($voter->election_id) }}</td>
                                <td>{!! getStatus(\App\Models\ElectionSettings::find($voter->election_id)->status) !!}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="50">No Data Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!--end::Container-->
</div> <!--end::App Content-->

<script>
    $("#search").keyup(function(){
        let search = $("#search").val();
        // alert(search)
        $.ajax({
            type:'GET',
            url:'get_voter_register_search',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                search
            },
            success:function(data) {
                if(data === ''){
                    $("#selectVoters").empty();
                    $("#selectVoters").html("<tr><td colspan='40'>No data Found</td></tr>");
                }
                else {
                    $("#selectVoters").empty();
                    $("#selectVoters").html(data);
                }
            }

        });
    });
</script>
