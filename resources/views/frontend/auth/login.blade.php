@extends('frontend.layouts.master')

@section('main')

    <div class="container">
        <br>
        <p class="text-center">Register</p>      
        <hr>
        @if (session()->has('message'))
            <div class="alert alert-{{ session('type') }}">
                {{ session('message') }}
            </div>
        @endif
        <form action="{{ route('login')}}" class="form-horizontal" method="post">
            @csrf
            
            <div class="form-group row">
                <label for="email" class="control-label col-md-4">Email</label>
                <div class="col-md-8">
                    <input type="email" class="form-control   @if($errors->has('email'))  is-invalid @endif " " value="{{ old('email') }}"  id="email" name="email" />    
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                        {{ $errors->first('email')}}
                        </div>
                    @endif
                </div>
            </div>
           
            <div class="form-group row">
                <label for="password" class="control-label col-md-4">Password</label>
                <div class="col-md-8">
                    <input type="password" class="form-control  @if($errors->has('password'))  is-invalid @endif " id="password" name="password" />
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                        {{ $errors->first('password')}}
                        </div>
                    @endif 
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-8 offset-md-4">
                  <button class="btn btn-primary btn-block" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>

@stop 