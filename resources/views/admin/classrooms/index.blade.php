<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>
            Class Rooms

            <a class="btn btn-sm btn-primary" href="{{ route('admin.classroom.create') }}">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                Create Classroom
            </a>
        </h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeIn">
    @forelse ($classes->chunk(4) as $items)
        <div class="row">
            @foreach ($items as $item)
                <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">
                            <div class="product-imitation p-0">
                                <img src="{{ asset('assets/admin/placeholder-image.png') }}" alt="thumbnail"
                                    class="img-fluid">
                            </div>
                            <div class="product-desc">
                                <span class="product-price">
                                    {{ $item->section }}
                                </span>
                                <small class="text-muted">{{ $item->created_at }}</small>
                                <a href="#" class="product-name">{{ $item->name }}</a>
                                <div class="small m-t-xs">
                                    {{ $item->course->course() }}
                                </div>
                                <div class="m-t text-righ">

                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i
                                            class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <div class="no-record">
            <i class="fa fa-info-circle" aria-hidden="true"></i>
            <h4>No classroom created yet!</h4>
        </div>
    @endforelse
</div>
