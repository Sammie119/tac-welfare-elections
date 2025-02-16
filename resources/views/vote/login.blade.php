<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="hideInputs">
        <div class="mb-3 row">
            <div class="col-sm-12">
                <input type="text" class="form-control" name="email" id="voter_id" placeholder="Enter Voter ID" required>
            </div>
        </div>

        <div class="mb-3 row" id="sms_button">
            <div class="col-sm-6">
                <a class="btn btn-info" id="haveCode"> <i class="bi bi-envelope-open-fill"></i> Have Code</a>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-info float-end" id="getCode"> <i class="bi bi-envelope-fill"></i> Get Code</a>
            </div>
        </div>

        <div class="mb-3 row" style="display: none" id="showCode">
            <div class="col-sm-12">
                <input type="password" class="form-control" id="enterCode" name="password" placeholder="Enter your Code">
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
    $("#getCode").click(function(){
        let voter_id = $("#voter_id").val();
        // alert(voter_id)
        $.ajax({
            type:'GET',
            url:'get_voter_code',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                voter_id
            },
            success:function(data) {
                if (voter_id === ""){
                    alert('No Voter ID was entered');
                }
                else if(data.voter === 2){
                    alert('Your name is not in the Voters Register. Please, see the Elections Committee');
                }
                else if(data.voter === 1){
                    alert('Code is Sent Successfully to your Mobile Number. Kindly check to login and cast your Vote!!!');

                    $("#showCode").css("display","block");
                    $("#enterCode").attr("required", true);

                    $("#sms_button").css("display","none");
                }
                else {
                    alert('No Election has Started');
                }
            }

        });
    });

    $("#haveCode").click(function(){
        alert('Please, Enter your Code in the Space provided');
        $("#showCode").css("display","block");
        $("#enterCode").attr("required", true);

        $("#sms_button").css("display","none");

    });
</script>


