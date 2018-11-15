@extends('layouts.glavni')
    @section('title')
        Fudbalske vesti lige petice
    @endsection
    @section('AppendCSS')
        @parent
         <!-- Custom styles for this template -->
    <link href="{{asset ('css/style.css')}}" rel="stylesheet">
    <link href="{{asset ('css/')}}" rel="stylesheet">
    @endsection

    @section('content')
        <!-- Sadrzaj -->
        <div class="col-md-8">
          
          @isset($vest)
          @foreach($vest as $v)
          <!-- Blog Post -->
          <div class="card mb-4">
              <img class="card-img-top" src="{{asset($v->slika)}}" alt="{{$v->opis}}">
              </a>
            <div class="card-body">
                <h2 class="card-title">{{$v->naslov}}</h2>
                {{ date('d.m.Y  H:i', $v->kreiran) }}
              <p class="card-text">{{$v->podnaslov}}{{$v->sadrzaj}}</p>
              
              </div>
            <div class="card-footer text-muted">
              @if(session()->has('user'))
              <form action="{{ asset('/komentar/'.$v->vest_id)}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group3">
                <label>Ostavite komentar:</label>
                <input type="text" name="komentar" class="form-control"/>
                  </div><br>
              <div class="form-group">
                 <input type="submit" class="btn btn-primary" value="Dodaj komentar" name="dodajKomentar"/>
              </div> 
             </form>
              @endif
              <table class="table">
                <tr>Komentari</tr>
              @isset($komentar)
                @foreach($komentar as $kom)
                  <tr>
                      <td>@ {{$kom->ime}} {{$kom->prezime}}  {{ date('d.m.Y  H:i', $kom->kreiran) }}</td>              
                    <td>{{$kom->tekst}}  </td>
                     @if(session()->has('user')&&session()->get('user')[0]->naziv=='admin')
                     <td>
                        <a href="{{asset('/komentar/delete/'.$kom->komentar_id)}}"> Obrisi komentar</a>
                    </td>
                    @endif
                  </tr>
               @endforeach
              @endisset
               </table>
            </div>
          </div>
         @endforeach
         @endif

    
        </div>
  
   
    

      @endsection
