@extends('layouts.app')

@section('title', 'Unit')

@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="hero-banner bg-primary-dark d-flex flex-row align-items-center py-3">
            <div class="container-fluid page__container">
                <div class="d-flex flex-column">
                    <div>
                        <div class="badge badge-primary">{{ $unit->unit_code }}</div>
                    </div>
                    <h1 class="text-white mb-0">{{ $unit->unit_name }}</h1>
                </div>
            </div>
        </div>
        <div class="container-fluid page__container">
            <div class="py-3">
                <img src="{{ asset('assets/course_thumb.jpg') }}" class="img-fluid" alt="Responsive image">
            </div>

            <div class="pt-3">
                @if ($unit->progress->complete_step > 0)
                    <div class="alert alert-soft-success d-flex align-items-center card-margin" role="alert">
                        <i class="material-icons mr-3">star</i>
                        <div class="text-body"><strong>Congratulations.</strong> You have completed
                            {{ $unit->progress->complete_step }} of 5 Steps. </div>
                    </div>
                @endif

                @if (Session::has('assesment'))
                    <div class="alert alert-soft-success d-flex align-items-center card-margin" role="alert">
                        <i class="material-icons mr-3">star</i>
                        <div class="text-body">{{ Session::get('assesment') }}</div>
                    </div>
                @endif
            </div>

            <div id="card-body">
                <!-- HEADING -->
                <div class="d-flex align-items-center">
                    <div class="flex">
                        <h1 class="mb-2">Unit Overview</h1>
                    </div>
                </div>
                <!-- END -->
                <div class="my-4">
                    <p class="text-justify">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis,
                        necessitatibus consequatur asperiores consectetur, ea corrupti sapiente dolorum quibusdam accusamus
                        eveniet ad maxime temporibus?
                        Magni laudantium quod repudiandae et consequuntur exercitationem.
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                        @php
                            $i = 1;
                        @endphp
                        @forelse ($steps as $step)
                            <li class="nav-item my-1">
                                <a href="{{ $progress->current_step >= $step->id ? route('step', ['unitId' => $unit->id, 'stepId' => $step->id]) : 'javascript:void(0)' }}"
                                    class="nav-link {{ $progress->current_step >= $step->id ? '' : 'disabled' }}">
                                    {{ $step->step_name }}
                                </a>
                            </li>
                        @empty
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link">
                                    No Step Found
                                </a>
                            </li>
                        @endforelse
                    </ul>
                    @if (isset($getStep))
                        <div class="card mt-3">
                            <div class="card-body tab-content">
                                <div class="tab-pane fade active show">
                                    <!-- HEADING -->
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <h1 class="mb-2">{{ $getStep->step_name }}</h1>
                                        </div>
                                        <div>
                                            @if ($unit->progress->current_step < count($steps) && $unit->progress->current_step == $getStep->id)
                                                <form
                                                    action="{{ route('complete.step', ['unitId' => $unit->id, 'id' => $getStep->id]) }}"
                                                    method="post" id="complete">
                                                    @csrf
                                                </form>
                                                <button type="button" class="btn btn-outline-success"
                                                    onclick="event.preventDefault(); document.getElementById('complete').submit()">
                                                    Mark as complete <i class="material-icons ml-2">check</i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- END -->
                                    <div class="row">
                                        <div class="col-md-7">
                                            <img src="{{ asset('assets/images/steps/' . $getStep->thumbnail) }}" alt=""
                                                class="img-fluid py-5" style="max-width: 150px;">
                                            <div class="my-4">
                                                <p class="text-justify">
                                                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis,
                                                    necessitatibus consequatur asperiores consectetur, ea corrupti sapiente
                                                    dolorum
                                                    quibusdam accusamus eveniet ad maxime temporibus?
                                                    Magni laudantium quod repudiandae et consequuntur exercitationem.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-5 mt-5">
                                            @if (count($getStep->files) > 0)
                                                <div class="card">
                                                    <ul class="list-group list-lessons">
                                                        @forelse ($getStep->files as $item)
                                                            <li class="list-group-item d-flex">
                                                                <a href="{{ route('download.file', $item->file_name) }}">
                                                                    @if ($item->file_ext == 'pdf')
                                                                        <i class="fa fa-file-pdf pr-2"></i>
                                                                    @elseif($item->file_ext == 'docx' ||
                                                                        $item->file_ext ==
                                                                        'dotx')
                                                                        <i class="fa fa-file-word pr-2"></i>
                                                                    @elseif($item->file_ext == 'xlsx')
                                                                        <i class="fa fa-file-excel pr-2"></i>
                                                                    @elseif($item->file_ext == 'pptx')
                                                                        <i class="fa fa-file-powerpoint pr-2"></i>
                                                                    @endif
                                                                    {{ $item->file_name }}
                                                                </a>
                                                                <div class="ml-auto d-flex align-items-center">
                                                                    <span class="text-primary">
                                                                        <i
                                                                            class="material-icons icon-16pt icon-dark">file_download</i>
                                                                    </span>
                                                                </div>
                                                            </li>
                                                        @empty
                                                            <li class="list-group-item d-flex">
                                                                No File Found!
                                                            </li>
                                                        @endforelse
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    @if ($unit->progress->current_step == count($steps) && $unit->progress->current_step == $getStep->id)

                                        <div class="card">
                                            <div class="card-header">
                                                <h6>Share you assignments google drive link</h6>
                                            </div>
                                            <div class="card-body">
                                                <form
                                                    action="{{ route('complete.step', ['unitId' => $unit->id, 'id' => $getStep->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="text" name="link" class="form-control"
                                                            placeholder="Your assignments drive link" />
                                                        @error('link')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <button type="submit" class="btn btn-outline-info">
                                                        Request for assesment <i class="material-icons ml-2">check</i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
