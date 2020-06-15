@extends('layouts.app')
@section('content')
  {{-- @dd($home) --}}
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
          <img src="{{asset('storage/' . $home->path)}}" alt="{{$home->name}}">
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
        <form action="#" method="post">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="mail">Email</label>
                <input type="mail" class="form-control" id="mail" name="mail" placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="body">Corpo del messaggio</label>
                <textarea class="form-control" id="body" name="body" rows="3"></textarea>
            </div>
        </form>
    </div>
@endsection
