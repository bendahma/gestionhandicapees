@extends('layouts.template')

@section('statTables')
    <div class="container-fluid">
        <div class="card card-default shadow">
            <div class="card-header">
                <h4>Statistique Par Nature</h4>
            </div>
            <div class="card-body">
                <table cellspacing="0"  class="table">
                    <thead>
                        <tr>
                            <th id="rmc" class="" colspan="2">Montan</th>
                            <th id="cel" class="" colspan="2">Moteur</th>
                            <th id="cel" class="" colspan="2">POLY</th>
                            <th id="cel" class="">Reversion</th>
                        </tr>
                        <tr>
                                <th >F</th>
                                <th >H</th>
                                <th >F</th>
                                <th >H</th>
                                <th >F</th>
                                <th >H</th>
                                <th >F</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

@endsection