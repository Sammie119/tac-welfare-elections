@props(['messages', 'type' => 2])

@empty($messages)

@else
    @if($type == 0)
        <div class="alert alert-danger get-alert" role="alert">
            {{$messages}}
        </div>
    @elseif($type == 1)
        <div class="alert alert-success get-alert" role="alert">
            {{$messages}}
        </div>
    @else
        <ul class="get-alert">
            @foreach ((array) $messages as $message)
                <span class="text-danger"><li>{{ $message }}</li></span>
            @endforeach
        </ul>
    @endif
@endempty
