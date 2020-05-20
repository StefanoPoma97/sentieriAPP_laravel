@extends('layouts.master')

@section('titolo', 'Elenco utenti')

@section('navbar_home')
<a class="navbar-brand" href="{{ route('home') }}">Sentieri</a>
@endsection


@section('navbar')
<li><a class="bordo-selezione" href="{{ route('sentiero.ricerca') }}">Sentieri</a></li>
<li><a class="bordo-selezione" href="{{ route('user.elenco') }}">Utenti</a></li>

    @if($logged)
    <li class="dropdown" style="margin-left: 5em;">
        <a class="btnsignin dropdown-toggle" href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('user.dettagli', ['id'=> $user_id]) }}">Account</a></li>
            <li><a href="{{ route('user.preferiti', ['id'=> $user_id]) }}">Preferiti</a></li>
            @if($user->admin == 'y')
            <li><a href="{{ route('user.elenco') }}">Lista utenti</a></li>
            <li><a href="{{ route('sentiero.index') }}">Lista sentieri</a></li>
            @else
            @endif
            <li><a href="{{ route('user.logout') }}">Log out</a></li>
        </ul>
    </li>
    @else
        <li style="margin-left: 5em;"><a class="btn btnlogin" href="{{ route('user.auth.login') }}"><span class="glyphicon glyphicon-log-in"></span> Accedi</a></li>
        <li><a class="btnsignin" href="{{ route('user.auth.register') }}"><span class="glyphicon glyphicon-user"></span> Registrati</a></li>

    @endif

@endsection

@section('sfondo')
@endsection


@section('header')
<h2 class="pull-left">Cerca sentieri</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Sentieri</li>
</ul>
@endsection

@section('corpo')
<div class="container" style="margin-top: 3em;">
    <div class="row">
        <div class="col-md-5 col-s-5 col-m-push-7">
            <h2 class="text-center filtro">Filtro</h2>
            <form style="margin-top: 3em;" name="form_filtro" method="get" action="{{route('sentiero.ricercafiltra')}}">
            @csrf
                <div class="form-group row">
                    <label class="col-sm-10" for="testo_titolo">Titolo</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="testo_titolo" name="testo_titolo" placeholder="Parola contenuta nel titolo">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-10" for="testo_descrizione">Descrizione</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="testo_descrizione" name="testo_descrizione" placeholder="Parola contenuta nella descrizione">
                    </div>
                </div>
                <div class="form-group">
                    <label for="citta">Città</label>
                    <select class="form-control" id="citta" name="citta" >
                        <option value=""></option>
                        @foreach ($citta as $c)
                        <option value="{{$c->id}}">{{$c->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="difficolta">Difficoltà</label>
                    <select class="form-control" id="difficolta" name="difficolta" >
                        <option value=""></option>
                        @foreach ($difficolta as $c)
                        <option value="{{$c->id}}">{{$c->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="categoria">categoria</label>
                    <select class="form-control" id="categoria" name="categoria" >
                        <option value=""></option>
                        @foreach ($categorie as $c)
                        <option value="{{$c->id}}">{{$c->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="lunghezza">Lunghezza massima (km)</label>
                    <input class="form-control" type="number" id="lunghezza" name="lunghezza" min="0" max="50">
                </div>
                <div class="form-group">
                    <label for="dislivello">Dislivello massimo (m)</label>
                    <input class="form-control" type="number" id="dislivello" name="dislivello" min="0" max="10000">
                </div>
                <div class="form-group">
                    <label for="durata">Durata massima</label>
                    <input class="form-control" type="number" pattern="^\d*(\.\d{0,2})?$" id="durata" name="durata">
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-info btn-toolbar">Trova</button>
                        <input id="mySubmit" type="submit" value='Save' class="hidden"/>
                    </div>
                </div>
            </form>
        </div>


        <div class="col-md-7 col-s-7 col-m-pull-5">
            
            @foreach ($sentieri as $sentiero)
            <div class="card" style="margin-bottom: 1em;">

                <div class="card-header text-center">
                    <h4 class="card-title">{{ $sentiero->titolo }}<span style="margin-left: 1em;"class="badge badge-secondary">{{ $sentiero->durata }} h</span></h4> 
                </div>

                <div class="card-body text_padding_card" style="margin-top: 1em;">
                    <h5 class="card-subtitle text-muted pb-3 overflow-text">{{ $sentiero->descrizione }}</h5>
                    <div style="margin-top: 1em;">
                        <div style="margin-top: 1em;" class="d-inline"><span class="glyphicon glyphicon-repeat"></span>   {{ $sentiero->lunghezza }} km</div>
                        <div style="margin-top: 1em;" class="d-inline"><span class="glyphicon glyphicon-chevron-down"></span>   {{ $sentiero->discesa }}</div>
                        <div style="margin-top: 1em;" class="d-inline"><span class="glyphicon glyphicon-chevron-up"></span>   {{ $sentiero->salita }}</div>
                        <div style="margin-top: 1em;" class="d-inline"><span class="glyphicon glyphicon-chevron-up"></span>   {{ $sentiero->citta->nome }}</div>
                    </div>
                    <div class=" pull-right ">
                        <a class="card-link" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}">Scopri</a>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 pull-right">
            <ul class="pagination">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </div>

    </div>
</div>
                 
@endsection