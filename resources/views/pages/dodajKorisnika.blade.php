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
          

            <form action="{{ (isset($korisnik))? asset('/korisnik/update/'.$korisnik->id) : asset('/korisnik/save')}}" method="POST" enctype="multipart/form-data">
              
              {{ csrf_field() }}
              <div class="form-group">
                <label>Ime:</label>
                <input type="text" name="tbIme" class="form-control" value="{{(isset($korisnik))? $korisnik->ime : old('tbIme')}}"/>
              </div> 
              <div class="form-group">
                <label>Prezime:</label>
                <input type="text" name="tbPrezime" class="form-control" value="{{ (isset($korisnik))? $korisnik->prezime : old('tbPrezime')}}"/>
              </div> 
              <div class="form-group">
                <label>Korisnicko ime:</label>
                <input type="text" name="username" class="form-control" value="{{ (isset($korisnik))? $korisnik->korisnicko_ime : old('username')}}"/>
              </div>
              <div class="form-group">
                <label>Lozinka:</label>
                <input type="password" name="pass" class="form-control" value="{{ (isset($korisnik))? $korisnik->lozinka : old('pass')}}"/>
              </div> 
              <div class="form-group">
                <label>Uloga:</label>
                <select name="ddlUloga">
                  <option value="0">Izaberite</option>
                  
                 
                  @foreach($uloge as $u)
                  <option value="{{$u->id}}" {{ (isset($korisnik) && $korisnik->uloga_id==$u->id)? 'selected' : (old('ddlUloga')== $u->id)? 'selected' : ''}}>{{$u->naziv}} </option>
                  @endforeach
                  

                </select>
              </div>
              <div class="form-group">
                <input type="submit" name="DodajKorisinka" value="{{ isset($korisnik)? 'Izmeni korisnika' : 'Dodaj korisnik' }}" class="btn btn-default" />
              </div> 
            </form>
               
            <table class="table">
                <tr>Informacije o korisnicima</tr>
                <tr>
                  <td>Ime</td>
                  <td>Prezime</td>
                  <td>Korisnicko ime</td>
                  <td>Kreiran</td>
                  <td>Izmenjen</td>
                  <td>Izmena</td>
                  <td>Brisanje</td>
                </tr>
         
                @isset($listaj)
                @foreach($listaj as $l)
                  <tr>
                    <td>{{$l->ime}}  </td>
                    <td>{{$l->prezime}}  </td>
                    <td> {{$l->korisnicko_ime}} </td>
                    <td> {{ date('d.m.Y  H:i', $l->kreiran) }}</td>
                    <td> 
                        @if($l->izmena !=null)
                        {{ date('d.m.Y  H:i', $l->izmena) }}
                        @endif
                    </td>
                    <td><a href="{{ asset('/korisnik/'.$l->id)}}">Izmeni korisnika</a> </td>
                    <td> <a href="{{asset('/korisnik/delete/'.$l->id)}}">Obrisi korisnika</a> </td>
                  </tr>
                @endforeach
                @endif
            </table>
        </div>
		
@endsection