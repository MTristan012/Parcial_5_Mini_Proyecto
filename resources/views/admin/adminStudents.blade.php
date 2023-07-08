@extends('layouts.app')


@if(Auth::user()->permission == 1)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div>
            <h1>Teachers</h1>
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
                                <th>DNI</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Birthday</th>  
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->dni}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->birthday}}</td>
                                
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
                                    <a href="" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete{{ $user->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
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