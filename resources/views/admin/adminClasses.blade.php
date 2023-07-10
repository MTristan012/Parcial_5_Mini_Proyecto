@extends('layouts.app')


@if(Auth::user()->permission == 1)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div>
            <h1>Classes</h1>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}
                    <div class="d-flex justify-content-end">
                    
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClassModal">
                            Add Class
                        </button>
                    
                        <div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Class's Information</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('course.create')}}" method="POST">
                                            @csrf
                                            <div>
                                                <div class="mb-3">
                                                    <label for="InputClass" class="form-label">Class</label>
                                                    <input name="adminNewClassesClass" type="text" class="form-control" id="InputClass" aria-describedby="emailHelp" />
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-between ">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-success" value="Add Class" name="adminNewClassAccept" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if (session('Correct'))
                    <div class="alert alert-success">{{ session('Correct') }}</div>
                    @endif

                    @if (session('Incorrect'))
                    <div class="alert alert-danger">{{ session('Incorrect') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Class</th>
                                    <th>Teacher</th>
                                    <th>Enrolled Students</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @php
                                $x = 1;
                                @endphp
                                @foreach($courses as $course)
                                <tr>
                                    <td>
                                        @php
                                        echo $x;
                                        $x++;
                                        @endphp
                                    </td>
                                    <td>{{$course->class}}</td>
                                    <td>{{$course->teacher}}</td>
                                    <td></td>
                                    <td>
                                        <a href="" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $course->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                        @if($course->class === NULL || $course->class == "")
                                        <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $course->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                            </svg>
                                        </a>
                                        @endif
                                    </td>
                                    <div class="modal fade" id="modalEdit{{ $course->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit
                                                        Class: {{$course->class}}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('course.update')}}" method="POST">
                                                        @csrf
                                                        <div>
                                                            <div class="mb-3" hidden>
                                                                <label for="InputID" class="form-label">ID</label>
                                                                <input name="adminClassesID" type="hidden"
                                                                    class="form-control" id="InputID"
                                                                    aria-describedby="emailHelp"
                                                                    value="{{$course->id}}" />
                                                            </div>
                                                            <div class="mb-3" hidden>
                                                                <label for="InputID" class="form-label">TeacherID</label>
                                                                <input name="adminClassesOldTeacher" type="hidden" class="form-control" id="InputID" aria-describedby="emailHelp"
                                                                    value="{{ is_null($course->teacherID) ? NULL : $course->teacherID . ',' . $course->teacher }}" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="InputClass" class="form-label">Class</label>
                                                                <input name="adminClassesClass" type="text"
                                                                    class="form-control" id="InputClass"
                                                                    aria-describedby="emailHelp"
                                                                    value="{{$course->class}}" />
                                                            </div>
                                                            <div class="my-3">
                                                                <label for="adminClassesTeacher">Assigned Teacher</label>
                                                                <select name="adminClassesTeacher" class="form-select" aria-label="Default select example">
                                                                    @if($course->teacherID === NULL)
                                                                    <option value="{{NULL}}" selected>Unassigned</option>
                                                                    @else
                                                                    <option value="{{NULL}}">Unassigned</option>
                                                                    <option value="{{$course->teacherID. "," .$course->teacher}}" selected>{{$course->teacher}}</option>
                                                                    @endif
                                                                    @foreach($users as $user)
                                                                    <option value="{{$user->id. "," .$user->name}}" @if($course->class == $user->class) selected @endif>{{ $user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex">
                                                            <input type="submit" class="btn btn-success" value="Accept"
                                                                name="adminClassAccept" />
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
</div>
@endsection
@endif