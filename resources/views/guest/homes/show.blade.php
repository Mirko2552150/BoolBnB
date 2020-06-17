@extends('layouts.app')
@section('content')
  {{-- @dd($home->address) --}}
    <div class="container">
      <div class="row">
        <div class="col-12">
           <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('guest.homes.index')}}">Home</a></li>
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
          <div id="map-example-container" class="altezza"></div>
          <input type="search" id="input-map" class="form-control invisible" placeholder="Indirizzo Appartamento"/>
        <form action="{{route('guest.messages.store')}}" method="post">
          @csrf
          @method('POST')
          <div class="form-group">
              <label for="mail">Email</label>
              <input type="mail" class="form-control" id="mail" name="mail" placeholder="name@example.com"
              value="@if (isset($user)){{$user->email}}@endif">
              @error('mail')
                  <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
              @enderror
          </div>
          <div class="form-group">
              <label for="body">Corpo del messaggio</label>
              <textarea class="form-control" id="body" name="body" rows="3"></textarea>
              @error('body')
                  <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
              @enderror
          </div>
          <div class="form-group invisible">
              <label for="home_id">home_id</label>
              <input type="number" class="form-control" name="home_id" placeholder="name@example.com" value="{{$home->id}}">
          </div>
          <div class="form-group">
              <input class="btn btn-primary" type="submit" value="Invia messaggio">
          </div>
      </form>

      {{-- INIZIO : passiamo i dati di lat e long alla mappa tramite due input--}}
      <div class="box invisible">
          <input type="number" class="form-control" id="lat-valore" name="lat" placeholder="name@example.com" value="{{$home->lat}}">
      </div>
      <div class="box invisible">
          <input type="number" class="form-control" id="long-valore" name="long" placeholder="name@example.com" value="{{$home->long}}">
      </div>
      {{-- FINE : passiamo i dati di lat e long alla mappa tramite due input--}}
    </div>
@endsection
