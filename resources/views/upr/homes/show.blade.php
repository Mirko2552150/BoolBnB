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
          <div class="col-6">
            <div class="cubo-center">
              <h2 class="text-center">{{$home->name}}</h2>
              <h5 class="text-center">{{$home->address}}</h5>
            </div>
          </div>
          <div class="col-6">
            <div class="cubo-center">
              <h2 class="text-center">Servizi</h2>
              @foreach ($home->services as $service)
              <h4 class="text-center"> {{$service->name}}</h4>
              {{-- @if (!$loop->last)
                  ,
              @endif --}}
              @endforeach
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 padding">
            <style>
              .padding {
                padding-top: 20px;
              }
            </style>
            <div class="form-group">
                <div id="map-example-container" class="altezza"></div>
                <input type="search" id="input-map" value="{{$home->address}}" name="address" class="form-control invisible" placeholder="Indirizzo Appartamento"/>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-4">
              <div class="cubo">
                <canvas id="statsGrafico"></canvas>
              </div>

            </div>
            <div class="col-4">
              <div class="cubo-center">
                <h2 class="text-center">VISUALIZZAZIONI TOTALI APPARTAMENTO</h2>
                <h1 class="text-center" id="visualAppart"></h1>
              </div>
            </div>
            <div class="col-4">
              <div class="cubo">
                @if (strpos($home->path, 'https://loremflickr') !== false)
                    <img class="img-responsive" style="width: 100%;" src="{!!$home->path!!}" alt="{!!$home->path!!}">
                @else
                  <img class="img-responsive" style="width: 100%;" src="{{asset('storage/' . $home->path)}}" alt="{{$home->path}}">
                @endif
              </div>
            </div>
        </div>
        {{-- INIZIO : passiamo i dati di lat e long alla mappa tramite due input--}}
        <div class="box invisible">
            <input type="number" class="form-control" id="lat-valore" name="lat" value="{{$home->lat}}">
        </div>
        <div class="box invisible">
            <input type="number" class="form-control" id="long-valore" name="long" value="{{$home->long}}">
        </div>
        <div class="box invisible">
            <input type="number" class="form-control" id="homeid" name="home_id" value="{{$home->id}}">
        </div>
        {{-- FINE : passiamo i dati di lat e long alla mappa tramite due input--}}
        <div class="row">
          {{-- <div class="col-12">
            <img class="img" alt="Responsive image" src="{{asset('storage/' . $home->path)}}">
          </div> --}}
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/it.js" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="{{ asset('js/graficoStats.js') }}" defer></script>
@endsection
