<form method="POST" action="/elections">
    @csrf
    @isset($election)
        @method('put')
        <input type="hidden" name="id" value="{{ $election->id }}">
    @endisset

    <div class="mb-3 row">
        <label for="" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control cusInput" name="name" value="@isset($election) {{ $election->name }} @endisset" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="" class="col-sm-2 col-form-label">Display Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control cusInput" name="display_title" value="@isset($election) {{ $election->display_title }} @endisset" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="description" value="@isset($election) {{ $election->description }} @endisset">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="" class="col-sm-2 col-form-label">Start Date</label>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-5">
                    <input type="date" class="form-control" name="start_date" value="{{ isset($election) ? $election->start_date : "" }}" required>
                </div>
                <label for="" class="col-sm-2 col-form-label">Start Time</label>
                <div class="col-sm-5">
                    <input type="time" class="form-control" name="start_time" value="{{ isset($election) ? $election->start_time : "" }}" required>
                </div>
            </div>

        </div>
    </div>
    <div class="mb-3 row">
        <label for="" class="col-sm-2 col-form-label">End Date</label>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-5">
                    <input type="date" class="form-control" name="end_date" value="{{ isset($election) ? $election->end_date : "" }}" required>
                </div>
                <label for="" class="col-sm-2 col-form-label">End Time</label>
                <div class="col-sm-5">
                    <input type="time" class="form-control" name="end_time" value="{{ isset($election) ? $election->end_time : "" }}" required>
                </div>
            </div>

        </div>
    </div>
    <div class="mb-3 row">
        <label for="" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
            <x-input-select
                :options="['Pending', 'In Progress', 'Completed']"
                :selected="isset($election) ? $election->status : 3"
                :values="[0, 1, 2]"
                name="status"
                :type="1"
                required
            />
        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

