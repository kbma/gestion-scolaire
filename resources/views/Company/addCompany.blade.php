@extends('layouts.app')

@section('content')
    <div class="container">


        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/home') }}">Accueil</a></li>
                        <li><a href="#">Societés</a></li>
                        <li class="active">Ajouter societé</li>
                    </ol>
                </div>
            </div>

        <form id="" action="{{route('SaveCompany')}}" method="post">
            {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info ">
                    <div class="panel-heading"><strong>Identification de la societe</strong> <a style="float: right" href="{{ route('ShowCompany') }}" title="Lister les societes" class="glyphicon glyphicon-align-justify"></a></div>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">CODE</button>
                                </span>
                                    <input autofocus value="{{ isset($_POST['CODE'])?$_POST['CODE']:''  }}" maxlength="10" style='text-transform:uppercase' tabindex="1" required id="CODE" name="CODE" type="text" class="form-control" placeholder="max 10 caractères">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->



                        </div><!-- /.row -->
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Nom</button>
                                </span>
                                    <input tabindex="3" style='text-transform:uppercase' required id="NOM" name="NOM" type="text" class="form-control" placeholder="">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->

                        </div><!-- /.row -->

                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Adrresse</button>
                                </span>
                                    <input style='text-transform:uppercase' tabindex="9" required id="ADRESSE" name="ADRESSE" type="text" class="form-control" placeholder="">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->

                        </div><!-- /.row -->
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Ville</button>
                                </span>
                                    <input tabindex="11" style='text-transform:uppercase' required id="VILLE" name="VILLE" type="text" class="form-control" placeholder="">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">CP</button>
                                </span>
                                    <input tabindex="12" required id="CP" name="CP" type="number" maxlength="4" class="form-control" placeholder="">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button  class="btn btn-default" type="button">Tél</button>
                                </span>
                                    <input maxlength="8" tabindex="13"style='text-transform:uppercase' required id="TEL" name="TEL" type="tel" class="form-control" placeholder="">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Email</button>
                                </span>
                                    <input tabindex="14" id="EMAIL" name="EMAIL" type="text" class="form-control" placeholder="">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->

                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Abservation</button>
                                </span>
                                    <textarea rows="5" style='text-transform:uppercase' tabindex="9" required id="OBSERVATION" name="OBSERVATION" class="form-control" placeholder=""></textarea>

                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->

                        </div><!-- /.row -->





                    </div>
                </div>
            </div>
        </div>



<input type="hidden" name="created_at" value="{{date('Y-m-d H:i:s')}}" />
            <input type="hidden" name="updated_at" value="{{date('Y-m-d H:i:s')}}" />



            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-danger  ">

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">

                                    <input tabindex="26" type="submit" class="btn btn-danger"  value="Enregister ce prestataire"/>

                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->



                                <div class="col-lg-6">
                                    <div class="input-group">

                                        <input tabindex="27" type="reset" class="btn btn-success"  value="Effacer le formulaire"/>

                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->

                            </div><!-- /.row -->



                        </div>
                    </div>
                </div>
            </div>






        </form>
    </div>
@endsection
