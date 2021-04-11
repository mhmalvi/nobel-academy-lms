@extends('admin.layouts.app')

@push('css')
    <link href="{{asset('assets/admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/plugins/iCheck/polaris.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="row">
    <div class="col-sm-7">
        <div class="ibox selected">
            <div class="ibox-content">
                <div class="row m-b-lg">
                    <div class="col-lg-2">
                        <div class="m-b-sm">
                            <img class="rounded" src="{{asset('storage/users/'.$student->user->photo)}}" alt="image" />
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <h2>
                            <strong>{{$student->first_name}}&nbsp;{{$student->last_name}}</strong>
                        </h2>
                        <p class="mt-0">
                            <strong><i class="fa fa-envelope" aria-hidden="true"></i></strong>&nbsp;
                            {{$student->user->email}}
                        </p>
                        <p class="mt-0">
                            <strong><i class="fa fa-phone-square" aria-hidden="true"></i></strong>&nbsp;
                            {{$student->phone}}
                        </p>
                        <p class="mt-0">
                            <strong><i class="fa fa-mobile" aria-hidden="true"></i></strong>&nbsp;
                            {{$student->mobile}}
                        </p>
                    </div>
                </div>
                <div class="client-detail">
                    <div class="full-height-scroll">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="ibox">
            <div class="ibox-content">
                <span class="text-muted small float-right">Last modification: <i class="fa fa-clock-o"></i> 2:10 pm - 12.06.2014</span>
                <h2>Course Units</h2>
                <div class="clients-list">
                    <span class="float-right small text-muted">1406 Elements</span>
                    <ul class="nav nav-tabs">
                        <li><a class="nav-link active" data-toggle="tab" href="#tab-1"> Core Units</a></li>
                        <li><a class="nav-link" data-toggle="tab" href="#tab-2"> Elective Units</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="full-height-scroll">
                                <div class="table-responsive py-2">
                                    <table class="table table-striped table-hover" id="core">
                                        <tbody>
                                            @forelse ($units->where('unit_type', 'core') as $item)
                                                <tr>
                                                    <td width="10%">
                                                        <input type="hidden" name="steps[]" value="1">
                                                        <input type="checkbox" 
                                                        class="i-checks unit" 
                                                        name="units[]" 
                                                        value="{{$item->unit_code}}" 
                                                        {{(!is_null($student->enrollment->core_units) && in_array($item->unit_code, $student->enrollment->core_units)) ? 'checked' : ''}}
                                                        />
                                                    </td>
                                                    <td width="90%">{{$item->unit_code}} - {{$item->unit_name}}</td>
                                                </tr>
                                            @empty
                                                <p class="text-center">No data found!</p>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="full-height-scroll">
                                <div class="table-responsive py-2">
                                    <table class="table table-striped table-hover">
                                        <tbody>
                                            @forelse ($units->where('unit_type', 'elective') as $item)
                                                <tr>
                                                    <td width="10%">
                                                        <input type="hidden" name="steps[]" value="1">
                                                        <input type="checkbox" 
                                                        class="i-checks unit" 
                                                        name="units[]" 
                                                        value="{{$item->unit_code}}" 
                                                        {{(!is_null($enrollment->core_units) && in_array($item->unit_code, $enrollment->core_units)) ? 'checked' : ''}}
                                                        />
                                                    </td>
                                                    <td width="90%">{{$item->unit_code}} - {{$item->unit_name}}</td>
                                                </tr>
                                            @empty
                                                <p class="text-center">No data found!</p>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script src="{{asset('assets/admin/js/plugins/iCheck/icheck.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_polaris',
            });


            $('.i-checks').on("ifChecked", function(){
                var code = $(this).val();

                $.ajax({
                    url: "{{route('admin.unit.assign', Auth::user()->id)}}",
                    method: "POST",
                    data: {code: code},
                    dataType: "json",
                    success: function(res) {
                        if(res.status == 200){
                            toastr.success(res.message);
                        }
                        else if(res.status == 503){
                            toastr.warning(res.message);
                        }
                    }
                })
            });

            $('.i-checks').on("ifUnchecked", function(){
                var code = $(this).val();

                $.ajax({
                    url: "{{route('admin.remove.assign', Auth::user()->id)}}",
                    method: "DELETE",
                    data: {code: code},
                    dataType: "json",
                    success: function(res) {
                        if(res.status == 200){
                            toastr.success(res.message);
                        }
                        else if(res.status == 503){
                            toastr.warning(res.message);
                        }
                    }
                })
            });
        });
    </script>
@endpush
