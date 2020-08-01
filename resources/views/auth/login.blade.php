@extends('layouts.template')

@section('bgColor')
    <style>
      body{
        background: rgb(123, 22, 255);
      }
    </style>
@endsection

@section('login')
<div class="container mt-5">
    <div class="row justify-content-center" >
        <div class="col-xl-5 col-lg-5 col-md-5">
          <div class="card o-hidden border-0 shadow-lg my-4">
            <div class="card-body p-0" rgba(117, 190, 218, 0.0)>
              <div class="row" style="background-color: rgba(117, 190, 218, 0.0);">
                <div class="col-lg-12">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h3 text-gray-900 mb-5"> <i class="fas fa-lock"></i> Login</h1>
                    </div>
                    <hr>
                    <h4 class="text-center mb-3">Veuillez-vous connecter</h4>
                    <form class="user" method="POST" action="{{ route('login') }}" autocomplete="off">
                      @csrf
                      <div class="row form-group">
                        <div class="input-group">
                            <div class="input-group-prepend"> 
                              <div class="input-group-text" style="background-color: rgb(240, 240, 247); color:black;font-size:1.5rem">
                                <i class="far fa-user"></i>
                              </div>
                            </div> 
                            <input type="text" name="username" class="form-control" autocomplete="off" placeholder="Nom d'utilisateur...">
                        
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                        <div class="row form-group">
                          <div class="input-group">
                            <div class="input-group-prepend"> 
                              <div class="input-group-text" style="background-color: rgb(240, 240, 247); color:black;font-size:1.5rem">
                                <i class="fas fa-unlock-alt"></i>
                              </div>
                            </div> 
                                <input type="password" name="password" class="form-control" autocomplete="off" id="exampleInputPassword" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                          </div>
                         </div>
                      <hr>
                         <div class="row">
                             <div class="col">
                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Login"/>
                             </div>
                             <div class="col">
                                <input type="reset" class="btn btn-danger btn-user btn-block" value="Clear"/>
                             </div>
                         </div>
                       
                      
                      
                      
                    </form>
                    
                    {{-- <div class="text-center">
                      <a class="small" href="forgot-password.html">Forgot Password?</a>
                    </div> --}}
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
    
        </div>
    
      </div>    
</div>




@endsection