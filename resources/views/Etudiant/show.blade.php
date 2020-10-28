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
                    <li><a href="#">Clients</a></li>
                    <li class="active">Liser les étudiants</li>
                </ol>
            </div>
        </div>



    <div class="row">
        <div class="col-md-12">

        <form  action="{{route('SearchStudent')}}">
            <div class="col-md-6">
                <div class="form-group">
                    <input value="{{ isset($_GET['key'])?$_GET['key']:'' }}" type="text" id="key" name="key" class="form-control" placeholder="Nom,Prénom,Matricule">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Chercher</button>

                </div>
            </div>
        </form>
        </div>
    </div>

        <!--------------------------------------------------------------------------->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info ">
                    <div class="panel-heading"><strong>Liste des etudiants:</strong> <span class="badge">{{ \App\Etudiant::count() }} etudiant(s)</span> <a style="float: right" href="{{ route('AddStudent') }}" title="Ajouter un etudiant" class="glyphicon glyphicon-plus-sign"></a> </div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-lg-12">


                                <table class="table table-striped table-responsive" >
                                    <tr>
                                        <th>D.inscription</th>
                                        <th>Matricule</th>
                                        <th>CIN / Passport</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Tel</th>

                                      <!--  <th>Lieu</th>
                                        <th>CIN.Passport</th>
                                        <th>Ville</th>
                                        <th>Email</th> -->
                                        <th colspan="5">Actions</th>
                                    </tr>
                                    @foreach($AllEtudiant as $CF)
                                        <tr id="{{$CF->id}}">

                                            <td><?php  echo date('d/m/Y', strtotime($CF->DATE_INSCRIPTION)); ?> </td>
                                            <td > {{ $CF->MATRICULE}} <d>
                                            <td > {{ $CF->CIN_PASSPORT}} <d>
                                            <td > {{ $CF->NOM_ETUDIANT}}<d>
                                            <td >  {{ $CF->PRENOM_ETUDIANT }}<d>
                                            <td >  {{ $CF->TEL }}<d>
                                            <td> {!! ($CF->ACTIVE ==1) ? '<a href="'.route('DisableStudent',$CF->id).'"><span  class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>' : '<a href="'.route('EnableStudent',$CF->id).'"><span  class="glyphicon glyphicon-eye-close" aria-hidden="true"></span></a>' !!}</td>



                                            <td  ><a target="_blank"  href="" title="Imprimer fiche etudiant" class="glyphicon glyphicon-print" aria-hidden="true"></a></td>
                                            <td  data-toggle="modal" data-target="#ModalDetails{{$CF->id}}" data-whatever="@mdo" ><span title="Détails" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></td>
                                            <td  data-toggle="modal" data-target="#ModalEdit{{$CF->id}}" data-whatever="@mdo" ><span title="Modifier" class="glyphicon glyphicon-edit" aria-hidden="true"></span></td>
                                            <td  data-toggle="modal" data-target="#ModalDel{{$CF->id}}" data-whatever="@mdo" ><span title="Supprimer" class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                            <!----------->
                                            <div class="modal fade" id="ModalDetails{{$CF->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                                <div class="modal-dialog" role="document">

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Détails de l'étudiant {{$CF->NOM_ETUDIANT}} {{$CF->PRENOM_ETUDIANT}}</h4>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="control-label">Date de naissance:</label>
                                                                <input disabled required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control" value="{{ $CF->DATE_NAISSANCE}}">
                                                            </div>
                                                                </div>

                                                                    <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                <label for="recipient-name" class="control-label">Lieu:</label>
                                                                <input disabled required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control"  value="{{$CF->LIEU  }}">
                                                                    </div>
                                                                    </div>

                                                            </div>
                                                            <div class="row">

                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">NATIONALITE:</label>
                                                                        <input disabled required style="text-transform: capitalize" type="text" class="form-control"  value="{{$CF->NATIONALITE}}">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="row">

                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">Adresse</label>
                                                                        <input disabled required style="text-transform: capitalize" type="text" class="form-control"  value="{{$CF->ADRESSE}}">
                                                                    </div>
                                                                </div>


                                                            </div>



                                                            <div class="row">

                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">Ville</label>
                                                                        <input disabled required style="text-transform: capitalize" type="text" class="form-control"  value="{{$CF->VILLE}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">CP</label>
                                                                        <input disabled required style="text-transform: capitalize" type="text" class="form-control"  value="{{$CF->CP}}">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">Niveau scolaire:</label>
                                                                        <input disabled required style="text-transform: capitalize" type="text" class="form-control"  value="{{$CF->NIVEAU_SCOLAIRE}}">
                                                                    </div>
                                                                </div>

                                                            </div>



                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">PRENOM_TUTEUR:</label>
                                                                        <input disabled required style="text-transform: capitalize" type="text" class="form-control"  value="{{$CF->PRENOM_TUTEUR}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">NOM_TUTEUR:</label>
                                                                        <input disabled required style="text-transform: capitalize" type="text" class="form-control" name="NOM_TUTEUR" id="NOM_TUTEUR" value="{{$CF->NOM_TUTEUR}}">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">TEL_TUTEUR:</label>
                                                                        <input disabled required style="text-transform: capitalize" type="text" class="form-control"  value="{{$CF->TEL_TUTEUR}}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">EMAIL_TUTEUR:</label>
                                                                        <input disabled required style="text-transform: capitalize" type="text" class="form-control" name="TOTAL" id="TOTAL" value="{{$CF->EMAIL_TUTEUR}}">
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
                                            <!------->



                                            <!----------->
                                            <div class="modal fade" id="ModalEdit{{$CF->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <form action="UpdateStudent" method="post" name="CAT{{$CF->id}} " id="CAT{{$CF->id}}">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="id" id="id" value="{{$CF->id}}">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="exampleModalLabel">Modifier l'étudiant N°{{$CF->id}}</h4>
                                                            </div>


                                                            <div class="modal-body">

                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="recipient-name" class="control-label">Date d'inscription:</label>
                                                                            <input  required onkeyup='this.value=this.value.toUpperCase()' id="DATE_INSCRIPTION" name="DATE_INSCRIPTION" type="date" class="form-control" value="{{ $CF->DATE_INSCRIPTION}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="recipient-name" class="control-label">Matricule:</label>
                                                                            <input  required onkeyup='this.value=this.value.toUpperCase()' id="MATRICULE" name="MATRICULE" type="text" class="form-control"  value="{{$CF->MATRICULE  }}">
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="recipient-name" class="control-label">Nom:</label>
                                                                            <input  required onkeyup='this.value=this.value.toUpperCase()' id="NOM_ETUDIANT" name="NOM_ETUDIANT" type="text" class="form-control" value="{{ $CF->NOM_ETUDIANT}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="recipient-name" class="control-label">Prénom:</label>
                                                                            <input  required onkeyup='this.value=this.value.toUpperCase()' id="PRENOM_ETUDIANT" name="PRENOM_ETUDIANT" type="text" class="form-control"  value="{{$CF->PRENOM_ETUDIANT  }}">
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="recipient-name" class="control-label">Tel:</label>
                                                                            <input  required onkeyup='this.value=this.value.toUpperCase()' id="TEL" name="TEL" type="text" class="form-control" value="{{ $CF->TEL}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="recipient-name" class="control-label">Email:</label>
                                                                            <input  required onkeyup='this.value=this.value.toUpperCase()' id="EMAIL" name="EMAIL" type="text" class="form-control"  value="{{$CF->EMAIL  }}">
                                                                        </div>
                                                                    </div>
                                                                </div>




                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="recipient-name" class="control-label">Date de naissance:</label>
                                                                            <input  required onkeyup='this.value=this.value.toUpperCase()' id="DATE_NAISSANCE" name="DATE_NAISSANCE" type="text" class="form-control" value="{{ $CF->DATE_NAISSANCE}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="recipient-name" class="control-label">Lieu:</label>
                                                                            <input  required onkeyup='this.value=this.value.toUpperCase()' id="LIEU" name="LIEU" type="text" class="form-control"  value="{{$CF->LIEU  }}">
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="message-text" class="control-label">CIN /PASSPORT:</label>
                                                                            <input   style="text-transform: capitalize" type="text" name="CIN_PASSPORT" id="CIN_PASSPORT" class="form-control"  value="{{$CF->CIN_PASSPORT}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="message-text" class="control-label">NATIONALITE:</label>
                                                                            <input  required style="text-transform: capitalize" type="text" id="NATIONALITE" name="NATIONALITE" class="form-control"  value="{{$CF->NATIONALITE}}">
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="row">

                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label for="message-text" class="control-label">Adresse</label>
                                                                            <input  required style="text-transform: capitalize" type="text" class="form-control" id="ADRESSE" name="ADRESSE"  value="{{$CF->ADRESSE}}">
                                                                        </div>
                                                                    </div>


                                                                </div>



                                                                <div class="row">

                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="message-text" class="control-label">Ville</label>
                                                                            <input  required style="text-transform: capitalize" type="text" class="form-control" id="VILLE" name="VILLE"  value="{{$CF->VILLE}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="message-text" class="control-label">CP</label>
                                                                            <input  required style="text-transform: capitalize" type="text" class="form-control" name="CP" id="CP"  value="{{$CF->CP}}">
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label for="message-text" class="control-label">Niveau scolaire:</label>
                                                                            <input  required style="text-transform: capitalize" type="text" class="form-control" id="NIVEAU_SCOLAIRE" name="NIVEAU_SCOLAIRE" value="{{$CF->NIVEAU_SCOLAIRE}}">
                                                                        </div>
                                                                    </div>

                                                                </div>



                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="message-text" class="control-label">PRENOM_TUTEUR:</label>
                                                                            <input  required style="text-transform: capitalize" type="text" class="form-control" name="PRENOM_TUTEUR" id="PRENOM_TUTEUR" value="{{$CF->PRENOM_TUTEUR}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="message-text" class="control-label">NOM_TUTEUR:</label>
                                                                            <input  required style="text-transform: capitalize" type="text" class="form-control" name="NOM_TUTEUR" id="NOM_TUTEUR" value="{{$CF->NOM_TUTEUR}}">
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="message-text" class="control-label">TEL_TUTEUR:</label>
                                                                            <input  required style="text-transform: capitalize" type="text" class="form-control" name="TEL_TUTEUR" id="TEL_TUTEUR" value="{{$CF->TEL_TUTEUR}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="message-text" class="control-label">EMAIL_TUTEUR:</label>
                                                                            <input  required style="text-transform: capitalize" type="text" class="form-control" name="EMAIL_TUTEUR" id="EMAIL_TUTEUR" value="{{$CF->EMAIL_TUTEUR}}">
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label for="message-text" class="control-label">Observation:</label>
                                                                            <input  style="text-transform: capitalize" type="text" class="form-control" name="OBSERVATION" id="OBSERVATION" value="{{$CF->OBSERVATION}}">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <?php date_default_timezone_set('Africa/Tunis'); ?>
                                                            <input type="hidden" name="updated_at" value="{{date('Y-m-d H:i:s')}}" />

                                                            <div class="modal-footer">
                                                                <button  class="btn btn-default"  data-dismiss="modal">Fermer</button>
                                                                <button  onclick="$('#CAT<?php echo $CF->id; ?> ').submit()"  class="btn btn-primary">Enregistrer</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!----------->






















                                                <!----->
                                            <!----------->
                                            <div class="modal fade" id="ModalDel{{$CF->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <form action="DelStudent" method="post" name="CATDel{{$CF->id}} " id="CAT{{$CF->id}}">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="id" id="id" value="{{$CF->id}}">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="exampleModalLabel">Supprimer l'inscription N°{{$CF->id}}</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Voulez vous vraiment supprimer cet étudiant?</p>

                                                                <div class="alert alert-danger">
                                                                    <strong>Danger!</strong> Toutes les inscriptions pour cet étudiant seront supprimées.
                                                                </div>
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
                                {{ $AllEtudiant->links() }}

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>




    <!------------------------>


    </div>
@endsection
