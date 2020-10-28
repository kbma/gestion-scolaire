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
        <!----------------------------------------------------diplome -------------------------------------->
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/home') }}">Accueil</a></li>
                        <li><a href="#">Formations</a></li>
                        <li class="active">Gerer les formations</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-primary ">
                        <div class="panel-heading"><strong>Formation : <span class="badge">{{ \App\Diplome::count() }} Formation(s)</span></strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <form action="SaveDiplome" method="post">
                                    {{ csrf_field() }}
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Code</button>
                                </span>
                                            <input autofocus maxlength="8" tabindex="1" onkeyup='this.value=this.value.toUpperCase()' required id="CODE" name="CODE" type="text" class="form-control" placeholder="">
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Libellé</button>
                                </span>
                                            <input maxlength="20" tabindex="2" onkeyup='this.value=this.value.toUpperCase()' required id="LIBELLE" name="LIBELLE" type="text" class="form-control" placeholder="">
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->
                                    <br><br>

                                    <div class="col-lg-10">
                                        <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Categorie</button>
                                </span>
                                            <select   maxlength="8" tabindex="3" onkeyup='this.value=this.value.toUpperCase()' required id="CATEGORIE" name="CATEGORIE"  class="form-control" >
                                                @foreach($CatForm as $C)
                                                    <option value="{{$C->id}}"> <strong>{{$C->CODE}} -> {{$C->LIBELLE}}</strong>   </option>
                                                @endforeach
                                            </select>
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <input type="submit" value="Ajouter" class="btn btn-primary"/>
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->

                                </form>
                            </div><!-- /.row -->
                            <br>

                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-responsive" >
                                        <tr>
                                            <th>Code</th>
                                            <th>Libellé</th>
                                            <th>CATEGORIE</th>

                                            <th  colspan="3">Actions</th>
                                        </tr>

                                        @foreach($AllDip as $Dip)
                                            <tr id="{{$Dip->id}}">

                                                <td> {{$Dip->CODE}}<d>
                                                <td>{{$Dip->LIBELLE}}</td>
                                                <td>{{ App\Categorie::find($Dip->CATEGORIE)->LIBELLE   }}</td>
                                                <td> {!! ($Dip->ACTIVE ==1) ? '<a href="'.route('DisableDiplome',$Dip->id).'"><span  class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>' : '<a href="'.route('EnableDiplome',$Dip->id).'"><span  class="glyphicon glyphicon-eye-close" aria-hidden="true"></span></a>' !!}</td>


                                                <td  data-toggle="modal" data-target="#ModalEdit{{$Dip->id}}" data-whatever="@mdo" ><span title="Modifier" class="glyphicon glyphicon-edit" aria-hidden="true"></span></td>
                                                <td  data-toggle="modal" data-target="#ModalDel{{$Dip->id}}" data-whatever="@mdo" ><span title="Supprimer" class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>


                                            </tr>
                                                <!----------->
                                                <div class="modal fade" id="ModalEdit{{$Dip->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <form action="UpdateDiplome" method="post" name="CAT{{$Dip->id}} " id="CAT{{$Dip->id}}">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="id" id="id" value="{{$Dip->id}}">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="exampleModalLabel">Modifier catégorie N°{{$Dip->id}}</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="control-label">CODE:</label>
                                                                        <input required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control" name="CODE" id="CODE" value="{{$Dip->CODE}}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">LIBELLE:</label>
                                                                        <input required style="text-transform: capitalize" type="text" class="form-control" name="LIBELLE" id="LIBELLE" value="{{$Dip->LIBELLE}}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">CATEGORIE:</label>
                                                                        <select   maxlength="8" tabindex="3" onkeyup='this.value=this.value.toUpperCase()' required id="CATEGORIE" name="CATEGORIE"  class="form-control" >
                                                                            @foreach($CatForm as $C)
                                                                                <option  value="{{$C->id}}"  {{{ ($Dip->CATEGORIE ===$C->id) ? "selected" : '' }}} > <strong>{{$C->CODE}} -> {{$C->LIBELLE}}</strong>   </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button  class="btn btn-default"  data-dismiss="modal">Fermer</button>
                                                                    <button  onclick="$('#CAT<?php echo $Dip->id; ?> ').submit()"  class="btn btn-primary">Enregistrer</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!----------->
                                                <!----------->
                                                <div class="modal fade" id="ModalDel{{$Dip->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <form action="DelDiplome" method="post" name="CATDel{{$Dip->id}} " id="CAT{{$Dip->id}}">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="id" id="id" value="{{$Dip->id}}">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="exampleModalLabel">Supprimer catégorie N°{{$Dip->id}}</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Voulez vous vraiment supprimer ce diplôme?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="reset" class="btn btn-default" value="Fermer" data-dismiss="modal">
                                                                    <input type="submit" onclick="$('#CATDel<?php echo $Dip->id; ?> ').submit()"  class="btn btn-danger" value="Supprimer"/>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!----------->

                                        @endforeach

                                    </table>
                                    {{ $AllDip->links() }}

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>










    </div>
@endsection
