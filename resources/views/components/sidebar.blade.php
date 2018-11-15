  <!-- Desna strana -->
         <div class="col-md-4">
            @if(!session()->has('user'))
             <div class="card my-4">
          
              <h5 class="card-header text-center">Login</h5>
            <div class="card-body">
           
                <form action="{{route('login')}}" method="POST">
                {{csrf_field()}}
              <div class="form-group">
                <label for="username" class="text-muted">Username:</label>
                <input type="text" class="form-control" name="username" placeholder="Username..." >
              </div>
              <div class="form-group">
                <label for="password" class="text-muted">Password:</label>
                <input type="password" class="form-control" name="pass" placeholder="Password...">
              </div>
              <div class="form-group">
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit">Login</button>
                </span>
              </div>
              
                @empty(!session('neuspeh'))
                  <div class="alert alert-danger">{{session('neuspeh')}}</div>
                  @endempty
                 
                </form>
            </div>
                
             </div>
               @empty(!session('uspeh'))
                  <div class="alert alert-success">{{session('uspeh')}}</div>
                  @endempty
               @endif
               
                @if(session()->has('user')&&session()->get('user')[0]->naziv !='admin')
          
            
                @endif
             @if(session()->has('user')&&session()->get('user')[0]->naziv !='admin')
             <div class="card my-4">
            <h5 class="card-header text-center">Najbolja liga na svetu?
            </h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                            <form name='glasanje' method='POST' action="{{ asset('/anketa/glas')}}">
                            {{csrf_field()}}
                                @foreach($anketa as $a)
                                    <p class="card-text">
                                        <input type="hidden" value="{{ $a->rezultat }}" name="rezultat"/>
                                        <input type="radio" value="{{ $a->id }}" name="anketa" />{{
                                $a->naziv }}<br/>
                                @endforeach
                                <button type='submit' class="btn btn-primary" value="{{asset('/anketa/rezultat')}}"
                                        name='glasaj'>Glasaj</button>

                            </form>
                </div>
              </div>
            </div>
             @endif
              <div class="card-my-4">
                 @if(session()->has('user')&&session()->get('user')[0]->naziv=='admin')
                 
                 <h5 class="card-header justify-content-center">Admin</h5>
                 <div class="card-body">
                     <p>
                         <a href="{{route('addMeni')}}" class="btn btn-primary">Meni</a>
                         <a href="{{route('vestAdd')}}" class="btn btn-primary">Vesti</a>
                         <a href="{{route('add')}}" class="btn btn-primary">Korisnici</a>
                         <a href="{{route('ulogeAdd')}}" class="btn btn-primary">Uloge</a></br></br>
                         <a href="{{route('addPic')}}" class="btn btn-primary">Galerija</a>    
                         <a href="{{route('prikaziAnketu')}}" class="btn btn-primary">Anketa</a>
                 @endif
                     </p>
                 </div>
             </div>
          </div>


</div>

