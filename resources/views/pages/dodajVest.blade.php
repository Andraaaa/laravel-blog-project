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
            
             <h3>Dodaj vest</h3>
         
            <form action="{{ (isset($vest))? asset('/vesti/update/'.$vest->vest_id) : asset('/vesti/save') }}" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="form-group3">
                <label>Naslov:</label>
                <input type="text" name="naslov" class="form-control" value="{{(isset($vest))? $vest->naslov : old('naslov')}}"/>
              </div>
              <div class="form-group3">
                <label>Podnaslov:</label>
                <input type="text" name="podnaslov" class="form-control" value="{{(isset($vest))? $vest->podnaslov : old('podnaslov')}}"/>
              </div>
              <div class="form-group">
                <label>Sadrzaj:</label>
                <textarea name="sadrzaj"  class="form-control" rows="7" >{{(isset($vest))? $vest->sadrzaj : old('sadrzaj')}}</textarea>
              </div> 
              <div class="form-group">
                <label>Slika:</label>
                @isset($vest)
                <img src="{{asset($vest->slika)}}" width="200px"/>
                @endisset
                <input type="file" name="slika" class="form-control"  />
                
              </div>
              <div class="form-group">
                <label>Opis:</label>
                <input type="text" name="opis" class="form-control" value="{{(isset($vest))? $vest->opis : old('opis')}}"/>
              </div>
             <div class="form-group">
                <label>Liga:</label>
                <select name="ddlLiga">
                  <option value="0">Izaberite</option>
                  
                   @foreach($lige as $l)
                   <option value="{{$l->liga_id}}" {{ (isset($vest) && $vest->liga_id==$l->liga_id)? 'selected' : (old('ddlLiga')==$l->liga_id)? 'selected' : ''}}> {{$l->naziv_lige}}</option>
                   @endforeach
                 

                </select>
              </div>
              <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="{{(isset($vest))? 'Izmeni vest' : 'Dodaj vest'}}" />
              </div> 
              
            </form>
             
            <table class="table">
                <tr>
                  <td>Naslov vesti</td>
                  <td>Slika</td>
                  <td>Kreiran</td>
                  <td>Izmenjen</td>
                  <td>Izmeni</td>
                  <td>Obrisi</td>
                </tr>
             
                @isset($vesti)
                @foreach($vesti as $v)
                  <tr>
                    <td>{{$v->naslov}}</td>
                    <td><img src="{{asset($v->slika)}}" width="150"/> </td>
                    <td> {{ date('d.m.Y  H:i', $v->kreiran) }}</td>
                    <td> 
                    @if($v->izmena !=null)
                        {{ date('d.m.Y  H:i', $v->izmena) }}
                    @endif
                    </td>
                    <td> <a href="{{asset('/vesti/'.$v->vest_id)}}">Izmeni</a> </td>
                    <td> <a href="{{asset('/vesti/delete/'.$v->vest_id)}}">Obrisi</a> </td>
                  </tr>
                @endforeach
                @endisset
                {{$vesti->links()}}
            </table>
               
        </div>
       
		<!--// Sadrzaj -->
@endsection

