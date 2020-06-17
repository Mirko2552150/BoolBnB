@extends('layouts.app')
@section('content')
  {{-- @dd($home) --}}
    <div class="container">
      <div class="row">
        <div class="col-12">
           <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('guest.homes.index')}}">Home</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('upr.homes.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$home->name}}</li>
            </ol>
          </nav>
        </div>
      </div>
      {{-- @dd($home->path); --}}
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success">
                      {{ session('success') }}
                    </div>
                @elseif (session('failure'))
                    <div class="alert alert-danger">
                      {{ session('failure') }}
                    </div>
                @endif
          </div>
        </div>
        <div class="row">
            <div class="col-12">
              <h2>{{$home->name}}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
              {{$home->address}}
            </div>
            <div class="col-4">
              <img class="img-fluid" alt="Responsive image" src="{{asset('storage/' . $home->path)}}">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
              @foreach ($home->services as $service)
                  {{$service->name}}
                  @if (!$loop->last)
                      ,
                  @endif
              @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-12">
              <div class="form-group">
                  <div id="map-example-container" class="altezza"></div>
                  <input type="search" id="input-map" value="{{$home->address}}" name="address" class="form-control invisible" placeholder="Indirizzo Appartamento"/>
              </div>
            </div>
        </div>
            <div class="form-group invisible">
                <label for="home_id">lat</label>
                <input type="number" class="form-control" id="lat-valore" name="home_id" placeholder="name@example.com" value="{{$home->lat}}">
            </div>
            <div class="form-group invisible">
                <label for="home_id">long</label>
                <input type="number" class="form-control" id="long-valore" name="home_id" placeholder="name@example.com" value="{{$home->long}}">
            </div>
    </div>
@endsection
