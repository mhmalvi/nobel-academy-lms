<div class="btn-group mb-2">
    <button type="button" class="btn btn-light" onclick="event.preventDefault(); document.getElementById('fileUploadForm').submit()">Upload</button>
    <button type="button" class="btn btn-light">Remove</button>
</div>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{__('Resources')}}</h5>
    </div>
    <div class="card-body p-0">
        <ul class="list-group list-group-flush list-lessons">
            <li class="list-group-item bg-light">
                <form action="{{route('file')}}" method="post" enctype="multipart/form-data" id="fileUploadForm">
                    @csrf
                    <input type="hidden" name="code" value="{{$unit->id}}">

                    @if (request()->segment(3) == 'core-unit')
                        <input type="hidden" name="unit" value="core">
                    @elseif(request()->segment(3) == 'elective-unit')
                        <input type="hidden" name="unit" value="elective">
                    @endif

                    <div class="form-group">
                        <label for="file">Choose file(s) to upload</label>
                        <input type="file" name="files[]" class="form-control" multiple/>
                        @error('files')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </form>
            </li>

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