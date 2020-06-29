@extends('layouts.template')

@section('List-Filtre')
    <div class="container-fluid">
        <h4 style="color:darkred; font-weight:700">Liste des Dandicapées Mondate</h4>
        <div class="card card-default">
            <div class="card-header">
                <h6>Choisi les Critères du sélection</h6>
            </div>
            <div class="card-body">
                <form action="{{route('listhands.FiltreListeHand')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="" style="color: black; font-weight:700">NATURE</label>
                        <div class="row">
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="all">
                                    <label class="form-check-label" for="moteur">
                                      All
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="moteur">
                                    <label class="form-check-label" for="moteur">
                                      Moteur
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="mental">
                                    <label class="form-check-label" for="mental">
                                      Mental
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="visuel">
                                    <label class="form-check-label" for="visuel">
                                      Visuel
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="col">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input"  value="" id="auditif">
                                        <label class="form-check-label" for="auditif">
                                          Auditif
                                        </label>
                                      </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="col">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input"  value="" id="poly">
                                        <label class="form-check-label" for="poly">
                                          Poly
                                        </label>
                                      </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="" style="color: black; font-weight:700">COMMUNE</label>
                        <div class="row">
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="allCommune" name="allCommune">
                                    <label class="form-check-label" for="allCommune">
                                      All
                                    </label>
                                  </div>
                            </div>
                            
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="Ain Temouchent" id="Ain Temouchent" name="communes[]">
                                    <label class="form-check-label" for="Ain Temouchent">
                                      Ain Temouchent
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="Sidi Ben Adda" id="Sidi Ben Adda" name="communes[]">
                                    <label class="form-check-label" for="Sidi Ben Adda">
                                      Sidi Ben Adda
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="El MALEH">
                                    <label class="form-check-label" for="El MALEH">
                                      El MALEH
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="CHAABAT">
                                    <label class="form-check-label" for="CHAABAT">
                                      CHAABAT
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="TERGA">
                                    <label class="form-check-label" for="TERGA">
                                      TERGA
                                    </label>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="OULED-KIHEL">
                                    <label class="form-check-label" for="OULED-KIHEL">
                                      OULED-KIHEL
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="EL AMRIA">
                                    <label class="form-check-label" for="EL AMRIA">
                                      EL AMRIA
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="H-EL-GHELA">
                                    <label class="form-check-label" for="H-EL-GHELA">
                                        H-EL-GHELA
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="O-BOUDJEMA">
                                    <label class="form-check-label" for="O-BOUDJEMA">
                                        O-BOUDJEMA
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="BOUZEDJAR">
                                    <label class="form-check-label" for="BOUZEDJAR">
                                        BOUZEDJAR
                                    </label>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="M'SAID" name="M'SAID">
                                    <label class="form-check-label" for="M'SAID">
                                      M'SAID
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="HBH" name="HBH">
                                    <label class="form-check-label" for="HBH">
                                      HBH
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="CHENTOUF" name="CHENTOUF">
                                    <label class="form-check-label" for="CHENTOUF">
                                        CHENTOUF
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="HASSASSNA" name="HASSASSNA">
                                    <label class="form-check-label" for="HASSASSNA">
                                        HASSASSNA
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="O-BEREKECHE" name="O-BEREKECHE">
                                    <label class="form-check-label" for="O-BEREKECHE">
                                        O-BEREKECHE
                                    </label>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="AIN LABAA" name="AIN LABAA">
                                    <label class="form-check-label" for="AIN LABAA">
                                      AIN LABAA
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="S-BOUMEDIENE" name="S-BOUMEDIENE">
                                    <label class="form-check-label" for="S-BOUMEDIENE">
                                      S-BOUMEDIENE
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="O-SEBBAH" name="O-SEBBAH">
                                    <label class="form-check-label" for="O-SEBBAH">
                                        O-SEBBAH
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="TEMEZOUGA" name="TEMEZOUGA">
                                    <label class="form-check-label" for="TEMEZOUGA">
                                        TEMEZOUGA
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="AIN KIHEL" name="AIN KIHEL">
                                    <label class="form-check-label" for="AIN KIHEL">
                                        AIN KIHEL
                                    </label>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="AIN TOLBA" name="AIN TOLBA">
                                    <label class="form-check-label" for="AIN TOLBA">
                                      AIN TOLBA
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="AGHLLAL" name="AGHLLAL">
                                    <label class="form-check-label" for="AGHLLAL">
                                      AGHLLAL
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="AOUGBELLIL" name="AOUGBELLIL">
                                    <label class="form-check-label" for="AOUGBELLIL">
                                        AOUGBELLIL
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="BENI SAF" name="BENI SAF">
                                    <label class="form-check-label" for="BENI SAF">
                                        BENI SAF
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="SIDI SAFI" name="SIDI SAFI">
                                    <label class="form-check-label" for="SIDI SAFI">
                                        SIDI SAFI
                                    </label>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="EMIR AEK" name="EMIR AEK">
                                    <label class="form-check-label" for="EMIR AEK">
                                      EMIR AEK
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="OULHACA" name="OULHACA">
                                    <label class="form-check-label" for="OULHACA">
                                      OULHACA
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="SIDI OURIACHE" name="SIDI OURIACHE">
                                    <label class="form-check-label" for="SIDI OURIACHE">
                                        SIDI OURIACHE
                                    </label>
                                  </div>
                            </div>
                            <div class="col"></div>
                            <div class="col"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="" style="color: black; font-weight:700">L'AGE</label>
                        <div class="row">
                            <div class="col" style="border-right:solid 1px black">
                                <label class="form-check-label" for="ageExacte">
                                    Exacte
                                  </label>
                                  <input type="number" name="ageExacte" id="ageExacte" class="form-control">
                            </div>
                            <div class="col" style="border-right:solid 1px black">
                                <label class="form-check-label" for="ageLess">
                                    Inférieur à
                                  </label>
                                  <input type="number" name="ageLess" id="ageLess" class="form-control">&nbsp &nbsp &nbsp
                                  <input type="checkbox" class="form-check-input"  value="" id="egalLess" name="egalLess">
                                    <label class="form-check-label" for="egalLess">
                                    Egale
                                    </label>
                            </div>
                            <div class="col" style="border-right:solid 1px black">
                                <label class="form-check-label" for="ageMore" >
                                    Supérieur à 
                                  </label>
                                  <input type="number" name="ageMore" id="ageMore" class="form-control" > &nbsp &nbsp &nbsp
                                  <input type="checkbox" class="form-check-input"  value="" id="egalMore" name="egalMore" >
                                    <label class="form-check-label" for="egalMore">
                                    Egale
                                    </label>
                            </div>
                            <div class="col" >
                                  <div class="row">
                                      <div class="col">
                                        <label class="form-check-label" for="ageMore">
                                            Entre
                                          </label>
                                        <input type="number" name="ageMore" id="ageMore" class="form-control"> 
                                      </div>
                                      <div class="col">
                                        <label class="form-check-label" for="ageMore">
                                            Entre
                                        </label>
                                        <input type="number" name="ageMore" id="ageMore" class="form-control"> 
                                      </div>
                                  </div>
                                  
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="" style="color: black; font-weight:700">SEX</label>
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="ALL" name="ALL">
                                    <label class="form-check-label" for="ALL">
                                      ALL
                                    </label>
                                  </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="HOMME" name="HOMME">
                                    <label class="form-check-label" for="HOMME">
                                      HOMME
                                    </label>
                                  </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="" id="FEMME" name="FEMME">
                                    <label class="form-check-label" for="FEMME">
                                      FEMME
                                    </label>
                                  </div>
                            </div>
                        </div>
                        
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="" style="color: black; font-weight:700">DATE DEBUT MONDATEMENT</label>
                        <input type="date" name="debutMondatement" id="" class="form-control col-lg-2">
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2">
                                <input type="submit" value="Télécharger Liste" class="btn btn-success btn-block">
                            </div>
                            <div class="col-lg-2">
                                <input type="reset" value="Vide les choix" class="btn btn-danger btn-block">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection