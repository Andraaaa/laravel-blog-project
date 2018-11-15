@extends('layouts.glavni')

    @section('title')
        Fudbalske vesti lige petice
    @endsection
    @section('AppendCSS')
        @parent
         <!-- CSS -->
    <link href="{{asset ('css/style.css')}}" rel="stylesheet">
    @endsection

    @section('content')
        <!-- Sadrzaj -->
        <div class="col-md-8">
            @isset($ja)
            @foreach($ja as $j)
          <!-- Vest -->
          <div class="card mb-4">
              <img class="card-img-top" src="{{asset($j->slika)}}"  height="550px">
            <div class="card-body">
              <h2 class="card-title">{{$j->ime_prezime}}</h2>
              <p class="card-text">{{$j->sadrzaj}}</p>
          </div>
            @endforeach
            @endif
           
    
    
          
          </div>
        
          

        </div>
    <!--// Sadrzaj -->
    

      @endsection