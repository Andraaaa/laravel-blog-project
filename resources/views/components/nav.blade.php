
 <!-- Navigacija -->
    <nav class="navbar navbar-expand-lg navbar-dangerS bg-danger fixed-top">
      <div class="container">
        <a class="navbar-brand text-light" href="#">Lige petice</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"><img src="{{asset ('images/toggle-icon.png')}}" class="img-fluid"/></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto nav nav-tabs" role="tablist">
              @isset($menu)
              @foreach($menu as $m)
  
            <li class="nav-item {{($loop->first)? 'active':'' }}">
                <a class="nav-link text-light" href="{{asset($m->putanja)}}">{{$m->naziv}}
                    <span class="sr-only">(current)</span>
                   
                </a>
            </li>
           @endforeach
           @endif
               @if(session()->has('user'))
 
               <li class="nav-item">
                   <a class="nav-link text-light" href="{{route('logout')}}">Logout</a>
               </li>
               @endif
       
          </ul>
        </div>
      </div>
    </nav>
	<!--// Navigacija -->


