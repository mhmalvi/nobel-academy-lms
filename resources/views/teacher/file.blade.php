@extends('layouts.app')

@section('content')
    <div class="container-fluid page__container">
        @if (Session::has('message'))
            <div class="alert {{Session::get('alert-class')}} d-flex  align-items-center alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="text-body">
                    {{Session::get('message')}}
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <form action="{{route('share.resource')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-8">
                            <label for="Step">Unit</label>
                            <select name="unit" id="unit" class="form-control">
                                <option value disabled selected>Select course unit</option>
                                <optgroup label = "Core Units">
                                    @forelse ($units as $item)
                                        @if($item->unit_type == 'core')
                                            <option value="{{$item->id}}">{{$item->unit_name}}</option>
                                        @endif
                                    @empty
                                        <option>No item found!</option>
                                    @endforelse
                                </optgroup>
                                <optgroup label = "Elective Units">
                                    @forelse ($units as $item)
                                        @if($item->unit_type == 'elective')
                                            <option value="{{$item->id}}">{{$item->unit_name}}</option>
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
                                    <option value="{{$item->id}}">{{$item->step_name}}</option>
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
                        <input type="file" name="files" class="form-control" multiple/>
                        @error('files')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
        
                    <button type="submit" class="btn btn-outline-dark">Save</button>
                </form>
            </div>
        </div>

        <div class="card card-form">
            <div class="card-form__body">
                <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                    <table class="table mb-0 thead-border-top-0">
                        <thead>
                            <tr>
                                <th style="width: 18px;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input js-toggle-check-all" data-target="#files" id="customCheckAll">
                                        <label class="custom-control-label" for="customCheckAll"><span class="text-hide">Toggle all</span></label>
                                    </div>
                                </th>
                                <th>Files</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="list" id="files">
                            @forelse ($files as $item)
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input js-check-selected-row" id="Check{{$item->id}}">
                                            <label class="custom-control-label" for="Check{{$item->id}}"><span class="text-hide">Check</span></label>
                                        </div>
                                    </td>
                                    <td>{{$item->file_name}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No item found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
        <br>

        {{$files->links()}}
    </div>
@endsection
