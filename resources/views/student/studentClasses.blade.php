@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div>
            <div class="card col-8 col-lg-10">
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
            <div class="card">
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
        </div>
    </div>
</div>
@endsection