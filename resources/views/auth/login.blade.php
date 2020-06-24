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
                      <h1 class="h3 text-gray-900 mb-4"> <i class="fas fa-lock"></i> Login</h1>
                    </div>
                    <form class="user" method="POST" action="{{ route('login') }}" autocomplete="off">
                      @csrf
                      <div class="form-group">
                            <input type="email" name="email" class="form-control form-control-user ml-2" autocomplete="off" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                        
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            
                                <input type="password" name="password" class="form-control form-control-user ml-2" autocomplete="off" id="exampleInputPassword" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        
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