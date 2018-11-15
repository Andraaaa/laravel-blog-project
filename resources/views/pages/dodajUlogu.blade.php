@extends('layouts.admin')

@section('title')
    Dodaj ulogu
@endsection

@section('appendCss')
    @parent
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }} rel="stylesheet"/>
@endsection

@section('content')
<!-- Sadrzaj -->
        <div class="col-md-8">
            <h3>Dodaj ulogu</h3>
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
          

            <form action="{{(isset($uloge))? asset('/uloga/update/'.$uloge->id) : asset('/uloga/save')}}" method="POST" enctype="multipart/form-data">
              
              {{ csrf_field() }}
              <div class="form-group">
                <label>Naziv uloge:</label>
                <input type="text" name="naziv" class="form-control" value="{{(isset($uloge)) ? $uloge->naziv : old('naziv')}}"/>
              </div> 
              <div class="form-group">
                <input type="submit" name="DodajUlogu" value="{{isset($uloge)? 'Izmeni ulogu' : 'Dodaj ulogu'}}" class="btn btn-default" />
              </div> 
            </form>
               
            <table class="table">
                <tr>Informacije o ulogama</tr>
                <tr>
                  <td>Naziv uloge</td>
                  <td>Izmena</td>
                  <td>Brisanje</td>
                </tr>
                @isset($uloga)
                @foreach($uloga as $u)
                  <tr>
                      <td>{{$u->naziv}} </td>
                    
                      <td><a href="{{asset('/uloga/'.$u->id)}}">Izmeni ulogu</a> </td>
                    <td> <a href="{{asset('/uloga/delete/'.$u->id)}}">Obrisi ulogu</a> </td>
                  </tr>
                  @endforeach
                  @endisset
              
            </table>
        </div>
		
@endsection