@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex gap-2">
            <div class="card col-6 col-lg-8">
                <div class="card-header">{{ __('Dashboard') }}</div>

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
                                    <th>Drop Out</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @php
                                $x = 1;
                                @endphp
                                @foreach($inscriptions as $inscription)
                                <tr>
                                    <td>
                                        @php
                                        echo $x;
                                        $x++;
                                        @endphp
                                    </td>
                                    <td>{{$inscription->class}}</td>
                                    <td>
                                        <a href="" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $inscription->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                            </svg>
                                        </a>
                                    </td>
                                    <div class="modal fade" id="modalDelete{{ $inscription->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Drop Out
                                                        Class: {{$inscription->class}}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('inscription.delete')}}" method="POST">
                                                        @csrf
                                                        <div>
                                                            <div class="mb-3" hidden>
                                                                <input type="hidden" name="studentID" value="{{Auth::user()->id}}">
                                                                <input type="hidden" name="student" value="{{Auth::user()->name}}">
                                                                <label for="exampleInputEmail1" class="form-label">ID</label>
                                                                <input name="inscriptionID" type="hidden" class="form-control"
                                                                    id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                    value="{{$inscription->id}}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="d-flex">
                                                            <input type="submit" class="btn btn-danger" value="Drop Out"
                                                                name="adminClassDelete" />
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
            <div class="card col">
                <div class="card-header">{{ __('Add Classes') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{route('inscription.create')}}" method="POST">
                        @csrf
                        <input type="hidden" name="studentID" value="{{Auth::user()->id}}">
                        <input type="hidden" name="student" value="{{Auth::user()->name}}">
                        <label for="" class="mb-3">Select the Class(es) to Enroll</label>
                        <select class="form-select" multiple aria-label="multiple select example"
                            name="selectAlumnoInscribir">
                            @foreach($courses as $course)
                            <option value="{{$course->id." ,".$course->class}}">{{$course->class}}</option>
                            @endforeach
                        </select>
                        <input type="submit" class="btn btn-success my-3" value="Enroll" name="studentEnroll" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection