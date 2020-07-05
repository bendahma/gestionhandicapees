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
                    <input type="file" name="file" id="file" class="form-control" required>
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