@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel--background">
                <div class="panel-heading login--heading"><span><i class="fa fa-cog" aria-hidden="true"></i></span> Kontrolpanel</div>
                <div class="panel-body">
                    <div class="col-md-6">
                    <h2 class="font-bold">Bruger Kontrolpanel</h2>

                    <p>
                        Velkommen til dit kontrolpanel. Her har du mulighed for at redigere forskellige ting på din hjemmeside.
                    </p>

                    <p>
                        For at logge ind skal du bruge det brugernavn og password som du modtog i vores velkomst mail.
                    </p>

                    <p>
                        Har du spørgsmål, er du altid velkommen til at kontakte os <a href="#">her</a>
                    </p>

                    <p>
                        <small></small>
                    </p>

                    </div>
                    <div class="col-md-6">
                        <div class="ibox-content">
                            <form class="m-t" role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input type="email" name="email" class="form-control" placeholder="Brugernavn" required="">
                                    @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input type="password" name="password" class="form-control " placeholder="Password" required="">
                                    @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <button type="submit" class="btn btn-primary block full-width m-b ">Login</button>


                                <p class="text-muted text-center glemt--kode-tekst">
                                    <small>Har du glemt din kode?</small>
                                </p>
                                <a class="btn btn-sm btn-white btn-block my_popup_open" href="#fadeandscale">Få tilsendt ny kode</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection