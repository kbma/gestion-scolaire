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
                        <li><a href="#">Inscriptions</a></li>
                        <li class="active">Nouvelle inscription</li>
                    </ol>
                </div>
            </div>

        <form id="" action="{{route('SaveRegister')}}" method="post">
            {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info ">
                    <div class="panel-heading"><strong>Nouvelle inscription</strong> <a style="float: right" href="{{ route('ShowRegister') }}" title="Lister les inscriptions" class="glyphicon glyphicon-align-justify"></a></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Etudiant</button>
                                </span>
                                    <select   maxlength="8" tabindex="3" onkeyup='this.value=this.value.toUpperCase()' required id="ETUDIANT" name="ETUDIANT"  class="form-control" >
                                        @foreach($AllEtudiants as $E)
                                            <option  value="{{$E->id}}"  > <strong> {{strtoupper($E->NOM_ETUDIANT)}} {{strtoupper($E->PRENOM_ETUDIANT)}}</strong>   </option>
                                        @endforeach
                                    </select>
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Societe</button>
                                </span>
                                    <select   maxlength="8" tabindex="3" onkeyup='this.value=this.value.toUpperCase()' required id="SOCIETE" name="SOCIETE"  class="form-control" >
                                        <option value="0">AUCUNE</option>
                                        @foreach($AllCompany as $C)
                                            <option  value="{{$C->id}}"  > <strong> {{strtoupper($C->NOM)}}</strong>   </option>
                                        @endforeach
                                    </select>
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->


                        <br>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Date</button>
                                </span>
                                    <input required id="DATE_INSCRIPTION" name="DATE_INSCRIPTION" type="date" value="<?php echo date('Y-m-d'); ?>"  class="form-control" />

                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->

                        </div><!-- /.row -->


                    </div>
                </div>
            </div>
        </div>


            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-primary">
                        <div class="panel-heading" ><strong>Formation</strong></div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Type de formation</button>
                                </span>
                                        <select onchange="charger_diplomes()" tabindex="20" id="TYPE_FORMATION" name="TYPE_FORMATION"  class="form-control" placeholder="">
                                            <option value="-1">Selectionner un type</option>
                                            @foreach($AllCat as $c)
                                                <option value="{{ $c->id }}">{{ $c->LIBELLE }}</option>
                                            @endforeach
                                        </select>
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                            </div><!-- /.row -->
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Formation</button>
                                </span>
                                        <select tabindex="21"style='text-transform:uppercase' id="DIPLOME" name="DIPLOME" type="text" class="form-control">
                                        </select>
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Session</button>
                                </span>
                                        <select onchange="charger_diplomes()" tabindex="20" id="SESSION" name="SESSION"  class="form-control" placeholder="">
                                            @foreach($AllSession as $c)
                                                <option value="{{ $c->id }}">{{ $c->LIBELLE }}</option>
                                            @endforeach


                                        </select>
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->

                                <div class="col-lg-6">
                                    <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Groupe</button>
                                </span>
                                        <select onchange="charger_diplomes()" tabindex="20" id="GROUPE" name="GROUPE"  class="form-control" placeholder="">
                                            @foreach($AllGroupe as $c)
                                                <option value="{{ $c->id }}">{{ $c->LIBELLE }}</option>
                                            @endforeach


                                        </select>
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->

                            </div><!-- /.row -->

<br>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Mode de formation</button>
                                </span>
                                        <select onchange="charger_diplomes()" tabindex="20" id="MODE_FORMATION" name="MODE_FORMATION"  class="form-control" placeholder="">
                                            @foreach($AllModeForma as $c)
                                                <option value="{{ $c->id }}">{{ $c->LIBELLE }}</option>
                                            @endforeach


                                        </select>
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->

                            </div><!-- /.row -->

                                <br>

                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table">
                                        <thead >
                                        <tr class="info">
                                            <th>D. Insc</th>
                                            <th>D.Exam</th>

                                            <th>Nombre</th>
                                            <th>P.U</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                         <td> <input size="3" onchange="calculer_total_formation()"    required id="DI" name="DI" type="text" class="form-control" placeholder=""></td>
                                            <td> <input size="3" onchange="calculer_total_formation()"   required id="DE" name="DE" type="text" class="form-control" placeholder=""></td>

                                            <td> <input size="3" onchange="calculer_total_formation()"   required id="NB" name="NB" type="text" class="form-control" placeholder=""></td>
                                            <td> <input size="4" onchange="calculer_total_formation()"   required id="PU" name="PU" type="text" class="form-control" placeholder=""></td>
                                            <td> <input size="4"   required id="TOTAL" name="TOTAL" type="text" class="form-control" placeholder=""></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div><!-- /.col-lg-6 -->

                            </div><!-- /.row -->




                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-danger  ">
                        <div class="panel-heading"><strong>Administration</strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Dossier scolaire</button>
                                </span>
                                        <select tabindex="23"  id="DOSSIER_SCOLAIRE" name="DOSSIER_SCOLAIRE"  class="form-control" placeholder="">
                                            <option value="COMPLET">COMPLET</option>
                                            <option value="INCOMPLET">INCOMPLET</option>
                                        </select>
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Decision</button>
                                </span>
                                        <select tabindex="23" id="DECISION" name="DECISION"  class="form-control" placeholder="">
                                            <option value="ACCEPTE">ACCEPTE</option>
                                            <option value="NON ACCEPTE">NON ACCEPTE</option>
                                        </select>
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
                                        <input tabindex="25" style='text-transform:uppercase' id="OBSERVATION" name="OBSERVATION" type="text" class="form-control" placeholder="">
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

                                    <input tabindex="26" type="submit" class="btn btn-danger"  value="Enregister cette inscription"/>

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
