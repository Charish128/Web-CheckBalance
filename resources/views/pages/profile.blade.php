@extends('includes.layout')
@section('content')
<br>
<div class="container " >
    <div class="card">
        <div class="card-header">
            <h4>Update Profile</h4>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session()->get('success')}}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error')}}
                </div>
            @endif
            <form action="{{ url('update_profile') }}" method="POST">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ session('nama') }}" required id="">
                @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Nama</label>
                <input type="email" name="email" class="form-control" value="{{ session('email') }}" required id="">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-primary" type="submit">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection