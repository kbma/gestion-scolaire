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
                        <div class="panel-heading"><strong>Dépences</strong></div>
                        <div class="panel-body">
                            <form action="SaveDepence" method="post">
                            <div class="row">
                                    {{ csrf_field() }}
                                <input type="hidden"  name="TYPE" id="TYPE" value="2">
                                <input type="hidden" name="ETUDIANT" id="ETUDIANT" value="0">
                                <input type="hidden" name="ETUDIANT_SESSION" id="ETUDIANT_SESSION" value="0">
                                <input type="hidden" name="ETUDIANT_FORMATION" id="ETUDIANT_FORMATION" value="0">

                                <input type="hidden" name="ENTREPRISE" id="ENTREPRISE" value="0">
                                <input type="hidden" name="ENTREPRISE_SESSION" id="ENTREPRISE_SESSION" value="0">
                                <input type="hidden" name="ENTREPRISE_FORMATION" id="ENTREPRISE_FORMATION" value="0">

                                <input type="hidden" name="MOTIF_RECETTE" id="MOTIF_RECETTE" value="">
                                <input type="hidden" name="MONTANT_RECETTE" id="MONTANT_RECETTE" value="0">

                                <input type="hidden" name="created_at" value="{{date('Y-m-d H:i:s')}}" />
                                <input type="hidden" name="updated_at" value="{{date('Y-m-d H:i:s')}}" />
                                <input type="hidden" name="REGISTER" id="REGISTER" value="0" />


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
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Prestataire</button>
                                </span>
                                            <select  required id="PRESTATAIRE" name="PRESTATAIRE"  class="form-control">
                                                <option value="0">AUCUN</option>
                                                @foreach($AllPrestataires as $MP)
                                                    <option value="{{ $MP->id }}">{{ strtoupper ($MP->NOM) }}</option>
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
                                    <button class="btn btn-default" type="button">Motif</button>
                                </span>
                                            <input type="text" required id="MOTIF_DEPENCE" name="MOTIF_DEPENCE" class="form-control">

                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->

                                </div><!-- /.row -->
                                <br>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">Montant</button></span>
                                            <input type="text"   required id="MONTANT_DEPENCE" name="MONTANT_DEPENCE"  class="form-control">
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
