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
                        <li><a href="#">Paramétres</a></li>
                        <li class="active">Liser les modes de formation</li>
                    </ol>
                </div>
            </div>


        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info ">
                    <div class="panel-heading"><strong>Liste des modes de formation:</strong> <span class="badge">{{ \App\ModeForma::count() }} Mode(s) de formation</span> <a style="float: right" href="{{ route('AddModeForma') }}" title="Ajouter une nouvelle societe" class="glyphicon glyphicon-plus-sign"></a> </div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-striped table-responsive" >
                                    <tr>
                                        <th>Code</th>
                                        <th>LIBELLE</th>
                                        <th>Etat</th>
                                        <th colspan="3">Actions</th>
                                    </tr>
                                    @foreach($AllModeForma as $CF)
                                    <tr id="{{$CF->id}}">
                                        <td> {{$CF->CODE}}<d>
                                        <td>{{$CF->LIBELLE}}</td>
                                        <td> {!! ($CF->ACTIVE ==1) ? '<a href="'.route('DisableModeForma',$CF->id).'"><span  class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>' : '<a href="'.route('EnableModeForma',$CF->id).'"><span  class="glyphicon glyphicon-eye-close" aria-hidden="true"></span></a>' !!}</td>

                                        <td  data-toggle="modal" data-target="#ModalEdit{{$CF->id}}" data-whatever="@mdo" ><button class="btn btn-success btn-sm">Modifier</button></td>
                                        <td  data-toggle="modal" data-target="#ModalDel{{$CF->id}}" data-whatever="@mdo" ><button class="btn btn-danger btn-sm">Supprimer</button></td>


                                        <!----------->
                                        <div class="modal fade" id="ModalEdit{{$CF->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <form action="UpdateModeForma" method="post" name="CAT{{$CF->id}} " id="CAT{{$CF->id}}">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="id" id="id" value="{{$CF->id}}">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="exampleModalLabel">Modifier societe N°{{$CF->id}}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="control-label">CODE:</label>
                                                                <input required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control" name="CODE" id="CODE" value="{{$CF->CODE}}">
                                                            </div>

                                                        <div class="form-group">
                                                            <label for="message-text" class="control-label">LIBELLE:</label>
                                                            <input required style="text-transform:uppercase" type="text" class="form-control" name="LIBELLE" id="LIBELLE" value="{{$CF->LIBELLE}}">
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
                                                <form action="DelModeForma" method="post" name="CATDel{{$CF->id}} " id="CAT{{$CF->id}}">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="id" id="id" value="{{$CF->id}}">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Supprimer societe N°{{$CF->id}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Voulez vous vraiment supprimer cette mode de formation?</p>

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
                                {{ $AllModeForma->links() }}

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
