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
                        <li><a href="#">Etudiants</a></li>
                        <li class="active">Ajouter étudiant</li>
                    </ol>
                </div>
            </div>

        <form id="" action="{{route('SaveStudent')}}" method="post">
            {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info ">

                    <div class="panel-heading"><strong>Liste des etudiants:</strong> <span class="badge">{{ \App\Etudiant::count() }} etudiant(s)</span> <a style="float: right" href="{{ route('ShowStudent') }}" title="Lister les etudiants" class="glyphicon glyphicon-align-justify"></a> </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-default">Date</label>
                                </span>
                                    <input autofocus  tabindex="1" value="{{date('Y-m-d')}}" required type="date" id="DATE_INSCRIPTION" name="DATE_INSCRIPTION" class="form-control" placeholder="">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Matricule</button>
                                </span>
                                    <input value="{{ isset($_POST['MATRICULE'])?$_POST['MATRICULE']:''  }}" maxlength="10" style='text-transform:uppercase' tabindex="2" required id="MATRICULE" name="MATRICULE" type="text" class="form-control" placeholder="max 10 caractères">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Nom</button>
                                </span>
                                    <input tabindex="3" style='text-transform:uppercase' required id="NOM_ETUDIANT" name="NOM_ETUDIANT" type="text" class="form-control" placeholder="">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Prénom</button>
                                </span>
                                    <input tabindex="4" style='text-transform:uppercase' required id="PRENOM_ETUDIANT" name="PRENOM_ETUDIANT" type="text" class="form-control" placeholder="">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->
                        <br>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Date de naissance</button>
                                </span>
                                    <input tabindex="5" required id="DATE_NAISSANCE" name="DATE_NAISSANCE" type="date" class="form-control" placeholder="">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Lieu</button>
                                </span>
                                    <input tabindex="7" style='text-transform:uppercase' list="LISTE_LIEU" required id="LIEU" name="LIEU" type="text" class="form-control" placeholder="">
                                    <datalist id="LISTE_LIEU">
                                        <option value="TUNIS">
                                        <option value="MANOUBA">
                                        <option value="ARIANA">
                                        <option value="SOUSSE">
                                        <option value="GABES">
                                        <option value="GAFSA">
                                        <option value="MEDENINE">
                                        <option value="DJERBA">
                                        <option value="TATAOUINE">
                                        <option value="BIZERTE">
                                    </datalist>
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->

                        <br>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Némero CIN/Passport</button>
                                </span>
                                    <input tabindex="7" required id="CIN_PASSPORT" name="CIN_PASSPORT" type="text" class="form-control" placeholder="">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button  class="btn btn-default" type="button">Nationalité</button>
                                </span>
                                    <input tabindex="9" style='text-transform:uppercase' required id="NATIONALITE" name="NATIONALITE" type="text" class="form-control" placeholder="">
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
                                    <input tabindex="12" required id="CP" name="CP" type="number"  maxlength="8" class="form-control" placeholder="">
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
                                    <button class="btn btn-default" type="button">Niveau scolaire</button>
                                </span>
                                    <input tabindex="15" style='text-transform:uppercase' required id="NIVEAU_SCOLAIRE" name="NIVEAU_SCOLAIRE" type="text" class="form-control" placeholder="">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->

                        </div><!-- /.row -->


                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary ">
                    <div class="panel-heading">Tuteur</div>

                    <div class="panel-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Nom</button>
                                </span>
                                    <input tabindex="16" style='text-transform:uppercase' id="NOM_TUTEUR" name="NOM_TUTEUR" type="text" class="form-control" placeholder="">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Prénom</button>
                                </span>
                                    <input tabindex="17" style='text-transform:uppercase' id="PRENOM_TUTEUR" name="PRENOM_TUTEUR" type="text" class="form-control" placeholder="">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->

                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Tél</button>
                                </span>
                                    <input tabindex="18" id="TEL_TUTEUR" name="TEL_TUTEUR" type="tel" class="form-control" placeholder="">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Email</button>
                                </span>
                                    <input tabindex="19" style='text-transform:uppercase' id="EMAIL_TUTEUR" name="EMAIL_TUTEUR" type="email" class="form-control" placeholder="">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->



                        <br>
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Observation</button>
                                </span>
                                    <textarea tabindex="19" style='text-transform:uppercase' id="OBSERVATION" name="OBSERVATION" type="text" class="form-control" placeholder=""></textarea>
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

                                    <input tabindex="26" type="submit" class="btn btn-danger"  value="Enregister cet etudiant"/>

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
