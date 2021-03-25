<div class="card">
    <div class="card-header">
        <h5>{{__('Self Learning Resources')}}</h5>
    </div>
    <div class="card-body p-0">
        <ul class="list-group list-group-flush list-lessons">
            @forelse ($files as $file)
                @if (request()->segment(3) == 'core-unit')
                    <li class="list-group-item d-flex border-0">
                        <a href="{{route('download.unitFile', $file->file_name)}}">
                            <i class="fas fa-file-download"></i>&nbsp;
                            {{$file->file_name}}
                        </a>
                    </li>
                @elseif(request()->segment(3) == 'elective-unit')
                    <li class="list-group-item d-flex border-0">
                        <a href="{{route('download.unitFile', $file->file_name)}}">
                            <i class="fas fa-file-download"></i>&nbsp;
                            {{$file->file_name}}
                        </a>
                    </li>
                @endif
            @empty
                <li class="list-group-item bg-light">
                    no resource found!
                </li> 
            @endforelse
        </ul>
    </div>
</div>