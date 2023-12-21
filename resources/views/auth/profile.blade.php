<!-- profile.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="name">Ma Sv:</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $user->student_code }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="name">Ngay sinh:</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $user->birthdate }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" readonly>
                        </div>

                        <!-- Hiển thị các thông tin cá nhân khác tại đây -->

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection