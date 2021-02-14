@extends('layouts.template')

@section('uploadExcel')
    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                Upload Liste Des Handicapées
            </div>
            <div class="card-body">
                <form action="{{route('upload.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Hand info</label>
                        <input type="file" name="file" id="file" class="form-control mb-5" >
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">Beneficier</label>
                        <input type="file" name="paieinfofile" id="paieinfofile" class="form-control mb-5" >
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">Suspendu</label>
                        <input type="file" name="suspenduHandList" id="paieinfofile" class="form-control mb-5" >
                    </div>
                    
                    <hr>
                    <div class="row mt-3">
                        <div class="col-lg-2">
                            <input type="submit" value="Upload file" class="btn btn-success btn-block">
                        </div>
                        <div class="col-lg-2">
                            <input type="reset" value="Clean" class="btn btn-danger btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection


@section('uploadDossierAnnuel')
    <hr>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                Upload Liste Des Handicapées
            </div>
            <div class="card-body">
                <form action="{{route('renouvellement.renouvelleDossierFromFile')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="">Renouvelle Dossier Annuel</label>
                        <input type="file" name="dossierAnnuelRenouvelle" id="dossierAnnuelRenouvelle" class="form-control mb-5" >
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-2">
                            <input type="submit" value="Upload file" class="btn btn-success btn-block">
                        </div>
                        <div class="col-lg-2">
                            <input type="reset" value="Clean" class="btn btn-danger btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection

@section('rappelFaitList')
    <hr>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                Upload Liste Des Rappels Des Handicapées
            </div>
            <div class="card-body">
                <form action="{{route('rappel.rappelFait')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Liste Des Rappels Des Handicapées</label>
                        <input type="file" name="listRappelHand" id="" class="form-control mb-5" >
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-2">
                            <input type="submit" value="Upload file" class="btn btn-success btn-block">
                        </div>
                        <div class="col-lg-2">
                            <input type="reset" value="Clean" class="btn btn-danger btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection
@section('msnfcf')
    <hr>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                Platform Msnfcf
            </div>
            <div class="card-body">
                <form action="{{route('hands.msnfcf')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Msnfcf</label>
                        <input type="file" name="msnfcf" id="" class="form-control mb-5" >
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-2">
                            <input type="submit" value="Upload file" class="btn btn-success btn-block">
                        </div>
                        <div class="col-lg-2">
                            <input type="reset" value="Clean" class="btn btn-danger btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection