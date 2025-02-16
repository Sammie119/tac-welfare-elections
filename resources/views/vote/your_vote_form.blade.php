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
                        <th>Name</th>
                        <th>Picture</th>
                        <th>Voting Position</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="align-middle">
                        <td>{{ $candidate->name }}</td>
                        <td>
                            <img src="/storage/{{ $candidate->picture }}" alt="Image" style="width: 100px; border-radius: 50%;">
                        </td>
                        <td>{{ $position->position_name }}</td>
                    </tr>
                </tbody>
            </table>
        </div> <!-- /.card-body -->
    </div> <!-- /.card -->
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






