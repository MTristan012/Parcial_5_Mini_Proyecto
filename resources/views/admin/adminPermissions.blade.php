@extends('layouts.app')


@if(Auth::user()->permission == 1)
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <h1>Permissions</h1>
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
    
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
    
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Email/User</th>
                                    <th>Permission</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @if($user->permission == 0)
                                        <span class="px-2" style="background-color:beige">No Role</span>
                                        @endif
                                        @if($user->permission == 1)
                                        <span class="px-2" style="background-color:yellow">Admin</span>
                                        @endif
                                        @if($user->permission == 2)
                                        <span class="px-2 text-white" style="background-color:crimson">Teacher</span>
                                        @endif
                                        @if($user->permission == 3)
                                        <span class="px-2 text-white" style="background-color:blue">Student</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->status == 0)
                                        <span class="px-2 text-white" style="background-color:red">Inactive</span>
                                        @endif
                                        @if($user->status == 1)
                                        <span class="px-2 text-white" style="background-color:green">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modalEdite{{ $user->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                    </td>
                                    <div class="modal fade" id="modalEdite{{ $user->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edite Permissions &
                                                        Status</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="POST">
                                                        @csrf
                                                        <div>
                                                            <div class="mb-3" hidden>
                                                                <label for="exampleInputEmail1"
                                                                    class="form-label">ID</label>
                                                                <input name="adminPermissionID" type="email"
                                                                    class="form-control" id="exampleInputEmail1"
                                                                    aria-describedby="emailHelp" value="{{$user->id}}"
                                                                    disabled />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1"
                                                                    class="form-label">Email</label>
                                                                <input name="adminPermissionEmail" type="email"
                                                                    class="form-control" id="exampleInputEmail1"
                                                                    aria-describedby="emailHelp" value="{{$user->email}}"
                                                                    disabled />
                                                            </div>
                                                            <div class="my-3">
                                                                <label for="adminPermissionPermission">Permissions</label>
                                                                <select name="adminPermissionPermission" class="form-select"
                                                                    aria-label="Default select example">
                                                                    <option @if($user->permission == 0)
                                                                        selected
                                                                        @endif>No Role</option>
                                                                    <option @if($user->permission == 1)
                                                                        selected
                                                                        @endif>Admin</option>
                                                                    <option @if($user->permission == 2)
                                                                        selected
                                                                        @endif>Teacher</option>
                                                                    <option @if($user->permission == 3)
                                                                        selected
                                                                        @endif>Student</option>
                                                                </select>
                                                            </div>
                                                            <div class="my-3">
                                                                <label for="adminPermissionStatus">Status</label>
                                                                <div class="form-check form-switch">
                                                                    <input name="adminPermissionStatus"
                                                                        class="form-check-input" type="checkbox"
                                                                        role="switch" id="flexSwitchCheckDefault"
                                                                        @if($user->status == 1)
                                                                    checked
                                                                    @endif>
                                                                    <label class="form-check-label"
                                                                        for="flexSwitchCheckDefault">Active</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex">
                                                            <input type="submit" class="btn btn-success" value="Accept" />
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
@endif
