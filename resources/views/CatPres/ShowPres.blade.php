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
                        <li><a href="#">Prestataires</a></li>
                        <li class="active">Liser les prestataire</li>
                    </ol>
                </div>
            </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info ">
                    <div class="panel-heading"><strong>Liste des préstataires:</strong> <span class="badge">{{ \App\prestataire::count() }} préstataire(s)</span> <a style="float: right" href="{{ route('AddPres') }}" title="Ajouter un nouveau préstataire" class="glyphicon glyphicon-plus-sign"></a> </div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-striped table-responsive" >
                                    <tr>
                                        <th>Code</th>
                                        <th>Catégorie</th>
                                        <th>NOM</th>
                                        <th>Tél</th>
                                        <th>Adresse</th>
                                        <th>Ville</th>
                                        <th colspan="4">Actions</th>
                                    </tr>
                                    @foreach($AllPres as $CF)
                                    <tr id="{{$CF->id}}">
                                        <td> {{$CF->CODE}}<d>
                                        <td>{{ App\CatPres::find($CF->CATEGORIE)->LIBELLE   }} </td>
                                        <td>{{$CF->NOM}}</td>
                                        <td>{{$CF->TEL}}</td>
                                        <td>{{$CF->ADRESSE}}</td>
                                        <td>{{$CF->VILLE}}</td>

                                        <td> {!! ($CF->ACTIVE ==1) ? '<a href="'.route('DisablePrestataire',$CF->id).'"><span  class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>' : '<a href="'.route('EnablePrestataire',$CF->id).'"><span  class="glyphicon glyphicon-eye-close" aria-hidden="true"></span></a>' !!}</td>

                                        <td  data-toggle="modal" data-target="#ModalDetails{{$CF->id}}" data-whatever="@mdo" ><span title="Détails" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></td>
                                        <td  data-toggle="modal" data-target="#ModalEdit{{$CF->id}}" data-whatever="@mdo" ><span title="Modifier" class="glyphicon glyphicon-edit" aria-hidden="true"></span></td>
                                        <td  data-toggle="modal" data-target="#ModalDel{{$CF->id}}" data-whatever="@mdo" ><span title="Supprimer" class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>


                                        <!----------->
                                        <div class="modal fade" id="ModalDetails{{$CF->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                            <div class="modal-dialog" role="document">

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Détails du préstataire  N°{{$CF->id}}</h4>
                                                        </div>
                                                        <div class="modal-body">


                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">CP:</label>
                                                                <input disabled required style="text-transform: capitalize" type="text" class="form-control"  value="{{$CF->CP}}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">Email:</label>
                                                                <input disabled required style="text-transform: capitalize" type="text" class="form-control" name="EMAIL" id="EMAIL" value="{{$CF->EMAIL}}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">Observation:</label>
                                                                <input disabled required style="text-transform: capitalize" type="text" class="form-control" name="OBSERVATION" id="OBSERVATION" value="{{$CF->OBSERVATION}}">
                                                            </div>
                                                        </div>

                                                    </div>

                                            </div>
                                        </div>
                                        <!----------->
                                        <div class="modal fade" id="ModalEdit{{$CF->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <form action="UpdatePres" method="post" name="CAT{{$CF->id}} " id="CAT{{$CF->id}}">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="id" id="id" value="{{$CF->id}}">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="exampleModalLabel">Modifier prestataire N°{{$CF->id}}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="control-label">CODE:</label>
                                                                <input required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control" name="CODE" id="CODE" value="{{$CF->CODE}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">NOM:</label>
                                                                <input required style="text-transform: capitalize" type="text" class="form-control" name="NOM" id="NOM" value="{{$CF->NOM}}">
                                                            </div>

                                                        <div class="form-group">
                                                            <label for="message-text" class="control-label">CATEGORIE:</label>
                                                            <select   maxlength="8" tabindex="3" onkeyup='this.value=this.value.toUpperCase()' required id="CATEGORIE" name="CATEGORIE"  class="form-control" >
                                                                @foreach($AllCatPres as $C)
                                                                    <option  value="{{$C->id}}"  {{ ($CF->CATEGORIE ===$C->id) ? "selected" : '' }} > <strong>{{$C->CODE}} -> {{$C->LIBELLE}}</strong>   </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="message-text" class="control-label">ADRESSE:</label>
                                                            <input required style="text-transform: capitalize" type="text" class="form-control" name="ADRESSE" id="ADRESSE" value="{{$CF->ADRESSE}}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="message-text" class="control-label">VILLE:</label>
                                                            <input required style="text-transform: capitalize" type="text" class="form-control" name="VILLE" id="VILLE" value="{{$CF->VILLE}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text" class="control-label">CP:</label>
                                                            <input required style="text-transform: capitalize" type="text" class="form-control" name="CP" id="CP" value="{{$CF->CP}}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="message-text" class="control-label">TEL:</label>
                                                            <input required style="text-transform: capitalize" type="text" class="form-control" name="TEL" id="TEL" value="{{$CF->TEL}}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="message-text" class="control-label">EMAIL:</label>
                                                            <input required style="text-transform: capitalize" type="text" class="form-control" name="EMAIL" id="EMAIL" value="{{$CF->EMAIL}}">
                                                        </div>



                                                        <div class="form-group">
                                                            <label for="message-text" class="control-label">Observation:</label>
                                                            <input required style="text-transform: capitalize" type="text" class="form-control" name="OBSERVATION" id="OBSERVATION" value="{{$CF->OBSERVATION}}">
                                                        </div>

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
                                                <form action="DelPres" method="post" name="CATDel{{$CF->id}} " id="CAT{{$CF->id}}">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="id" id="id" value="{{$CF->id}}">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Supprimer catégorie N°{{$CF->id}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Voulez vous vraiment supprimer ce prestataire?</p>



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
                                {{ $AllPres->links() }}

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
