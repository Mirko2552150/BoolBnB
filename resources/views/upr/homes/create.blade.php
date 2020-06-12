@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('upr.homes.index')}}">Index</a></li>
                    <li class="breadcrumb-item active">Create</li>
                  </ol>
                </nav>
            </div>
        </div>
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
                <h1>Inserisci una nuova casa</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <form action="{{route('upr.homes.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Inserisci il nome" value="{{old('name')}}">
                        @error('name')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="n_rooms">Rooms</label>
                        <input type="number" min="1" max="20" class="form-control" id="n_rooms" name="n_rooms" placeholder="Inserisci il n° di stanze" value="{{old('n_rooms')}}">
                        @error('n_rooms')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="n_beds">Beds</label>
                        <input type="number" min="1" max="40" class="form-control" id="n_beds" name="n_beds" placeholder="Inserisci il N° di letti" value="{{old('n_beds')}}">
                        @error('n_beds')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="n_bath">Bath</label>
                        <input type="number" min="1" max="20" class="form-control" id="n_bath" name="n_bath" placeholder="Inserisci il n° Bagni" value="{{old('n_bath')}}">
                        @error('n_bath')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="mq">Mq</label>
                        <input type="number" min="20" max="10000" class="form-control" id="mq" name="mq" placeholder="Inserisci i mq" value="{{old('mq')}}">
                        @error('mq')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="services">Services</label>
                        <div class="form-group">
                            @foreach ($services as $service)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="services[]" id="service{{$service['id']}}" value="{{$service['id']}}" {{(is_array(old('services')) && in_array($service->id, old('services'))) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="service{{$service['id']}}">{{$service['name']}}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('services')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" name="path" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Inserisci la foto</label>
                        </div>
                        @error('path')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Salva">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
