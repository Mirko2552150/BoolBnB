@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">Appartamenti</li>
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
                    <div class="form-group">
                        <label for="address">Inserisci indirizzo</label>
                        <div id="map-example-container" class="invisible"></div>
                        <input type="search" id="input-map" name="address" class="form-control" placeholder="Indirizzo Appartamento"/>
                        {{-- <input type="range" class="custom-range" id="customRange1"> --}}
                    </div>
                    <div class="form-group invisible">
                        <label for="long">long</label>
                        <input id="long" type="text" name="long" class="form-control"/>
                    </div>
                    <div class="form-group invisible">
                        <label for="lat">lat</label>
                        <input id="lat" type="text" name="lat" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input id="invia-form" class="btn btn-primary" type="submit" value="Find">
                    </div>
                </form>
            </div>
        </div>
      @foreach ($homes as $key => $home)
        <div class="row">
          <div class="col-12 a">
            <style>
<<<<<<< Updated upstream
              .a
                {
                cursor:pointer;
                border: 2px solid white;
                border-radius: 3px;
=======
              .a  {
>>>>>>> Stashed changes
                margin: 5px;
                overflow: hidden;
                border: 2px solid white;
                background-color: ##f5f5f5;
              }
              .a:hover  {
                transform: scale(1.1);
                transition-duration: 1s;
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
