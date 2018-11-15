@extends('layouts.admin')

@section('title')
    Dodaj korisnika
@endsection

@section('appendCss')
    @parent
 
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
          

            <form action="{{ (isset($ank))? asset('/anketa/update/'.$ank->id_anketa) : asset('/anketa/save')}}" method="POST" enctype="multipart/form-data">
              
              {{ csrf_field() }}
              <div class="form-group">
                <label>Stavka ankete:</label>
                <input type="text" name="naziv" class="form-control" value="{{ (isset($ank))? $ank->naziv : old('naziv')}}"/>
              </div> 
              <div class="form-group">
                <input type="submit" name="DodajAnketaa" value="{{isset ($ank)? 'Izmeni stavku ankete' : 'Dodaj stavku ankete'}} " class="btn btn-default" />
              </div> 
            </form>
               
            <table class="table">
                <tr>Informacije o anketi</tr>
                <tr>
                  <td>Naziv stavke iz ankete</td>
                  <td>Broj glasova</td>
                  <td>Kreiran</td>
                  <td>Izmenjen</td>
                  <td>Izmena</td>
                  <td>Brisanje</td>
                </tr>
         
                @isset($anketa)
                @foreach($anketa as $a)
                  <tr>
                    <td>{{$a->naziv}}  </td>
                    <td>{{$a->glas}}  </td>
                    <td> {{ date('d.m.Y  H:i', $a->kreiran) }}</td>
                    <td> 
                        @if($a->izmena !=null)
                        {{ date('d.m.Y  H:i', $a->izmena) }}
                        @endif
                    </td>
                    <td><a href="{{asset('/anketa/'.$a->id_anketa)}}">Izmeni stavku iz ankete</a> </td>
                    <td> <a href="{{asset('/anketa/delete/'.$a->id_anketa)}}">Obrisi stavku iz ankete</a> </td>
                  </tr>
              @endforeach
              @endisset
            </table>
        </div>
		
@endsection