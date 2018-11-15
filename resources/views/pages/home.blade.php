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
            @isset($vesti)
            @foreach($vesti as $v)
          <!-- Vest -->
          <div class="card mb-4">
              <img class="card-img-top" src="{{asset($v->slika)}}" alt="{{$v->opis}}">
            <div class="card-body">
              <h2 class="card-title">{{$v->naslov}}</h2>
              <p class="card-text">{{$v->podnaslov}}</p>
              <a href="{{route('vest',$v->vest_id)}}" class="btn btn-primary">Pročitaj vest &rarr;</a>
              </div>
            <div class="card-footer text-muted">
              @if(!session()->has('user'))
              <a href="#" class="btn disabled">Dodaj komentar ( Da biste dodali komentar morate se ulogovati! )</a>
              @endif
              @if(session()->has('user'))
              <a href="{{route('vest',$v->vest_id)}}">Dodaj komentar</a>
              @endif
            </div>
          </div>
            @endforeach
            @endif
            <div id="paginacija"> {{$vesti->links()}}</div>
    <!--// Vest -->
    
    
          

        
          

        </div>
    <!--// Sadrzaj -->
    

      @endsection