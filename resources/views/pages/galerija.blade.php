@extends('layouts.glavni')

    @section('title')
        Galerija
    @endsection
    @section('AppendCSS')
        @parent
         <!-- CSS -->
         <link href="{{asset ('css/style.css')}}" rel="stylesheet">
    @endsection

    @section('content')
        <div class="col-md-8">
            <h3>Sampioni liga petice iz prethodne sezone</h3>
             @isset($galerija)
             @foreach($galerija as $g)
             <a class="galerry" href="{{asset($g->putanja)}}"  data-toggle="lightbox" data-gallery="hidden-images" >
                 <img class="card-img-top" src="{{asset($g->putanja)}}" alt="{{$g->opis}}">
            </a>
             </br>
             </br>

            
                @endforeach
                @endisset
        </div>

      @endsection
      
        

