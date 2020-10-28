@extends('layouts.app')

@section('content')
    <div class="container">

        @if(Session::has('msg'))
        <div class="alert alert-success">
            <ul>
                {{Session::get("msg")}}
             </ul>
         </div>
        @endif



            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/home') }}">Accueil</a></li>
                        <li><a href="#">Inscriptions</a></li>
                        <li class="active">Liser les inscriptions</li>
                    </ol>
                </div>
            </div>

        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-info ">
                    <div class="panel-heading"><strong>Liste d'inscriptions:</strong> <span class="badge">{{ \App\Register::count() }} inscription(s)</span> <a style="float: right" href="{{ route('AddRegister') }}" title="Ajouter une nouvelle inscription" class="glyphicon glyphicon-plus-sign"></a> </div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-striped table-responsive" >
                                    <tr>
                                        <th style="width: 20%" >D.Insc</th>
                                        <th style="width: 20%" >Etudiant</th>
                                        <th>Formation</th>

                                        <th>Session</th>
                                        <th>Groupe</th>
                                        <th colspan="4">Actions</th>
                                    </tr>
                                    @foreach($AllRegister as $CF)
                                    <tr id="{{$CF->id}}">
                                        <td><?php  echo date('d/m/Y', strtotime($CF->DATE_INSCRIPTION)); ?> </td>

                                        <td > {{ App\Etudiant::find($CF->ETUDIANT)->NOM_ETUDIANT }} {{ App\Etudiant::find($CF->ETUDIANT)->PRENOM_ETUDIANT }}<d>

                                        <td>{{ App\Diplome::find($CF->DIPLOME)->LIBELLE }} </td>
                                        <td>{{ App\Session::find($CF->SESSION)->LIBELLE }} </td>
                                        <td>{{ App\Groupe::find($CF->GROUPE)->LIBELLE }} </td>

                                        <td  ><a target="_blank"  href="{{route('PDFRegister',$CF->id)}}" title="Imprimer" class="glyphicon glyphicon-print" aria-hidden="true"></a></td>
                                        <td  data-toggle="modal" data-target="#ModalDetails{{$CF->id}}" data-whatever="@mdo" ><span title="Détails" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></td>
                                        <td  data-toggle="modal" data-target="#ModalEdit{{$CF->id}}" data-whatever="@mdo" ><span title="Modifier" class="glyphicon glyphicon-edit" aria-hidden="true"></span></td>
                                        <td  data-toggle="modal" data-target="#ModalDel{{$CF->id}}" data-whatever="@mdo" ><span title="Supprimer" class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                        <!----------->
                                        <div class="modal fade" id="ModalDetails{{$CF->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                            <div class="modal-dialog" role="document">

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Détails de la formation  N°{{$CF->id}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="control-label">Societe:</label>
                                                                <input disabled required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control" value="{{ $CF->SOCIETE !=0 ? App\Company::find($CF->SOCIETE)->NOM : 'AUCUNE' }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="control-label">Type de la formation:</label>
                                                                <input disabled required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control"  value="{{App\Categorie::find($CF->TYPE_FORMATION)->LIBELLE  }}">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">D.inscription:</label>
                                                                        <input disabled required style="text-transform: capitalize" type="text" class="form-control"  value="{{$CF->DI}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">D.Examen:</label>
                                                                        <input disabled required style="text-transform: capitalize" type="text" class="form-control"  value="{{$CF->DE}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                <div class="form-group">
                                                                <label for="message-text" class="control-label">Nbre:</label>
                                                                <input disabled required style="text-transform: capitalize" type="text" class="form-control"  value="{{$CF->NB}}">
                                                            </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">P.U:</label>
                                                                <input disabled required style="text-transform: capitalize" type="text" class="form-control"  value="{{$CF->PU}}">
                                                            </div>
                                                                    </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">Mode de formation:</label>
                                                                <input disabled required style="text-transform: capitalize" type="text" class="form-control"  value="{{App\ModeForma::find($CF->MODE_FORMATION)->LIBELLE}}">
                                                            </div>
                                                                </div>

                                                                    <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">Total:</label>
                                                                <input disabled required style="text-transform: capitalize" type="text" class="form-control"  value="{{$CF->TOTAL}}">
                                                            </div>
                                                                    </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">Dossier scolaire:</label>
                                                                        <input disabled required style="text-transform: capitalize" type="text" class="form-control"  value="{{$CF->DOSSIER_SCOLAIRE}}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">Décision:</label>
                                                                        <input disabled required style="text-transform: capitalize" type="text" class="form-control" name="TOTAL" id="TOTAL" value="{{$CF->DECISION}}">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">Observation:</label>
                                                                        <input disabled required style="text-transform: capitalize" type="text" class="form-control"  value="{{$CF->OBSERVATION}}">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                            </div>
                                        </div>
                                        <!----------->
                                        <div class="modal fade" id="ModalEdit{{$CF->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <form action="UpdateRegister" method="post" name="CAT{{$CF->id}} " id="CAT{{$CF->id}}">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="id" id="id" value="{{$CF->id}}">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="exampleModalLabel">Modifier l'inscription N°{{$CF->id}}</h4>
                                                    </div>
                                                    <div class="modal-body">



                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="message-text" class="control-label">Date d'inscription:</label>
                                                                    <input value="{{$CF->DATE_INSCRIPTION}}" style='text-transform:uppercase' id="DATE_INSCRIPTION" name="DATE_INSCRIPTION" type="date" class="form-control">

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="message-text" class="control-label">Societe:</label>
                                                                    <select tabindex="21"style='text-transform:uppercase' id="SOCIETE" name="SOCIETE" type="text" class="form-control">

                                                                        <option value="0">AUCUNE</option>
                                                                        @foreach($AllCompany as $S)
                                                                            <option  value="{{$S->id}}"  {{ ($CF->SOCIETE ===$S->id) ? "selected" : '' }} > <strong>{{$S->NOM}}</strong>   </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="message-text" class="control-label">FORMATION:</label>
                                                                    <select tabindex="21"style='text-transform:uppercase' id="DIPLOME" name="DIPLOME" type="text" class="form-control">

                                                                        <option value="0">AUCUNE</option>
                                                                        @foreach($AllDip as $S)
                                                                            <option  value="{{$S->id}}"  {{ ($CF->DIPLOME ===$S->id) ? "selected" : '' }} > <strong>{{$S->LIBELLE}}</strong>   </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="message-text" class="control-label">SESSION:</label>
                                                            <select tabindex="21"style='text-transform:uppercase' id="SESSION" name="SESSION" type="text" class="form-control">
                                                            @foreach($AllSession as $S)
                                                                <option  value="{{$S->id}}"  {{ ($CF->SESSION ===$S->id) ? "selected" : '' }} > <strong>{{$S->LIBELLE}}</strong>   </option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="message-text" class="control-label">GROUPE:</label>
                                                            <select tabindex="21"style='text-transform:uppercase' id="GROUPE" name="GROUPE" type="text" class="form-control">
                                                                @foreach($AllGroupe as $G)
                                                                    <option  value="{{$G->id}}"  {{ ($CF->GROUPE ===$G->id) ? "selected" : '' }} > <strong>{{$G->LIBELLE}}</strong>   </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="message-text" class="control-label">D.inscription:</label>
                                                                    <input onchange="calculer_total_formation_edit()"   required style="text-transform: capitalize" type="text" class="form-control" name="DIE" id="DIE" value="{{$CF->DI}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="message-text" class="control-label">D.Examen:</label>
                                                                    <input onchange="calculer_total_formation_edit()"   required style="text-transform: capitalize" type="text" class="form-control" name="DEE" id="DEE" value="{{$CF->DE}}">
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="message-text" class="control-label">Nbre:</label>
                                                                    <input onchange="calculer_total_formation_edit()"  required style="text-transform: capitalize" type="text" class="form-control" name="NBE" id="NBE" value="{{$CF->NB}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="message-text" class="control-label">P.U:</label>
                                                                    <input onchange="calculer_total_formation_edit()"  required style="text-transform: capitalize" type="text" class="form-control" name="PUE" id="PUE" value="{{$CF->PU}}">
                                                                </div>
                                                            </div>

                                                        </div>



                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="message-text" class="control-label">Mode de la formation:</label>
                                                                    <select tabindex="21"style='text-transform:uppercase' id="MODE_FORMATION" name="MODE_FORMATION" type="text" class="form-control">
                                                                        @foreach($AllModeForma as $MF)
                                                                            <option  value="{{$MF->id}}"  {{ ($CF->MODE_FORMATION ===$MF->id) ? "selected" : '' }} > <strong>{{$MF->LIBELLE}}</strong>   </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="message-text" class="control-label">Total:</label>
                                                                    <input  required style="text-transform: capitalize" type="text" class="form-control" name="TOTALE" id="TOTALE" value="{{$CF->TOTAL}}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="message-text" class="control-label">DOSSIER SCOLAIRE:</label>
                                                                    <select tabindex="21"style='text-transform:uppercase' id="DOSSIER_SCOLAIRE" name="DOSSIER_SCOLAIRE" type="text" class="form-control">
                                                                        <option  value="COMPLET"  {{ ($CF->DOSSIER_SCOLAIRE ==='COMPLET') ? "selected" : '' }} > <strong>COMPLET</strong>   </option>
                                                                        <option  value="INCOMPLET"  {{ ($CF->DOSSIER_SCOLAIRE ==='INCOMPLET') ? "selected" : '' }} > <strong>INCOMPLET</strong>   </option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="message-text" class="control-label">DECISION:</label>
                                                                    <select tabindex="21"style='text-transform:uppercase' id="DECISION" name="DECISION" type="text" class="form-control">

                                                                        <option  value="ACCEPTE"  {{ ($CF->DECISION ==='ACCEPTE') ? "selected" : '' }} > <strong>ACCEPTE</strong>   </option>
                                                                        <option  value="NON ACCEPTE"  {{ ($CF->DECISION ==='NON ACCEPTE') ? "selected" : '' }} > <strong>NON ACCEPTE</strong>   </option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="message-text" class="control-label">Observation:</label>
                                                                    <textarea tabindex="21"style='text-transform:uppercase' id="OBSERVATION" name="OBSERVATION" type="text" class="form-control">{{ $CF->OBSERVATION }}</textarea>

                                                                </div>
                                                            </div>

                                                        </div>

                                                        <?php date_default_timezone_set('Africa/Tunis'); ?>
                                                        <input type="hidden" name="updated_at" value="{{date('Y-m-d H:i:s')}}" />


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button  class="btn btn-default"  data-dismiss="modal">Fermer</button>
                                                        <button  onclick="$('#CAT<?php echo $CF->id; ?> ').submit()"  class="btn btn-primary">Enregistrer</button>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!----------->
                                        <!----------->
                                        <div class="modal fade" id="ModalDel{{$CF->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <form action="DelRegister" method="post" name="CATDel{{$CF->id}} " id="CAT{{$CF->id}}">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="id" id="id" value="{{$CF->id}}">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Supprimer l'inscription N°{{$CF->id}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Voulez vous vraiment supprimer cette inscription?</p>



                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="reset" class="btn btn-default" value="Fermer" data-dismiss="modal">
                                                            <input type="submit" onclick="$('#CATDel<?php echo $CF->id; ?> ').submit()"  class="btn btn-danger" value="Supprimer"/>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!----------->
                                    </tr>
                                        @endforeach

                                </table>
                                {{ $AllRegister->links() }}

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
