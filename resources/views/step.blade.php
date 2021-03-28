<div>
    <!-- HEADING -->
    <div class="d-flex align-items-center">
        <div class="flex">
            <h1 class="mb-2">{{$step->step_name}}</h1>
        </div>
        <div>
            <a href="" class="btn btn-outline-success">
                Mark as complete <i class="material-icons ml-2">check</i>
            </a>
        </div>
    </div>
    <!-- END -->

    <div class="mt-4 mb-2">
        <h6 class="text-dark-gray">OVERVIEW</h6>

        <div class="py-2">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quia rerum unde corrupti eaque architecto, quas magni, eius eum nam, optio obcaecati inventore neque. Aperiam eum culpa quam atque fuga natus.
            {{-- @php
                echo $step->descriptions
            @endphp --}}
        </div>
    </div>


    <div class="mt-4 mb-2">
        <h6 class="text-dark-gray py-2">RESOURCES</h6>

        <div class="card">
            <ul class="list-group list-lessons">
                <li class="list-group-item d-flex">
                    <a href=""><i class="fa fa-file-alt pr-2"></i> Wireframe</a>
                    <div class="ml-auto d-flex align-items-center">
                        <span class="text-muted"><i class="material-icons icon-16pt icon-light">file_download</i></span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>