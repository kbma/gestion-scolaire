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

        <form id="" action="{{route('SaveGroupe')}}" method="post">
            {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info ">
                    <div class="panel-heading"><strong>Groupe des formations</strong> <a style="float: right" href="{{ route('ShowGroupe') }}" title="Lister les societes" class="glyphicon glyphicon-align-justify"></a></div>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">CODE</button>
                                </span>
                                    <input onkeyup='this.value=this.value.toUpperCase()' autofocus  maxlength="10" style="text-transform:uppercase" tabindex="1" required id="CODE" name="CODE" type="text" class="form-control" placeholder="">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->



                        </div><!-- /.row -->
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Libelle</button>
                                </span>
                                    <input onkeyup='this.value=this.value.toUpperCase()' tabindex="2" style='text-transform:uppercase' required id="LIBELLE" name="LIBELLE" type="text" class="form-control" placeholder="">
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

                                    <input  tabindex="26" type="submit" class="btn btn-danger"  value="Ajouter ce groupe"/>

                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->



                                <div class="col-lg-6">
                                    <div class="input-group">

                                        <input tabindex="27" type="reset" class="btn btn-success"  value="Effacer la formulaire"/>

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
