@extends('admin.layouts.app')

@section('title', 'Share Resources')

    @push('css')
        <link href="{{ asset('assets/admin/css/plugins/select2/select2.min.css') }}" rel="stylesheet">
    @endpush

@section('content')
    <div class="container">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Upload Resources To Share</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.share.resource') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row form-group">
                        <div class="col-md-8">
                            <label for="Step">Unit</label>
                            <select name="unit" id="unit" class="form-control">
                                <option value disabled selected>Select course unit</option>
                                <optgroup label="Core Units">
                                    @forelse ($units as $item)
                                        @if ($item->unit_type == 'core')
                                            <option value="{{ $item->id }}">{{ $item->unit_name }}</option>
                                        @endif
                                    @empty
                                        <option>No item found!</option>
                                    @endforelse
                                </optgroup>
                                <optgroup label="Elective Units">
                                    @forelse ($units as $item)
                                        @if ($item->unit_type == 'elective')
                                            <option value="{{ $item->id }}">{{ $item->unit_name }}</option>
                                        @endif
                                    @empty
                                        <option>No item found!</option>
                                    @endforelse
                                </optgroup>
                            </select>
                            @error('unit')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="Step">Step</label>
                            <select name="step" id="step" class="form-control">
                                <option value disabled selected>Select step</option>
                                @forelse ($steps as $item)
                                    <option value="{{ $item->id }}">{{ $item->step_name }}</option>
                                @empty
                                    <option>No item found!</option>
                                @endforelse
                            </select>
                            @error('step')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="files">Files</label>
                        <input type="file" name="files[]" id="files" class="form-control" multiple />
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Select2 -->
    <script src="{{ asset('assets/admin/js/plugins/select2/select2.full.min.js') }}"></script>

    <script>
        $("#unit").select2();
        $("#step").select2();
    </script>
@endpush
