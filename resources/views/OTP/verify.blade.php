@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Enter OTP</div>
                    @if (session('status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{route('postVerify')}}" method="post">
                            @csrf
                            <input type="number" name="otp" id="otp" class="form-control" required>
                            <input type="submit" class="btn btn-secondary">
                        </form>
                    </div>
                    <a href="{{route('logout')}}">logout</a>
                </div>
            </div>
        </div>
    </div>
@endsection
