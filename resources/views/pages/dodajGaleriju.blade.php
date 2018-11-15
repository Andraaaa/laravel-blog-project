@extends('layouts.admin')

@section('title')
Dodajte vest
@endsection

@section('appendCss')
    @parent
    <!-- Custom styles for this template -->
    <link href="{{asset ('css/style.css')}}" rel="stylesheet"/>
@endsection
@section('content')
<!-- Sadrzaj -->
        <div class="col-md-8">
            
             <h3>Dodaj sliku u galeriju</h3>
         
             <form action="{{(isset($slika))? asset('/gallery/update/'.$slika->id) : asset('/gallery/save')}}" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="form-group">
                <label>Slika:</label>
                @isset($slika)
                <img src="{{asset($slika->putanja)}}" width="200px"/>
                @endisset
                <input type="file" name="slika" class="form-control"  />
                
              </div>
              <div class="form-group">
                <label>Opis:</label>
                <input type="text" name="opis" class="form-control" value="{{(isset($slika))? $slika->opis : old('opis')}}"/>
              </div>
              <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="{{(isset($slika))? 'Izmeni sliku u galeriji' : 'Dodaj sliku u galeriju'}}" />
              </div> 
              
            </form>
             
            <table class="table">
                <tr>
                  <td>Slika</td>
                  <td>Opis</td>
                  <td>Kreiran</td>
                  <td>Izmenjen</td>
                  <td>Izmeni</td>
                  <td>Obrisi</td>
                </tr>
              
                @isset($galerija)
                @foreach($galerija as $g)
                  <tr>
                    <td><img src="{{asset($g->putanja)}}" width="150"/> </td>
                    <td> {{$g->opis}}</td>
                   <td> {{ date('d.m.Y  H:i', $g->kreiran) }}</td>
                    <td> 
                    @if($g->izmenjen !=null)
                        {{ date('d.m.Y  H:i', $g->izmenjen) }}
                    @endif
                    </td>
                    <td> <a href="{{asset('/gallery/'.$g->id)}}">Izmeni</a> </td>
                    <td> <a href="{{asset('/gallery/delete/'.$g->id)}}">Obrisi</a> </td>
                  </tr>
                @endforeach
                @endisset
            </table>
               
        </div>
       
		<!--// Sadrzaj -->
@endsection

