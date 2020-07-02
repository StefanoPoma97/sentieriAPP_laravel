@extends('layouts.master')

@section('titolo', 'Modifica utente')

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
<h2 class="pull-left">Modifica Password</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('user.elenco') }}">Utenti</a></li>
    <li class="active">Modifica password</li>
</ul>
@endsection

@section('corpo')
<script>
var form = document.getElementById('modifica_password');

</script>
<div class="container pt-5" style="margin-top: 5em;">
    <div class="row">
        <div style="margin-bottom: 2em;" hidden="" class="col-md-12 alert alert-danger">
            <ul id="ul_errori">
           </ul>
        </div>
        <div class='col-md-12'>
            <form class="form-horizontal" id="modifica_password" name="modifica_password" method="post" action="{{route('user.update.password',['id'=> $user->id])}}">
            @csrf
                <div class="form-group row">
                    <div class="col-sm-3">
                    <label for="password_precedente" class="col-form-label">Password precedente</label>
                            <div style="margin-left: 1em;" class="popup" onclick="popup(this)" >
                                <span class="popuptext">Inserisci la tua password attuale</span>
                                <span class="glyphicon glyphicon-info-sign" ></span>
                            </div>
                    </div>
                    <div class="col-sm-5">
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" maxlength="100" required="" type="password" class="form-control" name="password_precedente"  placeholder="Password attuale">
                        <span class="invalid-input" id="invalid-password_precedente"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                    <label for="password_nuova" class="col-form-label">Nuova password</label>
                            <div style="margin-left: 1em;" class="popup" onclick="popup(this)" >
                                <span class="popuptext">Inserisci la tua nuova password, almeno 8 caratteri</span>
                                <span class="glyphicon glyphicon-info-sign" ></span>
                            </div>
                    </div>
                    <div class="col-sm-5">
                        <input onkeyup="rimuovi_stile(this); password_lunghezza(this); abilita_conferma_password(this); strong_password(this); " onmouseover="rimuovi_stile(this)" maxlength="100" required="" type="password" class="form-control" name="password_nuova" placeholder="Nuova password">
                        <span class="invalid-input" id="invalid-password_nuova"></span>
                        <br>
                        <meter max="4" min="0" optimum="4" id="password-strength-meter"></meter>
                        <p id="password-strength-text"></p>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                    <label for="password_nuova2"  class="col-form-label">Ripeti la password</label>
                            <div style="margin-left: 1em;" class="popup" onclick="popup(this)" >
                                <span class="popuptext">Ripeti la password appena inserita</span>
                                <span class="glyphicon glyphicon-info-sign" ></span>
                            </div>
                    </div>
                    <div class="col-sm-5">
                        <input disabled="" onkeyup="rimuovi_stile(this); password_uguali(this);" onmouseover="rimuovi_stile(this)" maxlength="100" required="" type="password" class="form-control" name="password_nuova2" placeholder="Ripeti la password">
                        <span class="invalid-input" id="invalid-password_nuova2"></span>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <div class="col-sm-5 col-sm-offset-3">
                        <input type="hidden" name="id" value="{{ $user_id }}"/>
                        <label for="mySubmit" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-floppy-save"></span> Save</label>
                        <input id="mySubmit" type="submit" value="save" class="hidden" onclick="event.preventDefault(); valida_modifica_password(this);"/>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5 col-sm-offset-3">
                        <a href="{{route('user.edit',['id'=> $user->id])}}" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-log-out"></span> Cancel</a>                         
                    </div>
                </div>                       
            </form>
        </div>
    </div>
</div>

<script>
    
    
</script>
<!--<script>
    $("form#modifica_utente :input").each(function(){
        $(this).removeClass("border-red");
       })
    </script>-->
@endsection
