@extends('layouts.app')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">


        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!----------------------------------------------------Recette /Depences -------------------------------------->


            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-info ">
                        <div class="panel-heading"><strong>Recettes</strong></div>
                        <div class="panel-body">
                            <form action="SaveRecette" method="post">
                            <div class="row">
                                    {{ csrf_field() }}

                                <input type="hidden"  name="TYPE" id="TYPE" value="1">
                                <input type="hidden" name="PRESTATAIRE" id="PRESTATAIRE" value="0">

                                <input type="hidden" name="ENTREPRISE" id="ENTREPRISE" value="0">
                                <input type="hidden" name="MOTIF_DEPENCE" id="MOTIF_DEPENCE" value="">
                                <input type="hidden" name="MONTANT_DEPENCE" id="MONTANT_DEPENCE" value="0">

                                <input type="hidden" name="created_at" value="{{date('Y-m-d H:i:s')}}" />
                                <input type="hidden" name="updated_at" value="{{date('Y-m-d H:i:s')}}" />
                                <input type="hidden" name="REGISTER" id="REGISTER" value="" />

                                <div class="col-lg-4">
                                    <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">N°</button>
                                </span>
                                        <input autofocus maxlength="8" tabindex="2" onkeyup='this.value=this.value.toUpperCase()' required id="NUMERO" name="NUMERO" type="text" class="form-control" placeholder="">
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->

                                    <div class="col-lg-4">
                                        <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Date</button>
                                </span>
                                            <input   tabindex="1"  required id="DATE_OPERATION" name="DATE_OPERATION" value="<?php  echo date('Y-m-d'); ?>" type="date" class="form-control">
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->

                                <div class="col-lg-4">
                                    <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Mode</button>
                                </span>

                                        <select   required id="MODE" name="MODE"  class="form-control">
                                            @foreach($AllModePayement as $MP)
                                                <option value="{{ $MP->id }}">{{ $MP->LIBELLE }}</option>
                                            @endforeach
                                        </select>
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->


                            </div><!-- /.row -->

                                <br>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Etudiant</button>
                                </span>
                                            <select  onchange="charger_sessions_etudiant()"  required id="ETUDIANT" name="ETUDIANT"  class="form-control">
                                                <option value="0">Aucun</option>
                                                @foreach($AllEtudiants as $MP)
                                                    <option value="{{ $MP->id }}">{{ $MP->NOM_ETUDIANT }} {{ $MP->PRENOM_ETUDIANT }}</option>
                                                @endforeach
                                            </select>

                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->

                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">Session</button></span>
                                            <select onchange="charger_formation_etudiant()"   required id="SESSION_ETUDIANT" name="SESSION_ETUDIANT"  class="form-control">
                                                <option value="0">Aucun</option>
                                            </select>
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->

                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">Formation</button></span>
                                            <select onchange="get_total_etudiant()"  required id="DIPLOME_ETUDIANT" name="DIPLOME_ETUDIANT"  class="form-control">
                                                <option value="0">Aucun</option>
                                            </select>
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->


                                </div><!-- /.row -->
                                <br>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Entreprise</button>
                                </span>
                                            <select  onchange="charger_session_entreprise()" required id="ENTREPRISE" name="ENTREPRISE"  class="form-control">
                                                <option value="0">Aucun</option>
                                                @foreach($AllCompany as $MP)
                                                    <option value="{{ $MP->id }}">{{ $MP->NOM }}</option>
                                                @endforeach
                                            </select>

                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->

                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">Session</button></span>
                                            <select onchange="charger_formation_entreprise()"   required id="SESSION_ENTREPRISE" name="SESSION_ENTREPRISE"  class="form-control">
                                                <option value="0">Aucun</option>
                                            </select>
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->

                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">Formation</button></span>
                                            <select onchange="get_total_entreprise()"   required id="DIPLOME_ENTREPRISE" name="DIPLOME_ENTREPRISE"  class="form-control">
                                                <option value="0">Aucun</option>
                                            </select>
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->
                                </div><!-- /.row -->
                                <br>
                                <div class="row">

                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">TOTAL</button></span>
                                            <input type="text" disabled id="TOTAL" name="TOTAL"  class="form-control">
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">Reste</button></span>
                                            <input type="text" disabled   required id="RESTE" name="RESTE"  class="form-control">
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->


                                </div><!-- /.row -->
                                <br>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Motif</button>
                                </span>
                                            <input type="text" required id="MOTIF_RECETTE" name="MOTIF_RECETTE" class="form-control">


                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->

                                </div><!-- /.row -->
                                <br>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">Montant</button></span>
                                            <input type="text" onchange="$('#RESTE_A_PAYE').val(parseFloat($('#RESTE').val() -$('#MONTANT_RECETTE').val() ));"    required id="MONTANT_RECETTE" name="MONTANT_RECETTE"  class="form-control">
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">Reste à payer</button></span>
                                            <input type="text"  disabled   required id="RESTE_A_PAYE" name="RESTE_A_PAYE"  class="form-control">
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->

                                </div><!-- /.row -->
                                <br>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <input tabindex="26" type="submit" class="btn btn-danger"  value="Valider"/>

                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <input tabindex="27" type="reset" class="btn btn-success"  value="Effacer le formulaire"/>

                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->

                                </div><!-- /.row -->




                            </form>

                        </div>
                    </div>
                </div>
            </div>

    </div>
@endsection
