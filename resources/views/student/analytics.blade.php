@if (!is_null($lastProgress))
    <div class="card card-group-row__card card-body flex-row align-items-center">
        <div class="position-relative mr-2">
            <div class="text-center fullbleed d-flex align-items-center justify-content-center flex-column z-0">
                <h4 class="text-danger mb-0">
                    @php
                        $lastStep = $lastProgress->complete_step == 0 ? 1 : $lastProgress->complete_step;
                        $complete = count($progress) * $lastStep;
                        $total = ($complete / ($course->course_units * 5)) * 100;
                    @endphp

                    {{ number_format((float) $total, 2, '.', '') }}%
                </h4>
                <small class="text-uppercase">Progress</small>
            </div>
            <canvas width="90" height="90" class="position-relative z-1" data-toggle="progress-chart"
                data-progress-chart-value="{{ number_format((float) $total, 2, '.', '') }}"
                data-progress-chart-color="danger" data-progress-chart-tone="300"></canvas>
        </div>
        <div class="flex">
            <div class="text-amount">Total {{ $course->course_units }}</div>
            <div class="text-muted mt-1">Course Units</div>
        </div>
    </div>
@endif
