@extends('layouts.app')
@section('content')
    <div class="container guest-homes-index">
      <div class="row">
        <div class="col-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">Home</li>
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

                {{-- FORM PER INVIO POST SEARCH --}}
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
                                  <input id="slider-range" class="border-0 width" name="range" type="range" min="5" max="200" value="20" />
                                </form>
                                <span class="font-weight-bold text-primary ml-2 mt-1 valueRange"></span>
                                <span class="font-weight-bold text-primary ml-2 mt-1">Km</span>
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

        {{ $cases->links() }} {{-- doppio link per navigare (link equivalente a fine div) --}}
        @foreach ($cases as $key => $case)
            @if ($case->expired != null && $case->expired > $adesso)
                <div class="row border">
                    <style media="screen">
                        .border{ border: 5px solid red;}
                    </style>
                    <div class="col-12 box-app">
                        <div class="left">
                            <h5 class="center bg">{!!$case->name!!}</h5>
                            <p class="center bg descrizione">{!!$case->description!!}</p>

                            {{-- FORM PER INVIO CONTEGGIO STATS --}}
                            @if ($user->id == $case->user_id) {{-- Se l'utente che clicca è colui che ha creato la casa, la statistica non viene creata--}}
                                <a class="center" href="{{route('guest.homes.show', $case->id)}}">
                                    <button type="button" class="btn btn-primary">Visualizza appartamento</button>
                                </a>
                            @else
                            <form class="center bg" action="{{route('guest.stats.store', $case->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <input id="invia-form" class="btn btn-primary" type="submit" value="Visualizza appartamento">
                            </form>
                            @endif
                        </div>
                        <div class="right">
                            @if (strpos($case->path, 'https://loremflickr') !== false)
                                <img class="img-responsive" style="width: 100%;" src="{!!$case->path!!}" alt="{!!$case->path!!}">
                            @else
                              <img class="img-responsive" style="width: 100%;" src="{{asset('storage/' . $case->path)}}" alt="{{$case->path}}">
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        @foreach ($cases as $key => $case)
            @if ($case->expired == null)
                <div class="row">
                  <div class="col-12 box-app">
                    <div class="left">
                      <h5 class="center bg">{!!$case->name!!}</h5>
                      <p class="center bg descrizione">{!!$case->description!!}</p>

                      {{-- FORM PER INVIO CONTEGGIO STATS --}}
                      @if ($user->id == $case->user_id) {{-- Se l'utente che clicca è colui che ha creato la casa, la statistica non viene creata--}}
                          <a class="center" href="{{route('guest.homes.show', $case->id)}}">
                              <button type="button" class="btn btn-primary">Visualizza appartamento</button>
                          </a>
                      @else
                      <form class="center bg" action="{{route('guest.stats.store', $case->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input id="invia-form" class="btn btn-primary" type="submit" value="Visualizza appartamento">
                      </form>
                      @endif


                    </div>
                    <div class="right">

                      @if (strpos($case->path, 'https://loremflickr') !== false)
                          <img class="" src="{!!$case->path!!}" alt="{!!$case->path!!}">
                      @else
                        <img class="" src="{{asset('storage/' . $case->path)}}" alt="{{$case->path}}">
                      @endif

                    </div>
                  </div>
                </div>
            @endif
        @endforeach
        {{ $cases->links() }}
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/slider.js') }}" defer></script>
@endsection
