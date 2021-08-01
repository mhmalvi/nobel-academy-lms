@if (auth()->user()->progress)
    <div class="row card-group-row">
        <div class="col-lg-3 col-md-4 card-group-row__col">
            <div class="card card-group-row__card">
                <div class="p-2 d-flex flex-row align-items-center">
                    <div class="avatar avatar-xs mr-2">
                        <span class="avatar-title rounded-circle text-center bg-success">
                            <i class="material-icons text-white icon-18pt">receipt</i>
                        </span>
                    </div>
                    <a href="{{ route('step', [auth()->user()->progress->course_unit_id, auth()->user()->progress->current_step]) }}"
                        class="text-dark">
                        <strong>Quick Study</strong>
                    </a>
                </div>
            </div>
        </div>
        @if (auth()->user()->classroomOfStudent)
            <div class="col-lg-3 col-md-4 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="p-2 d-flex flex-row align-items-center">
                        <div class="avatar avatar-xs mr-2">
                            <span class="avatar-title rounded-circle text-center bg-warning">
                                <i class="fa fa-book-open text-white icon-18pt"></i>
                            </span>
                        </div>
                        <a href="{{ route('class', auth()->user()->classroomOfStudent->uuid) }}" class="text-dark">
                            <strong>Class Room</strong>
                        </a>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-3 col-md-4 card-group-row__col">
            <div class="card card-group-row__card">
                <div class="p-2 d-flex flex-row align-items-center">
                    <div class="avatar avatar-xs mr-2">
                        <span class="avatar-title rounded-circle text-center bg-primary">
                            <i class="material-icons text-white icon-18pt">assignment</i>
                        </span>
                    </div>
                    <a href="{{ route('post.type', [auth()->user()->classroomOfStudent->uuid, 'assignment']) }}"
                        class="text-dark">
                        <strong>Assignments</strong>
                    </a>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-3 col-md-4 card-group-row__col">
            <div class="card card-group-row__card">
                <div class="p-2 d-flex flex-row align-items-center">
                    <div class="avatar avatar-xs mr-2">
                        <span class="avatar-title rounded-circle text-center bg-danger">
                            <i class="material-icons text-white icon-18pt">info</i>
                        </span>
                    </div>
                    <a href="#" class="text-dark">
                        <strong>Activities</strong>
                    </a>
                </div>
            </div>
        </div> --}}
    </div>
@endif
