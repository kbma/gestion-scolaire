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
                        <li><a href="#">Payement</a></li>
                        <li class="active">Liser les payements</li>
                    </ol>
                </div>
            </div>

        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-info ">
                    <div class="panel-heading"><strong>Liste des payements:</strong> <span class="badge">{{ \App\Payement::count() }} payement(s)</span></div>

                    <div class="alert alert-danger">
                        <strong>Danger!</strong> La modification n'est pas finis.
                    </div>


                    <div class="panel-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-striped table-responsive" >
                                    <tr>

                                        <th  >NUMERO</th>
                                        <th  >Date</th>
                                        <th  >Bénificière</th>
                                        <th  >MOTIF</th>
                                        <th  >Montant recette</th>
                                        <th  >Montant dépence</th>
                                        <th  >MODE</th>


                                        <th colspan="4">Actions</th>
                                    </tr>
                                    @foreach($AllPayements as $CF)
                                    <tr id="{{$CF->id}}">



                                        <td style="width: 20%" >{{$CF->NUMERO}}</td>
                                        <td><?php  echo date('d/m/Y', strtotime($CF->DATE_OPERATION)); ?> </td>
                                        <td style="width: 20%" >
                                            @if ($CF->ETUDIANT!='0')
                                               {{App\Etudiant::find($CF->ETUDIANT)->NOM_ETUDIANT}}
                                            @elseif ($CF->PRESTATAIRE!='0')
                                                {{App\prestataire::find($CF->PRESTATAIRE)->NOM}}
                                            @else
                                               {{App\Company::find($CF->ENTREPRISE)->NOM}}
                                            @endif
                                             </td>
                                        <td style="width: 20%" >
                                            @if ($CF->MOTIF_RECETTE!='')
                                                {{$CF->MOTIF_RECETTE}}

                                            @else
                                                {{$CF->MOTIF_DEPENCE}}
                                            @endif
                                        </td>
                                        <td style="width: 20%" >

                                            @if ($CF->MONTANT_RECETTE!='')
                                                {{$CF->MONTANT_RECETTE}}
                                            @endif
                                        </td>
                                        <td style="width: 20%" >

                                            @if ($CF->MONTANT_DEPENCE!='')
                                                {{$CF->MONTANT_DEPENCE}}
                                            @endif
                                        </td>
                                        <td> @if ($CF->MODE==1)
                                                CAISSE
                                                 @else
                                                 BANQUE
                                            @endif
                                        </td>


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
                                                            <h4 class="modal-title" id="exampleModalLabel">Détails de la payement  N°{{$CF->id}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row {{ $CF->ENTREPRISE !=0 ? '' : 'hidden' }} " >
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="control-label">Societe:</label>
                                                                        <input disabled required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control" value="{{ $CF->ENTREPRISE !=0 ? App\Company::find($CF->ENTREPRISE)->NOM : 'AUCUNE' }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="control-label">Session:</label>
                                                                        <input disabled required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control"  value="{{ $CF->ENTREPRISE_SESSION !=0 ? App\Session::find($CF->ENTREPRISE_SESSION)->LIBELLE : 'AUCUNE' }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="control-label">Formation:</label>
                                                                        <input disabled required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control"  value="{{ $CF->ENTREPRISE_FORMATION !=0 ? App\Diplome::find($CF->ENTREPRISE_FORMATION)->LIBELLE : 'AUCUNE' }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row {{ $CF->ETUDIANT !=0 ? '' : 'hidden' }} " >
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="control-label">Etudiant:</label>
                                                                        <input disabled required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control" value="{{ $CF->ETUDIANT !=0 ? App\Etudiant::find($CF->ETUDIANT)->NOM_ETUDIANT.' '.App\Etudiant::find($CF->ETUDIANT)->PRENOM_ETUDIANT : 'AUCUNE' }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="control-label">Session:</label>
                                                                        <input disabled required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control"  value="{{ $CF->ETUDIANT_SESSION !=0 ? App\Session::find($CF->ETUDIANT_SESSION)->LIBELLE : 'AUCUNE' }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="control-label">Formation:</label>
                                                                        <input disabled required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control"  value="{{ $CF->ETUDIANT_FORMATION !=0 ? App\Diplome::find($CF->ETUDIANT_FORMATION)->LIBELLE : 'AUCUNE' }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row {{ $CF->PRESTATAIRE !=0 ? '' : 'hidden' }} " >
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="control-label">Préstataire:</label>
                                                                        <input disabled required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control" value="{{ $CF->PRESTATAIRE !=0 ? App\prestataire::find($CF->PRESTATAIRE)->NOM: 'AUCUNE' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="control-label">Categorie:</label>

                                                                        <input disabled required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control" value="{{ $CF->PRESTATAIRE !=0 ? App\CatPres::find( App\prestataire::find($CF->PRESTATAIRE)->CATEGORIE)->LIBELLE : 'AUCUNE' }}">
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
                                                <form action="UpdatePayement" method="post" name="CAT{{$CF->id}} " id="CAT{{$CF->id}}">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="id" id="id" value="{{$CF->id}}">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="exampleModalLabel">Modifier de payement N°{{$CF->id}}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="modal-body">
                                                            <div class="row {{ $CF->ENTREPRISE !=0 ? '' : 'hidden' }} " >
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="control-label">Societe:</label>
                                                                        <input disabled required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control" value="{{ $CF->ENTREPRISE !=0 ? App\Company::find($CF->ENTREPRISE)->NOM : 'AUCUNE' }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="control-label">Session:</label>
                                                                        <input disabled required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control"  value="{{ $CF->ENTREPRISE_SESSION !=0 ? App\Session::find($CF->ENTREPRISE_SESSION)->LIBELLE : 'AUCUNE' }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="control-label">Formation:</label>
                                                                        <input disabled required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control"  value="{{ $CF->ENTREPRISE_FORMATION !=0 ? App\Diplome::find($CF->ENTREPRISE_FORMATION)->LIBELLE : 'AUCUNE' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label for="message-text" class="control-label">Societe:</label>
                                                                    <select tabindex="21"style='text-transform:uppercase' id="SOCIETE" name="SOCIETE" type="text" class="form-control">

                                                                        <option value="0">AUCUNE</option>
                                                                        @foreach($AllCompany as $S)
                                                                            <option  value="{{$S->id}}"  {{ ($CF->ENTREPRISE ===$S->id) ? "selected" : '' }} > <strong>{{$S->NOM}}</strong>   </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                </div>

                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">FORMATION:</label>
                                                                        <select tabindex="21"style='text-transform:uppercase' id="DIPLOME" name="DIPLOME" type="text" class="form-control">

                                                                            <option value="0">AUCUNE</option>
                                                                            @foreach($AllDip as $S)
                                                                                <option  value="{{$S->id}}"  {{ ($CF->ENTREPRISE_FORMATION ===$S->id) ? "selected" : '' }} > <strong>{{$S->LIBELLE}}</strong>   </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>


                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">SESSION:</label>
                                                                        <select tabindex="21"style='text-transform:uppercase' id="SESSION" name="SESSION" type="text" class="form-control">
                                                                            @foreach($AllSession as $S)
                                                                                <option  value="{{$S->id}}"  {{ ($CF->ENTREPRISE_SESSION ===$S->id) ? "selected" : '' }} > <strong>{{$S->LIBELLE}}</strong>   </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>



                                                            </div>

                                                            <div class="row {{ $CF->ETUDIANT !=0 ? '' : 'hidden' }} " >
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="control-label">Etudiant:</label>
                                                                        <input disabled required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control" value="{{ $CF->ETUDIANT !=0 ? App\Etudiant::find($CF->ETUDIANT)->NOM_ETUDIANT.' '.App\Etudiant::find($CF->ETUDIANT)->PRENOM_ETUDIANT : 'AUCUNE' }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">FORMATION:</label>
                                                                        <select tabindex="21"style='text-transform:uppercase' id="DIPLOME" name="DIPLOME" type="text" class="form-control">
                                                                            <option value="0">AUCUNE</option>
                                                                            @foreach($AllDip as $S)
                                                                                <option  value="{{$S->id}}"  {{ ($CF->ETUDIANT_FORMATION ===$S->id) ? "selected" : '' }} > <strong>{{$S->LIBELLE}}</strong>   </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">SESSION:</label>
                                                                        <select tabindex="21"style='text-transform:uppercase' id="SESSION" name="SESSION" type="text" class="form-control">
                                                                            @foreach($AllSession as $S)
                                                                                <option  value="{{$S->id}}"  {{ ($CF->ETUDIANT_SESSION ===$S->id) ? "selected" : '' }} > <strong>{{$S->LIBELLE}}</strong>   </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row {{ $CF->PRESTATAIRE !=0 ? '' : 'hidden' }} " >
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="control-label">Préstataire:</label>
                                                                        <input disabled required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control" value="{{ $CF->PRESTATAIRE !=0 ? App\prestataire::find($CF->PRESTATAIRE)->NOM: 'AUCUNE' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="control-label">Categorie:</label>

                                                                        <input disabled required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control" value="{{ $CF->PRESTATAIRE !=0 ? App\CatPres::find( App\prestataire::find($CF->PRESTATAIRE)->CATEGORIE)->LIBELLE : 'AUCUNE' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row {{ $CF->TYPE ==1 ? '' : 'hidden' }} " >
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="control-label">Motif récette:</label>
                                                                        <input  required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control" value="{{ $CF->TYPE ==1 ? $CF->MOTIF_RECETTE : '' }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">Montant:</label>
                                                                        <input  required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control" value="{{ $CF->TYPE ==1 ? $CF->MONTANT_RECETTE : '' }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row {{ $CF->TYPE ==2 ? '' : 'hidden' }} " >
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="control-label">Motif dépence</label>
                                                                        <input  required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control" value="{{ $CF->TYPE ==2 ? $CF->MOTIF_DEPENCE : '' }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">Montant:</label>
                                                                        <input  required onkeyup='this.value=this.value.toUpperCase()' type="text" class="form-control" value="{{ $CF->TYPE ==2 ? $CF->MONTANT_DEPENCE : '' }}">
                                                                    </div>
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
                                        <!----------->
                                        <div class="modal fade" id="ModalDel{{$CF->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <form action="DelPayement" method="post" name="CATDel{{$CF->id}} " id="CAT{{$CF->id}}">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="id" id="id" value="{{$CF->id}}">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Supprimer l'inscription N°{{$CF->id}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Voulez vous vraiment supprimer cette ligne de paiement?</p>
                                                            @if($CF->REGISTER !=0)
                                                                <p>Operation numéro: {{$CF->id}} </p>
                                                                <input type="text" name="id" id="id" value="{{$CF->id}}">
                                                                <p>Le reste à payer sera devenu {{App\Register::find($CF->REGISTER)->RESTE}} </p>
                                                                <input type="text" name="MONTANT_RESTE" id="MONTANT_RESTE" value="{{App\Register::find($CF->REGISTER)->RESTE}}">
                                                                @endif

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
                                {{ $AllPayements->links() }}

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

            <div class="row">
                <div class="col-lg-6">

                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Total caisse</strong></h3>
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    @if (session('TOTAL_CAISSE_RECETTE'))
                                        <div class="alert alert-success">
                                            {{ session('TOTAL_CAISSE_RECETTE') }}
                                        </div>
                                    @endif

                                    <span class="badge">  {{ number_format($TOTAL_CAISSE_RECETTE, 3, ',', ' ') }} DT</span>
                                    Recettes
                                </li>
                                <li class="list-group-item">
                                    <span class="badge">  {{ number_format($TOTAL_CAISSE_DEPENCE, 3, ',', ' ') }} DT</span>
                                    Dépences
                                </li>
                                <li class="list-group-item">
                                    <span class="badge"> {{ number_format($TOTAL_CAISSE_RECETTE - $TOTAL_CAISSE_DEPENCE, 3, ',', ' ') }} DT</span>
                                    Solde caisse
                                </li>
                            </ul>
                        </div>
                    </div>

                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6">

                    <div class="panel panel-success">
                        <div class="panel-heading"><strong>Total Banques</strong></div>
                        <div class="panel-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    @if (session('TOTAL_BANQUE_RECETTE'))
                                        <div class="alert alert-success">
                                            {{ session('TOTAL_BANQUE_RECETTE') }}
                                        </div>
                                    @endif

                                    <span class="badge">  {{ number_format($TOTAL_BANQUE_RECETTE, 3, ',', ' ') }} DT</span>
                                    Recettes
                                </li>
                                <li class="list-group-item">
                                    <span class="badge">  {{ number_format($TOTAL_BANQUE_DEPENCE, 3, ',', ' ') }} DT</span>
                                    Dépences
                                </li>
                                <li class="list-group-item">
                                    <span class="badge"> {{ number_format($TOTAL_BANQUE_RECETTE - $TOTAL_BANQUE_DEPENCE, 3, ',', ' ') }} DT</span>
                                    Solde banque
                                </li>
                            </ul>
                        </div>
                    </div>



                </div><!-- /.col-lg-6 -->

            </div>

    </div>
@endsection
