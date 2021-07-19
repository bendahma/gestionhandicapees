@extends('layouts.template')

@section('statTables')
    <div class="container-fluid">
        <div class="card card-default shadow">
            <div class="card-header">
                <h4>1. Tableau des handicappées mondatés par sex</h4>
            </div>
            <div class="card-body">
                <table cellspacing="0"  class="table text-center  table-bordered">
                    <thead>
                        <tr class="h6">
                            <th id="cel" class="" >Homme</th>
                            <th id="cel" class="" >Femme</th>
                            <th id="cel" class="" ></th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        
                        <tr>
                            <td> {{$stats['mondateHomme']}} </td>
                            <td> {{$stats['mondateFemme']}} </td>
                            <td style="font-weight:bold; font-size:1.2rem "> {{$stats['mondateFemme'] + $stats['mondateHomme'] }} </td>
                            
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card card-default shadow">
            <div class="card-header">
                <h4>2. Tableau des handicappées mondatés par nature d'handicape</h4>
            </div>
            <div class="card-body">
                <table cellspacing="0"  class="table text-center  table-bordered">
                    <thead>
                        <tr class="h5">
                            <th id="cel" class="" colspan="2">MENTAL</th>
                            <th id="cel" class="" colspan="2">MOTEUR</th>
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
                        
                        <tr>
                            <td> {{$stats['mentalFemme']}} </td>
                            <td> {{$stats['mentalHomme']}} </td>
                            <td> {{$stats['moteurFemme']}} </td>
                            <td> {{$stats['moteurHomme']}} </td>
                            <td> {{$stats['polyFemme']}} </td>
                            <td> {{$stats['polyHomme']}} </td>
                            <td> {{$stats['reversion']}} </td>
                        </tr>
                        <tr>
                            <th colspan="2"> {{$stats['mentalFemme'] + $stats['mentalHomme']}} </th>
                            <th colspan="2"> {{$stats['moteurFemme'] + $stats['moteurHomme']}} </th>
                            <th colspan="2"> {{$stats['polyFemme'] + $stats['polyHomme']}} </th>
                            <th colspan="2"> {{$stats['reversion']}} </th>
                            <th class="h5"> {{$stats['mentalFemme'] + $stats['mentalHomme'] + $stats['moteurFemme'] + $stats['moteurHomme'] + $stats['polyFemme'] + $stats['polyHomme'] + $stats['reversion']}} </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="card card-default shadow">
            <div class="card-header">
                <h4>3. Statistique Des Mondatés Par Commune</h4>
            </div>
            <div class="card-body">
                <table cellspacing="0"  class="table text-center  table-bordered">
                    <thead>
                        <tr class="h5">
                            <th colspan="10">Nombre Des Mondatés</th>
                           
                        </tr>
                        <tr>
                            <th>Nature</th>
                            <th colspan="2">Mental</th>
                            <th colspan="2">Moteur</th>
                            <th colspan="2">Poly</th>
                            <th >Reversion</th>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <th>Sex</th>
                            <th>F</th>
                            <th>H</th>
                            <th>F</th>
                            <th>H</th>
                            <th>F</th>
                            <th>H</th>
                            <th>F</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr></tr>
                            @for ($i = 4601; $i <= 4628; $i++)
                                <tr>

                                        <td> {{$communes[$i - 4601]->nomCommuneFr}} </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td> {{$handsParCommune[$i]->count()}} </td>
                                </tr>
                            @endfor
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td> {{$nbrHands}} </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection