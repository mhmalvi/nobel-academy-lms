@extends('layouts.app')

@section('title', 'Classroom')

@section('content')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-end">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="material-icons icon-20pt">home</i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Class</li>
                    </ol>
                </nav>
                <h1 class="m-0">Class</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-md-3">
                <ul class="list-group">
                    <li class="list-group-item {{ Route::currentRouteName() === 'class' ? 'active' : '' }}"><a
                            class="{{ Route::currentRouteName() === 'class' ? 'text-white' : '' }}"
                            href="{{ route('class', $classroom->uuid) }}"><strong>All
                                Topics</strong></a>
                    </li>
                    <li class="list-group-item {{ request()->segment(3) === 'post' ? 'active' : '' }}"><a
                            class="{{ request()->segment(3) === 'post' ? 'text-white' : '' }}"
                            href="{{ route('post.type', [$classroom->uuid, 'post']) }}"><strong>Posts</strong></a>
                    </li>
                    <li class="list-group-item {{ request()->segment(3) === 'assignment' ? 'active' : '' }}"><a
                            class="{{ request()->segment(3) === 'assignment' ? 'text-white' : '' }}"
                            href="{{ route('post.type', [$classroom->uuid, 'assignment']) }}"><strong>Assignments</strong></a>
                    </li>
                    <li class="list-group-item {{ request()->segment(3) === 'material' ? 'active' : '' }}"><a
                            class="{{ request()->segment(3) === 'material' ? 'text-white' : '' }}"
                            href="{{ route('post.type', [$classroom->uuid, 'material']) }}"><strong>Materials</strong></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="stories-cards mb-4">
                    @if (auth()->user()->user_type == 'Teacher')
                        <div class="collapse mb-4" id="createPost">
                            <form action="{{ route('post', $classroom->uuid) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <select name="type" class="form-control" id="postType">
                                        <option value disabled selected>Select post type</option>
                                        <option value="post" {{ old('type') === 'post' ? 'selected' : '' }}>Discussion
                                        </option>
                                        <option value="assignment" {{ old('type') === 'assignment' ? 'selected' : '' }}>
                                            Assignment
                                        </option>
                                        <option value="material" {{ old('type') === 'material' ? 'selected' : '' }}>
                                            Material
                                        </option>
                                    </select>
                                    @error('type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <textarea name="post" rows="5" class="form-control"
                                        placeholder="Announce somthing to your class"
                                        style="resize: none;">{{ old('post') }}</textarea>

                                    @error('post')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group d-none" id="addFile">
                                    <input type="file" name="file[]" id="file" class="form-control" multiple>
                                    @error('file')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary px-4">Post</button>
                                <button type="button" class="btn btn-light ml-2" id="canclePost">Cancle</button>
                            </form>
                        </div>
                        @if ($posts->count() > 0)
                            <div class="card createPostCard">
                                <div class="d-flex align-items-center flex-wrap">
                                    <div class="m-4">
                                        <a href="#" class="d-flex align-items-center text-muted">
                                            <!-- LOGO -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48">
                                                <g stroke="currentColor" fill="none" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path
                                                        d="M26.09 37.272l-7.424 1.06 1.06-7.424 19.092-19.092c1.758-1.758 4.606-1.758 6.364 0s1.758 4.606 0 6.364L26.09 37.272zM12 1.498h12c.828 0 1.5.672 1.5 1.5v3c0 .828-.672 1.5-1.5 1.5H12c-.828 0-1.5-.672-1.5-1.5v-3c0-.828.672-1.5 1.5-1.5zM25.5 4.498h6c1.656 0 3 1.344 3 3"
                                                        stroke-width="3"></path>
                                                    <path
                                                        d="M34.5 37.498v6c0 1.656-1.344 3-3 3h-27c-1.656 0-3-1.344-3-3v-36c0-1.656 1.344-3 3-3h6M10.5 16.498h15M10.5 25.498h6"
                                                        stroke-width="3"></path>
                                                </g>
                                            </svg>

                                        </a>
                                    </div>
                                    <div class="stories-card__title flex">
                                        <h5 class="card-title m-0">
                                            Communicate with your class here
                                        </h5>
                                        <small class="text-muted">
                                            <a id="toggleCollapesBar" class="text-primary" role="button"
                                                aria-expanded="false" aria-controls="createPost">
                                                <strong>Create Announcement</strong>
                                            </a>
                                            <strong>, give assignment and share study materials</strong>
                                        </small>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center">
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif

                    {{-- Post Topics --}}
                    @forelse ($posts as $post)
                        <div class="card p-4">
                            <div class="row">
                                <div class="col-md-2 d-flex flex-column justify-content-center align-items-center">
                                    <div class="text-muted">
                                        <!-- LOGO -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48">
                                            <g stroke="currentColor" fill="none" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path
                                                    d="M26.09 37.272l-7.424 1.06 1.06-7.424 19.092-19.092c1.758-1.758 4.606-1.758 6.364 0s1.758 4.606 0 6.364L26.09 37.272zM12 1.498h12c.828 0 1.5.672 1.5 1.5v3c0 .828-.672 1.5-1.5 1.5H12c-.828 0-1.5-.672-1.5-1.5v-3c0-.828.672-1.5 1.5-1.5zM25.5 4.498h6c1.656 0 3 1.344 3 3"
                                                    stroke-width="3"></path>
                                                <path
                                                    d="M34.5 37.498v6c0 1.656-1.344 3-3 3h-27c-1.656 0-3-1.344-3-3v-36c0-1.656 1.344-3 3-3h6M10.5 16.498h15M10.5 25.498h6"
                                                    stroke-width="3"></path>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <p class="text-justify">
                                        {{ $post->post }}
                                    </p>

                                    @if ($post->files->count() > 0)
                                        <ul class="list-group mb-3">
                                            @forelse ($post->files as $item)
                                                <li class="list-group-item">
                                                    <span class="text-primary">
                                                        <i class="material-icons icon-16pt icon-dark">file_download</i>
                                                    </span>&nbsp;
                                                    <a href="{{ route('download.file', ['posts', $item->file_name]) }}">
                                                        {{ $item->file_name }}
                                                    </a>
                                                </li>
                                            @empty
                                                <li class="list-group-item d-flex">
                                                    No File Found!
                                                </li>
                                            @endforelse
                                        </ul>
                                    @endif

                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted">
                                            <strong>{{ $post->user->name }}</strong> posted {{ $post->created_at }}
                                        </small>
                                        @auth
                                            @if (auth()->user()->id == $post->user_id)
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle text-muted" data-caret="false" href="#"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                            class="material-icons icon-16pt">settings</i></a>

                                                    <div class="dropdown-menu dropdown-menu-right" style="display: none;">
                                                        <a class="dropdown-item d-flex align-items-center"
                                                            href="{{ route('delete.post', $post->uuid) }}">
                                                            <i class="material-icons icon-16pt mr-2">delete</i>
                                                            <span>Remove {{ $post->type }}</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            @if (auth()->user()->user_type == 'Teacher')
                                <div class="card createPostCard">
                                    <div class="d-flex align-items-center flex-wrap">
                                        <div class="m-4">
                                            <a href="#" class="d-flex align-items-center text-muted">
                                                <!-- LOGO -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48">
                                                    <g stroke="currentColor" fill="none" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path
                                                            d="M26.09 37.272l-7.424 1.06 1.06-7.424 19.092-19.092c1.758-1.758 4.606-1.758 6.364 0s1.758 4.606 0 6.364L26.09 37.272zM12 1.498h12c.828 0 1.5.672 1.5 1.5v3c0 .828-.672 1.5-1.5 1.5H12c-.828 0-1.5-.672-1.5-1.5v-3c0-.828.672-1.5 1.5-1.5zM25.5 4.498h6c1.656 0 3 1.344 3 3"
                                                            stroke-width="3"></path>
                                                        <path
                                                            d="M34.5 37.498v6c0 1.656-1.344 3-3 3h-27c-1.656 0-3-1.344-3-3v-36c0-1.656 1.344-3 3-3h6M10.5 16.498h15M10.5 25.498h6"
                                                            stroke-width="3"></path>
                                                    </g>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="stories-card__title flex">
                                            <h5 class="card-title m-0">
                                                Communicate with your class here
                                            </h5>
                                            <small class="text-muted">
                                                <a id="toggleCollapesBar" class="text-primary" role="button"
                                                    aria-expanded="false" aria-controls="createPost">
                                                    <strong>Create Announcement</strong>
                                                </a>
                                                <strong>, give assignment and share study materials</strong>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="card createPostCard">
                                    <div class="d-flex align-items-center flex-wrap">
                                        <div class="m-4">
                                            <a href="#" class="d-flex align-items-center text-muted">
                                                <!-- LOGO -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48">
                                                    <g stroke="currentColor" fill="none" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path
                                                            d="M26.09 37.272l-7.424 1.06 1.06-7.424 19.092-19.092c1.758-1.758 4.606-1.758 6.364 0s1.758 4.606 0 6.364L26.09 37.272zM12 1.498h12c.828 0 1.5.672 1.5 1.5v3c0 .828-.672 1.5-1.5 1.5H12c-.828 0-1.5-.672-1.5-1.5v-3c0-.828.672-1.5 1.5-1.5zM25.5 4.498h6c1.656 0 3 1.344 3 3"
                                                            stroke-width="3"></path>
                                                        <path
                                                            d="M34.5 37.498v6c0 1.656-1.344 3-3 3h-27c-1.656 0-3-1.344-3-3v-36c0-1.656 1.344-3 3-3h6M10.5 16.498h15M10.5 25.498h6"
                                                            stroke-width="3"></path>
                                                    </g>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="stories-card__title flex">
                                            <h5 class="card-title m-0">
                                                Your class announcements, materials and assignments
                                            </h5>
                                            <small class="text-muted">
                                                No announcements posted yet!
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforelse

                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('js')
        <script>
            $(document).ready(function() {
                var post = $("#postType").val();
                tiggerFile(post);

                $("#postType").on("change", function() {
                    var post = $(this).val();
                    tiggerFile(post);
                });

                $("#toggleCollapesBar").on("click", function() {
                    triggerCollapse();
                })

                $("#canclePost").on("click", function() {
                    triggerCollapse();
                });

                function tiggerFile(post) {
                    if (post == 'assignment' || post == 'material') {
                        $("#addFile").removeClass('d-none').hide().slideDown('slow');
                    } else {
                        $("#addFile").addClass('d-none');
                    }
                }

                function triggerCollapse() {
                    $("#createPost").collapse('toggle');
                    $(".createPostCard").toggleClass('d-none');
                }
            })
        </script>

        @if (Session::has('errors'))
            <script>
                $(document).ready(function() {
                    $("#createPost").collapse('toggle');
                    $(".createPostCard").toggleClass('d-none');
                })
            </script>
        @endif
    @endpush
