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
        <div class="row">
            <div class="col-12">
                <div class="card-deck">
                    @foreach ($homes as $key => $home)
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{asset('storage/' . $home->path)}}" alt="{{$home->name}}">
                            <div class="card-body">
                                <h5 class="card-title">{!!$home->name!!}</h5>
                                <p class="card-text">Descrizione appartamento</p>
                                <form action="{{route('upr.stats.store', $home->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    {{-- <div class="form-group">
                                        <input type="number" class="invisible" name="home_id" value="{{$home->id}}">
                                    </div> --}}
                                    <input id="invia-form" class="btn btn-primary" type="submit" value="Visualizza appartamento">
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
