@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Hi, {{auth()->guard('admin')->user()->name}}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div style="margin-left: auto;margin-right:auto;height:50px;">
                        <a href="{{ url('admin/adminEditTest') }}">Edit Tests</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection