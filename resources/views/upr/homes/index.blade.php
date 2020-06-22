@extends('layouts.app')
@section('content')
    <style>
        nav {
            padding-top: 80px;
        }
    </style>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('guest.homes.index')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="row">
        <div class="col-12">
            {{-- @if (session('login-success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif --}}
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
        <div class="row">
          <div class="col-6">
            <h2>Homes</h2>
          </div>
          <div class="offset-3 col-3">
            <a href="{{route('upr.homes.create')}}">inserisci nuovo appartamento</a>
          </div>
        </div>
        <table class="table table-hover table-dark">
          <thead>
            <tr>
              <td>Name</td>
              <td>Address</td>
              <td>Square meters</td>
              <td>Services</td>
              <td>Preview Photo</td>
              <td colspan="3">Actions</td>
            </tr>
          </thead>
          <tbody>
            @foreach ($homes as $key => $home)
              <tr>
                <td>{{$home->name}}</td>
                <td>{{$home->address}}</td>
                <td>{{$home->mq}}</td>
                <td>
                  @foreach ($home['services'] as $key => $service)
                    {{$service->name}}
                    {{-- se NON e' l'ultimo metto la , --}}
                    @if (!$loop->last)
                      ,
                    @endif
                  @endforeach
                </td>
                <td><img style="width:100px;" class="card-img-top" alt="Responsive image" src="{{asset('storage/' . $home->path)}}"></td>
                <td><a class="btn btn-primary" href="{{route('upr.homes.show', $home->id)}}">Visualizza</a></td>
                @if (Auth::id() == $home['user_id'])
                  <td><a class="btn btn-secondary" href="{{route('upr.homes.edit', $home->id)}}">Modifica</a></td>
                @endif
                @if (Auth::id() == $home['user_id'])
                  <td>
                    <form action="{{route('upr.homes.destroy', $home['id'])}}" method="post">
                        @csrf
                        @method('DELETE')
                      <input class="btn btn-danger" type="submit" value="Elimina">
                    </form>
                  </td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="row">
          <div class="col-6">
            <h2>Messages</h2>
          </div>
        </div>
        <table class="table table-hover table-info">
          <thead>
            <tr>
              <td>Email</td>
              <td>Testo</td>
              <td>Nome Appartamento</td>
              <td>Orario</td>
              <td colspan="1">Delete</td>
            </tr>
          </thead>
          <tbody>
            {{-- @if (!empty($messages)) --}}
                @foreach ($messages as $key => $message)
                    {{-- @dd($message) --}}
                  <tr>
                    <td>{{$message->mail}}</td>
                    <td>{{$message->body}}</td>
                    <td>{{$message->name}}</td>
                    <td>{{$message->created_at}}</td>
                    @if (Auth::id() == $message->user_id)
                      <td>
                        <form action="{{route('upr.messages.destroy', $message->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="Elimina">
                        </form>
                      </td>
                    @endif
                  </tr>
                @endforeach
            {{-- @endif --}}
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
