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

                    {{ __('Students') }}
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
            
                    <form action="" method="POST">
                        <input type="hidden" name="studentID" value="{{Auth::user()->id}}">
                        <input type="hidden" name="student" value="{{Auth::user()->name}}">
                        <label for="" class="mb-3">Select the Class(es) to Enroll</label>
                        <select class="form-select" multiple aria-label="multiple select example" name="selectAlumnoInscribir">
                           @foreach($courses as $course)
                                <option value="{{$course->id.",".$course->class}}">{{$course->class}}</option>
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