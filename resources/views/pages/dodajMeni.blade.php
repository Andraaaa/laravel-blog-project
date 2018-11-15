@extends('layouts.admin')

@section('title')
    Dodaj meni
@endsection

@section('appendCss')
    @parent
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }} " rel="stylesheet"/>
@endsection

@section('content')
<!-- Sadrzaj -->
        <div class="col-md-8">
            <h3>Dodaj korisnika</h3>
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
          

            <form action="{{(isset($menus))? asset('/meni/update/'.$menus->meni_id) : asset('/meni/save')}}" method="POST" enctype="multipart/form-data">
              
              {{ csrf_field() }}
              <div class="form-group">
                <label>Naziv stavke menija:</label>
                <input type="text" name="naziv" class="form-control" value="{{isset($menus)? $menus->naziv : old('naziv')}}"/>
              </div> 
              <div class="form-group">
                <label>Putanja:</label>
                <input type="text" name="putanja" class="form-control" value="{{isset($menus)? $menus->putanja : old('putanja')}}"/>
              </div> 
              <div class="form-group">
                <input type="submit" name="DodajMeni" value="{{(isset($menus))? 'Izmeni stavku menija' : 'Dodaj stavku menija'}}" class="btn btn-default" />
              </div> 
            </form>
               
            <table class="table">
                <tr>Informacije o meniju</tr>
                <tr>
                  <td>Naziv stavke menija</td>
                  <td>Putanja stavke menija</td>
                  <td>Izmena</td>
                  <td>Brisanje</td>
                </tr>
         
                @isset($menu)
                @foreach($menu as $m)
                  <tr>
                    <td>{{$m->naziv}}</td>
                    <td>{{$m->putanja}}</td>
                    <td><a href="{{asset('/meni/'.$m->meni_id)}}">Izmeni stavku menija</a> </td>
                    <td> <a href="{{asset('/meni/delete/'.$m->meni_id)}}">Obrisi stavku menija</a> </td>
                  </tr>
                  @endforeach
                  @endisset
                
            </table>
        </div>
		
@endsection
