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
        <form action="{{ route('register')}}" class="form-horizontal" method="post">
            @csrf
            <div class="form-group row">
                <label for="name" class="control-label col-md-4">Name</label>
                <div class="col-md-8">
                    <input type="text" class="form-control  @if($errors->has('name'))  is-invalid @endif " value="{{ old('name') }}" id="name" name="name" />    
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                        {{ $errors->first('name')}}
                        </div>
                    @endif
                </div>
            </div>
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
                <label for="phone_number" class="control-label col-md-4">Phone Number</label>
                <div class="col-md-8">
                    <input type="text" class="form-control  @if($errors->has('phone_number'))  is-invalid @endif "  value="{{ old('phone_number') }}" id="phone_number" name="phone_number" />    
                    @if($errors->has('phone_number'))
                        <div class="invalid-feedback">
                        {{ $errors->first('phone_number')}}
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
                   


        </form>
    </div>

@stop 