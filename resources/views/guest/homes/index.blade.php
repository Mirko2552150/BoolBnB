@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">Appartamento</li>
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
                <form class="" action="{{route('guest.homes.search')}}" method="post">
                  @csrf
                  @method('POST')
                  <div class="row">
                        <div class="col-8">
                          <label for="address">Dove vuoi andare?</label>
                        </div>
                        <div class="col-4">
                            <label for="slider-range">Raggio di ricerca</label>
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-7">
                            <div class="form-group">
                                <div id="map-example-container" class="invisible"></div>
                                <input type="search" id="input-map" name="address" class="form-control" placeholder="Indirizzo Appartamento"/>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <div class="d-flex justify-content-center my-2">
                                    <form class="range-field w-75">
                                      <input id="slider-range" class="border-0" name="range" type="range" min="5" max="200" value="20"/>
                                    </form>
                                    <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan"></span>
                                </div>
                            </div>
                        </div>


                  <div class="form-group invisible">
                      <label for="long">long</label>
                      <input id="long" type="text" name="long" class="form-control"/>
                  </div>
                  <div class="form-group invisible">
                      <label for="lat">lat</label>
                      <input id="lat" type="text" name="lat" class="form-control"/>
                  </div>
                  <div class="col-1">
                    <input id="invia-form" class="btn btn-primary" type="submit" value="Find">
                  </div>
                  </div>
                </form>
            </div>
        </div>
        <style>
          .a
            {
            cursor:pointer;
            border: 2px solid white;
            border-radius: 3px;
            margin: 5px;
            overflow: hidden;
            border: 2px solid white;
            background-color: ##f5f5f5;
          }
          .a:hover  {
            transform: scale(1.1);
            transition-duration: 1s;
            transition-timing-function: ease-in-out;
          }
          *  {
            background-color: white;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
          }
          img {
            width: 100%;
            height: 100%;
            object-fit: cover;
          }
          .left, .right {
            width: 50%;
            height: 250px;
            float: left;
            display: flex;
            justify-content: center;
            flex-direction: column;
            background-color: #f5f5f5;
          }
          .bg {
            background-color: #f5f5f5;
          }
          .center {
            text-align: center;
          }
          .jumbotron , .jumbotron > p, .jumbotron > h1 {
            background-color: black;
            color: #f5f5f5;
          }
        </style>
      @foreach ($homes as $key => $home)
        <div class="row">
          <div class="col-12 a">
            <div class="left">
              <h5 class="center bg">{!!$home->name!!}</h5>
              <p class="center bg">Descrizione appartamento</p>
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
@endsection
