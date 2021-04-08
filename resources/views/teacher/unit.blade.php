@extends('layouts.app')

@section('content')
<div class="mdk-drawer-layout__content page">

    <div class="hero-banner bg-primary-dark d-flex flex-row align-items-center" style="height:250px;">
        <div class="container-fluid page__container">
            <div class="d-flex flex-column">
                <div>
                    <div class="badge badge-primary">{{$unit->unit_code}}</div>
                </div>
                <h1 class="text-white mb-0">{{$unit->unit_name}}</h1>
                <p class="lead text-white">{{$unit->course->course_name}}</p>
            </div>
        </div>
    </div>

    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-md-4 order-12">
                <div class="card">

                </div>
            </div>
            <div class="col-md-8">
                @php
                    $i = 1;
                @endphp
                @forelse ($steps as $step)
                    <div>
                        <!-- HEADING -->
                        <div class="page__heading d-flex align-items-center">
                            <div class="flex">
                                <h1 class="mb-2">{{$i++}}. {{$step->step_name}}</h1>
                            </div>
                        </div>
                        <!-- END -->

                        @if (!is_null($step->descriptions))
                            <div class="mb-3">
                                <strong class="text-dark-gray">DESCRIPTION</strong>
                            </div>
                            <p>
                                {!!$step->descriptions!!}
                            </p>
                        @endif

                        @if (count($step->files->where('unit_id', $unit->id)) > 0)
                            <div class="my-3">
                                <strong class="text-dark-gray">RESOURCES</strong>
                            </div>
                            <div class="card">
                                <ul class="list-group list-lessons">
                                    @forelse ($step->files->where('unit_id', $unit->id) as $item)
                                        <li class="list-group-item d-flex">
                                            <a href="{{route('download.unitFile', $item->file_name)}}">
                                                @if ($item->file_ext == 'pdf')
                                                    <i class="fa fa-file-pdf pr-2"></i>
                                                @elseif($item->file_ext == 'docx')
                                                    <i class="fa fa-file-word pr-2"></i>
                                                @elseif($item->file_ext == 'xlsx')
                                                    <i class="fa fa-file-excel pr-2"></i>
                                                @elseif($item->file_ext == 'ppt')
                                                    <i class="fa fa-file-powerpoint pr-2"></i>
                                                @endif
                                                {{$item->file_name}}
                                            </a>
                                            <div class="ml-auto d-flex align-items-center">
                                                <span class="text-muted">
                                                    <i class="material-icons icon-16pt icon-light">file_download</i>
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
                @empty
                    
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
