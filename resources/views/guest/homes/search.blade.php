@php
    // header('Content-Type: application/json');
    // // echo json_encode($homesFiltrate);

@endphp

{{-- @dd($homesFiltrate); --}}
@extends('layouts.app')
@section('content')
    <div class="container guest-homes-search">
      <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('guest.homes.index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ricerca</li>
                </ol>
            </nav>
        </div>
      </div>
        <div class="jumbotron">
          <h1 class="display-4">Noi stiamo <br> con #BlackLivesMatter</h1>
          <p class="lead">Crediamo in un futuro fondato sull’inclusione e il rispetto reciproco, nel quale il razzismo non ha posto.</p>
          <hr class="my-4">
          <p class="lead">
            <a class="btn btn-primary btn-lg" target="_blank" href="https://it.wikipedia.org/wiki/Black_Lives_Matter" role="button">Learn more</a>
          </p>
        </div>
        <div class="row">
            <div class="col-12">
                <h1>{!!$indirizzo!!}</h1>
                <div class="form-group invisible">
                    <label for="long">long</label>
                    <input id="long-invisible" type="text" name="long" class="form-control" value="{{$dataLon}}"/>
                </div>
                <div class="form-group invisible">
                    <label for="lat">lat</label>
                    <input id="lat-invisible" type="text" name="lat" class="form-control" value="{{$dataLat}}"/>
                </div>
                <div class="form-group invisible">
                    <label for="range">range</label>
                    <input id="range-invisible" type="text" name="range" class="form-control" value="{{$dataRange}}"/>
                </div>
            </div>
        </div>
        <form class="form-filtri">
            <div class="row">
              <div class="col-12">
                <h5 for="services">Services</h5>
                <div class="form-group services-form-group">
                    @foreach ($services as $service)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input filtri-servizi" name="services[]" id="service{{$service['id']}}" value="{{$service['id']}}" > {{-- {{(is_array(old('services')) && in_array($service->id, old('services'))) ? 'checked' : ''}} --}}
                            <label class="form-check-label" for="service{{$service['id']}}">{{$service['name']}}</label>
                        </div>
                    @endforeach
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <div class="form-group">
                    <label for="n_rooms">Numero Minimo Stanze</label>
                    <div class="d-flex justify-content-left my-2">
                        <form class="range-field w-75">
                          <input id="slider-rooms" class="border-0" name="n_min_rooms" type="range" min="1" max="20" value="1"/>
                        </form>
                        <span class="font-weight-bold text-primary ml-2 mt-1 valueRooms"></span>
                    </div>
                </div>
              </div>

              <div class="col-4">
                <div class="form-group">
                    <label for="n_beds">Numero Minimo Letti</label>
                    <div class="d-flex justify-content-left my-2">
                        <form class="range-field w-75">
                          <input id="slider-beds" class="border-0" name="n_min_beds" type="range" min="1" max="40" value="1"/>
                        </form>
                        <span class="font-weight-bold text-primary ml-2 mt-1 valueBeds"></span>
                    </div>
                </div>
              </div>

              <div class="col-4">
                <div class="form-group">
                    <label for="n_bath">Numero Minimo Bagni</label>
                    <div class="d-flex justify-content-left my-2">
                        <form class="range-field w-75">
                          <input id="slider-bath" class="border-0" name="n_min_bath" type="range" min="1" max="20" value="1"/>
                        </form>
                        <span class="font-weight-bold text-primary ml-2 mt-1 valueBath"></span>
                    </div>
                </div>
              </div>

            </div>
            <input id="invia-filtri" type="text" class="btn btn-primary" value="filtra">
        </form>
      @foreach ($homesFiltrate as $key => $home)
        <div class="row">
          <div class="col-12 box-app" id="{{$home->id}}">
            <div class="left">
              <h5 class="center bg">{!!$home->name!!}</h5>
              <p class="center bg">Descrizione appartamento</p>
                @foreach ($home->services as $service)
                    <p class="services invisible" data-services="{{$service->id}}">{{$service->name}}</p>
                @endforeach
              <form class="center bg" action="{{route('guest.stats.store', $home->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input id="invia-form" class="btn btn-primary" type="submit" value="Visualizza appartamento">
              </form>
            </div>
            <div class="right">
              <img class="" src="{{asset('storage/' . $home->path)}}" alt="{{$home->name}}">
            </div>
          </div>
        </div>
      @endforeach
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/slider.js') }}" defer></script>
    <script src="{{ asset('js/filtriHomes.js') }}" defer></script>
@endsection
