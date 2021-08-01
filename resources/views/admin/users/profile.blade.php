@extends('admin.layouts.app')

@section('title', 'User Profile')

    @push('css')
        <link href="{{ asset('assets/admin/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/admin/css/plugins/iCheck/polaris.css') }}" rel="stylesheet">
    @endpush

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">


        <div class="row m-b-lg m-t-lg">
            <div class="col-md-6">

                <div class="profile-image">
                    <img src="{{ asset('storage/users/' . $user->photo) }}" class="rounded-circle circle-border m-b-md"
                        alt="{{ $user->name }}">
                </div>
                <div class="profile-info">
                    <div class="">
                        <div>
                            <h2 class="no-margins">
                                {{ $user->info->getUserFullName() }}
                            </h2>
                            <h4>{{ $user->email }}</h4>
                            <small>
                                {{ $user->info->phone }}
                            </small>
                            <br>
                            <small>
                                {{ $user->info->address }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <table class="table small m-b-xs">
                    <tbody>
                        <tr>
                            <td>
                                <strong>142</strong> Projects
                            </td>
                            <td>
                                <strong>22</strong> Followers
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <strong>61</strong> Comments
                            </td>
                            <td>
                                <strong>54</strong> Articles
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>154</strong> Tags
                            </td>
                            <td>
                                <strong>32</strong> Friends
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <small>Sales in last 24h</small>
                <h2 class="no-margins">206 480</h2>
                <div id="sparkline1"></div>
            </div>


        </div>
        <div class="row">
            <div class="col-lg-5">
                @if ($user->user_type == 'Student')
                    <div class="ibox">
                        <div class="ibox-content">
                            <span class="text-muted small float-right">
                                Last modification: <i class="fa fa-clock-o"></i> {{ $user->updated_at }}
                            </span>
                            <h2>Course Units</h2>
                            <div class="clients-list">
                                <span class="float-right small text-muted">{{ $user->enrollments->course->course_units }}
                                    Units</span>
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
                                                        @forelse (\App\Models\CourseUnit::where('course_id', $user->enrollments->course_id)->where('unit_type', 'core')->get() as $item)
                                                            <tr>
                                                                <td width="10%">
                                                                    <input type="hidden" name="steps[]" value="1">
                                                                    <input type="checkbox" class="i-checks unit"
                                                                        name="units[]" value="{{ $item->unit_code }}"
                                                                        {{ !is_null($user->enrollments->core_units) && in_array($item->unit_code, $user->enrollments->core_units) ? 'checked' : '' }} />
                                                                </td>
                                                                <td width="90%">{{ $item->unit_code }} -
                                                                    {{ $item->unit_name }}
                                                                </td>
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
                                                        @forelse (\App\Models\CourseUnit::where('course_id', $user->enrollments->course_id)->where('unit_type', 'elective')->get() as $item)
                                                            <tr>
                                                                <td width="10%">
                                                                    <input type="hidden" name="steps[]" value="1">
                                                                    <input type="checkbox" class="i-checks unit"
                                                                        name="units[]" value="{{ $item->unit_code }}"
                                                                        {{ !is_null($user->enrollments->elective_units) && in_array($item->unit_code, $user->enrollments->elective_units) ? 'checked' : '' }} />
                                                                </td>
                                                                <td width="90%">{{ $item->unit_code }} -
                                                                    {{ $item->unit_name }}
                                                                </td>
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
                @endif
            </div>
            <div class="col-lg-3">
            </div>
            <div class="col-lg-4 m-b-lg">
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/admin/js/plugins/iCheck/icheck.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_polaris',
            });


            $('.i-checks').on("ifChecked", function() {
                var code = $(this).val();

                $.ajax({
                    url: "{{ route('admin.unit.assign', $user->id) }}",
                    method: "POST",
                    data: {
                        code: code
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status == 200) {
                            toastr.success(res.message);
                        } else if (res.status == 503) {
                            toastr.warning(res.message);
                        }
                    }
                })
            });

            $('.i-checks').on("ifUnchecked", function() {
                var code = $(this).val();

                $.ajax({
                    url: "{!! route('admin.remove.assign', $user->id) !!}",
                    method: "DELETE",
                    data: {
                        code: code
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status == 200) {
                            toastr.success(res.message);
                        } else if (res.status == 503) {
                            toastr.warning(res.message);
                        }
                    }
                })
            });
        });
    </script>
@endpush
