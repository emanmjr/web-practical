@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3>Users</h3>
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('home') }}">Go to Dashboard</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <users :users="{{ $users }}"></users>
            </div>
        </div>
    </div>
</div>
@endsection
