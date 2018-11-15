
@extends('layouts.admin')

@section('title')
    Registracija
@endsection

@section('appendCss')
    @parent
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
@endsection

@section('content')
<!-- Sadrzaj -->
        <div class="col-md-8">
            
            <h3>Registracija</h3>
             @empty(!session('message'))
              {{ session('message') }}
             @endempty

            @isset($errors)
              @if($errors->any())
                @foreach($errors->all() as $error)
                  <div class="alert alert-danger"> {{ $error }} </div>
                @endforeach
              @endif
            @endisset
          
            <form action="{{route('regSave')}}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                <label>Ime:</label>
                <input type="text" name="Ime" class="form-control"/>
              </div> 
              <div class="form-group">
                <label>Prezime:</label>
                <input type="text" name="Prezime" class="form-control"/>
              </div> 
              <div class="form-group">
                <label>Korisnicko ime:</label>
                <input type="text" name="username" class="form-control"/>
              </div>
              <div class="form-group">
                <label>Lozinka:</label>
                <input type="password" name="pass" class="form-control"/>
              </div> 
              
              <div class="form-group">
                <input type="submit" name="register" value="Registruj se" class="btn btn-default btn-primary" />
              </div> 
            </form>
        </div>
@endsection