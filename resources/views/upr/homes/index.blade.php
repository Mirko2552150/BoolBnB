@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Index</a></li>
            <li class="breadcrumb-item active" aria-current="page">Home</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="row">
          <div class="col-6">
            <h2>Homes</h2>
          </div>
          <div class="offset-3 col-3">
            <a href="#">inserisci nuovo appartamento</a>
          </div>
        </div>
        <table class="table table-dark">
          <thead class="thead-dark">
            <tr>
              <td>Name</td>
              <td>Address</td>
              <td>Metri Quadri</td>
              <td>Services</td>
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
                <td><a class="btn btn-primary" href="{{route('upr.homes.show', $home->id)}}">Visualizza</a></td>
                @if (Auth::id() == $home['user_id'])
                  <td><a class="btn btn-secondary" href="#">Modifica</a></td>
                @endif
                @if (Auth::id() == $home['user_id'])
                  <td>
                    <form class="" action="" method="post">
                      <input class="btn btn-danger" type="submit" name="" value="Elimina">
                    </form>
                  </td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
