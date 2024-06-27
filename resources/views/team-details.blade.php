<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Team Details | QuillForge
    </title>

    @include('common.header')
    <style>
        .topics::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('common.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('common.navbar')

        <!-- End Navbar -->
        <div class="container-fluid py-4">
            {{-- MAIN CONTENT --}}
            <div class="container-fluid px-3">
                <nav aria-label="breadcrumb" class="d-flex justify-content-between">
                    <p class="h4 font-weight-bolder">{{ $team['team_name'] ?? '-' }}</p>
                    <div>
                        @if (session('user_id') == $team['leader_id'])
                            <button class="btn btn-success" type="button" data-bs-target="#create-team"
                                data-bs-toggle="offcanvas" aria-controls="offcanvasEnd">Create New Topic</button>
                        @endif
                        <button type="button" class="btn btn-info" data-bs-toggle="offcanvas"
                            data-bs-target="#members">
                            <i class="fa-solid fa-users"></i>
                        </button>
                        @if (session('user_id') == $team['leader_id'])
                            <button type="button" class="btn btn-info" data-bs-target="#notifications"
                                data-bs-toggle="modal">
                                <i class="fa-regular fa-bell"></i>
                            </button>
                        @endif
                    </div>
                    {{-- MODALS --}}
                    <!-- Modal -->
                    @if (session('user_id') == $team['leader_id'])
                        <div class="modal fade" id="notifications" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Join Requests
                                        </h5>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container w-100">
                                            @if (isset($request))
                                                @foreach ($request as $key)
                                                    <div class="row card p-3 border ">
                                                        <div class="d-inline-flex justify-content-between">
                                                            <div>
                                                                {{ $key->user->first_name . ' ' . $key->user?->last_name . ' wants to join ' . $team['team_name'] }}
                                                            </div>
                                                            <div>
                                                                <a
                                                                    href="{{ url('u/team/request/accept') . '/' . $team['id'] . '/' . $key['user_id'] }}">
                                                                    <span class="badge bg-success"
                                                                        style="cursor: pointer;">
                                                                        <i class="fa-solid fa-check"></i>
                                                                    </span>
                                                                </a>
                                                                <a
                                                                    href="{{ url('u/team/request/reject') . '/' . $team['id'] . '/' . $key['user_id'] }}">
                                                                    <span class="badge bg-danger"
                                                                        style="cursor: pointer;">
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal"><i
                                                class="fa-solid fa-xmark"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (session('user_id') == $team['leader_id'])
                        {{-- OFFCANVAS --}}
                        <div class="offcanvas offcanvas-end {{ $errors->any() ? ($errors->has('join-error') ? '' : 'show') : '' }}"
                            tabindex="-1" id="create-team" aria-labelledby="offcanvasEndLabel">
                            <div class="offcanvas-header">
                                <h5 id="offcanvasEndLabel" class="offcanvas-title">Create a New Topic</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <hr class="dark horizontal mt-0 mb-0">
                            <form action="{{ url('u/topic/create') }}" method="post">
                                @csrf
                                <div class="offcanvas-body mx-0 flex-grow-0">
                                    <input type="hidden" name="team_id" value="{{ $team['team_id'] }}">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Topic Name</label>
                                        <input class="form-control" type="text" name="title" id="team_name">
                                    </div>
                                    @error('title')
                                        <div class="p-0 mt-0 mb-2 text-sm text-danger">{{ $message }}</div>
                                    @enderror
                                    @error('name-error')
                                        <div class="p-0 mt-0 mb-2 text-sm text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Synopsis</label>
                                        <input class="form-control" type="text" name="description"
                                            id="team_description">
                                    </div>
                                    @error('description')
                                        <div class="p-0 mt-0 mb-2 text-sm text-danger">{{ $message }}</div>
                                    @enderror

                                    <button type="submit" class="btn btn-success d-grid mb-2 w-100">Create</button>
                                    <button type="button" class="btn btn-label-success border d-grid w-100"
                                        data-bs-dismiss="offcanvas">Cancel</button>
                                </div>
                            </form>
                        </div>
                    @endif

                    <div class="offcanvas offcanvas-end {{ $errors->any() ? ($errors->has('join-error') ? 'show' : ($errors->has('team_id') ? 'show' : '')) : '' }}"
                        tabindex="-1" id="members" aria-labelledby="offcanvasEndLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasEndLabel" class="offcanvas-title">Members</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <hr class="dark horizontal mt-0 mb-0">
                        <div class="offcanvas-body mx-0 flex-grow-0">
                            <div class="container w-100">
                                @isset($data['member'])
                                    @foreach ($data['member'] as $key)
                                        <div class="row card p-3 border mb-1">
                                            <div class="d-inline-flex justify-content-between">
                                                <div>
                                                    {{-- <div>{{ str_split($key->user?->first_name)[0] }}</div> --}}
                                                        <span
                                                            class="bg-grey border rounded-circle d-inline-flex justify-content-center align-items-center" style="margin-right: 9px; width: 30px; height:30px;">{{ str_split($key->user?->first_name)[0] ?? '?' }}
                                                        </span>
                                                    <span class="text-dark">{{ $key->user?->first_name }}</span>
                                                    <div class="text-sm">{{ $key['role'] == 1 ? 'Leader' : 'Member' }}
                                                    </div>
                                                </div>
                                                @if (session('user_id') == $team['leader_id'])
                                                    @if ($key['user_id'] != session('user_id'))
                                                        <div class="kick" data-id="{{ $key['id'] }}">
                                                            <span class="badge bg-danger" style="cursor: pointer;">
                                                                kick
                                                            </span>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endisset
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="row">
                {{-- <div class="text-center mt-5">
                      <h5 class="text-dark">No Teams, Create a New One!</h5>
                    </div> --}}
                <div class="{{-- col-lg-4 col-md-6 mt-1 mb-4 --}}w-50">
                    <div class="card z-index-2">
                        <div class="card-header pt-4 pb-0 mb-0 text-dark h4">
                            Topics
                        </div>
                        <hr class="dark horizontal mb-0">
                        <div class="container overflow-auto topics" style="max-height: 360px !important;">
                            @isset($data['topic'])
                                @foreach ($data['topic'] as $key)
                                    <div class="row my-2 mx-1">
                                        <div class="card z-index-4 border">
                                            <div class="d-inline-flex justify-content-between mt-3">
                                                <div class="h5 text-start mb-0 pt-0">{{ $key['title'] }}</div>
                                                <div class="d-inline-flex justify-content-between">
                                                    <span
                                                        class="badge badge-pill bg-gradient-{{ $key['status'] == 0 ? 'success' : ($key['status'] == 1 ? 'warning' : 'info   ') }} w-100 mx-2">
                                                        {{ $key['status'] == 0 ? 'Not taken' : ($key['status'] == 1 ? 'Taken' : 'Completed') }}
                                                    </span>
                                                    @if ($key['status'] == 0)
                                                        <a href="javascript:0;" class="mx-1 take"
                                                            data-id="{{ $key['id'] }}">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-body text-sm px-1">
                                                {{ $key['description'] }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @else 
                                <div class="text-center mt-5">
                                    <h5 class="text-dark">No Topics.</h5>
                                </div>
                            @endisset

                            </tbody>
                            </table>
                            {{-- <h6 class="mb-0 ">Team Name </h6>
                                <p class="text-sm">
                                    Creator: AB
                                </p>
                                <hr class="dark horizontal">
                                <div class="d-flex flex-column">
                                    <div class="col-md-10">
                                        <i class="fa-solid fa-people-group"></i>
                                        <span class="mb-0 text-sm"> 7</span>
                                        <span class="mb-0 text-sm">Members</span>
                                    </div>
                                    <div class="col-md-10">
                                        <i class="fa-regular fa-clock"></i>
                                        <span class="mb-0 text-sm"> updated 4 min ago </span>
                                    </div>
                                </div> --}}
                        </div>
                        <div class="card-footer pt-4 pb-0 mb-0 text-dark">
                        </div>
                    </div>
                </div>

                <div class="{{-- col-lg-4 col-md-6 mt-1 mb-4 --}}w-50">
                    <div class="card z-index-2">
                        <div class="card-header pt-4 pb-0 mb-0 text-dark h4">
                            Your Topics
                        </div>
                        <hr class="dark horizontal mb-0">
                        <div class="container overflow-auto topics" style="max-height: 480px !important;">
                            @isset($data['your_topic'])
                                @foreach ($data['your_topic'] as $key)
                                    <div class="row my-2 mx-1">
                                        <div class="card z-index-4 border">
                                            <div class="d-inline-flex justify-content-between mt-3">
                                                <div class="h5 text-start mb-0 pt-0">{{ $key['title'] }}</div>
                                                <div class="d-inline-flex justify-content-between">
                                                    <span
                                                        class="badge badge-pill bg-gradient-{{ $key['status'] == 0 ? 'success' : ($key['status'] == 1 ? 'warning' : 'info   ') }} w-100 mx-2">{{ $key['status'] == 0 ? 'Not taken' : ($key['status'] == 1 ? 'Taken' : 'Completed') }}</span>
                                                    <a href="javascript:0;" class="mx-1">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                    <li class="dropdown pe-2 mx-2 z-index-70"
                                                        style="list-style: none; z-index: 60;">
                                                        <a href="javascript:;" class="nav-link " id="dropdownMenuButton"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4"
                                                            aria-labelledby="dropdownMenuButton">
                                                            <li class="mb-2">
                                                                <a class="dropdown-item border-radius-md"
                                                                    href="{{ url('u/editor/b') . '/' . $key->book?->book_id ?? '-' }}">
                                                                    <div class="d-flex align-items-center py-1">
                                                                        <div class="my-auto">
                                                                            <span>
                                                                                <i class="fa-regular fa-pen-to-square"></i>
                                                                            </span>
                                                                        </div>
                                                                        <div class="ms-2">
                                                                            <h6 class="text-sm font-weight-normal mb-0">
                                                                                Edit
                                                                            </h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li class="mb-2">
                                                                <a class="dropdown-item border-radius-md forfeit"
                                                                    href="javascript:0;" data-id="{{ $key['id'] }}">
                                                                    <div class="d-flex align-items-center py-1 ">
                                                                        <div class="my-auto">
                                                                            <span>
                                                                                <i class="fa-solid fa-xmark"></i>
                                                                            </span>
                                                                        </div>
                                                                        <div class="ms-2">
                                                                            <h6 class="text-sm font-weight-normal mb-0">
                                                                                Forfeit
                                                                            </h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li class="mb-2">
                                                                <a class="dropdown-item border-radius-md complete"
                                                                    href="javascript:0;" data-id="{{ $key['id'] }}">
                                                                    <div class="d-flex align-items-center py-1">
                                                                        <div class="my-auto">
                                                                            <span>
                                                                                <i class="fa-solid fa-book"></i>
                                                                            </span>
                                                                        </div>
                                                                        <div class="ms-2">
                                                                            <h6 class="text-sm font-weight-normal mb-0">
                                                                                Mark as Complete
                                                                            </h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="card-body text-sm px-1">
                                                {{ $key['description'] }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @else 
                                <div class="text-center mt-5">
                                    <h5 class="text-dark">No Topics.</h5>
                                </div>
                            @endisset
                            </tbody>
                            </table>
                            {{-- <h6 class="mb-0 ">Team Name </h6>
                                <p class="text-sm">
                                    Creator: AB
                                </p>
                                <hr class="dark horizontal">
                                <div class="d-flex flex-column">
                                    <div class="col-md-10">
                                        <i class="fa-solid fa-people-group"></i>
                                        <span class="mb-0 text-sm"> 7</span>
                                        <span class="mb-0 text-sm">Members</span>
                                    </div>
                                    <div class="col-md-10">
                                        <i class="fa-regular fa-clock"></i>
                                        <span class="mb-0 text-sm"> updated 4 min ago </span>
                                    </div>
                                </div> --}}
                        </div>
                        <div class="card-footer pt-4 pb-0 mb-0 text-dark">
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>

    @include('common.footer')
</body>

</html>
<script>
    $(document).on("click", ".take", function() {
        console.log("triggered");
        let token = '@csrf';
        token = token.substr(42, 40);
        var thisID = $(this).attr('data-id');

        $.ajax({
            type: "POST",
            url: "{{ url('api/topic/take') }}",
            dataType: "json",
            data: {
                "_token": token,
                "id": thisID,
            },
            cache: true,
            success: function(response) {
                if (response.statusCode == 200) {
                    success_toastr('Topic Taken.');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else if (response.statusCode == '401') {
                    error_toastr(response.msg);
                    setTimeout(function() {
                        window.location = response.redirect;
                    }, 1000);
                } else {
                    error_toastr(response.msg);
                }
            },
            error: function(err) {
                response = JSON.parse(err.responseText);

                if (response.statusCode == '401') {
                    error_toastr(response.msg);
                    setTimeout(function() {
                        window.location = response.redirect;
                    }, 1000);
                } else {
                    toastr['error']('something went wrong please try again', '', {
                        timeOut: 2000
                    });
                }
            }
        });
    });

    $(document).on("click", ".forfeit", function() {
        console.log("triggered");
        let token = '@csrf';
        token = token.substr(42, 40);
        var thisID = $(this).attr('data-id');

        $.ajax({
            type: "POST",
            url: "{{ url('api/topic/forfeit') }}",
            dataType: "json",
            data: {
                "_token": token,
                "id": thisID,
            },
            cache: true,
            success: function(response) {
                if (response.statusCode == 200) {
                    success_toastr('Topic Updated.');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else if (response.statusCode == '401') {
                    error_toastr(response.msg);
                    setTimeout(function() {
                        window.location = response.redirect;
                    }, 1000);
                } else {
                    error_toastr(response.msg);
                }
            },
            error: function(err) {
                response = JSON.parse(err.responseText);

                if (response.statusCode == '401') {
                    error_toastr(response.msg);
                    setTimeout(function() {
                        window.location = response.redirect;
                    }, 1000);
                } else {
                    toastr['error']('something went wrong please try again', '', {
                        timeOut: 2000
                    });
                }
            }
        });
    });

    $(document).on("click", ".complete", function() {
        console.log("triggered");
        let token = '@csrf';
        token = token.substr(42, 40);
        var thisID = $(this).attr('data-id');

        $.ajax({
            type: "POST",
            url: "{{ url('api/topic/complete') }}",
            dataType: "json",
            data: {
                "_token": token,
                "id": thisID,
            },
            cache: true,
            success: function(response) {
                if (response.statusCode == 200) {
                    success_toastr('Topic Updated.');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else if (response.statusCode == '401') {
                    error_toastr(response.msg);
                    setTimeout(function() {
                        window.location = response.redirect;
                    }, 1000);
                } else {
                    error_toastr(response.msg);
                }
            },
            error: function(err) {
                response = JSON.parse(err.responseText);

                if (response.statusCode == '401') {
                    error_toastr(response.msg);
                    setTimeout(function() {
                        window.location = response.redirect;
                    }, 1000);
                } else {
                    toastr['error']('something went wrong please try again', '', {
                        timeOut: 2000
                    });
                }
            }
        });
    });

    $(document).on("click", ".kick", function() {
        console.log("triggered");
        let token = '@csrf';
        token = token.substr(42, 40);
        var thisID = $(this).attr('data-id');

        $.ajax({
            type: "POST",
            url: "{{ url('api/team/kick') }}",
            dataType: "json",
            data: {
                "_token": token,
                "id": thisID,
            },
            cache: true,
            success: function(response) {
                if (response.statusCode == 200) {
                    success_toastr('Member kicked.');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else if (response.statusCode == '401') {
                    error_toastr(response.msg);
                    setTimeout(function() {
                        window.location = response.redirect;
                    }, 1000);
                } else {
                    error_toastr(response.msg);
                }
            },
            error: function(err) {
                response = JSON.parse(err.responseText);

                if (response.statusCode == '401') {
                    error_toastr(response.msg);
                    setTimeout(function() {
                        window.location = response.redirect;
                    }, 1000);
                } else {
                    toastr['error']('something went wrong please try again', '', {
                        timeOut: 2000
                    });
                }
            }
        });
    });
</script>
