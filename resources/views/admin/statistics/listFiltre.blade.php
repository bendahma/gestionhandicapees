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
                                    <input type="checkbox" class="form-check-input"  value="allNature" id="Tous" name="natures[]">
                                    <label class="form-check-label" for="Tous">
                                      Tous
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="moteur"  name="natures[]" id="moteur">
                                    <label class="form-check-label" for="moteur">
                                      Moteur
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="mental" name="natures[]" id="mental">
                                    <label class="form-check-label" for="mental">
                                      Mental
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="visuel" id="visuel" name="natures[]">
                                    <label class="form-check-label" for="visuel">
                                      Visuel
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="col">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input"  value="auditif" id="auditif" name="natures[]">
                                        <label class="form-check-label" for="auditif">
                                          Auditif
                                        </label>
                                      </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="col">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input"  value="poly" id="poly" name="natures[]">
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
                                    <input type="checkbox" class="form-check-input"  value="allCommune" id="allCommune" name="communes[]">
                                    <label class="form-check-label" for="allCommune">
                                      Tous
                                    </label>
                                  </div>
                            </div>
                            
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="AIN TEMOUCHENT" id="Ain Temouchent" name="communes[]">
                                    <label class="form-check-label" for="Ain Temouchent">
                                      Ain Temouchent
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="SIDI BEN ADDA" id="Sidi Ben Adda" name="communes[]">
                                    <label class="form-check-label" for="Sidi Ben Adda">
                                      SIDI BEN ADDA
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="El MALEH" id="El MALEH" name="communes[]">
                                    <label class="form-check-label" for="El MALEH">
                                      El MALEH
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="CHAABAT" id="CHAABAT" name="communes[]">
                                    <label class="form-check-label" for="CHAABAT">
                                      CHAABAT
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="TERGA" id="TERGA" name="communes[]">
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
                                    <input type="checkbox" class="form-check-input"  value="OULED KIHEL" id="OULED-KIHEL" name="communes[]">
                                    <label class="form-check-label" for="OULED-KIHEL">
                                      OULED KIHEL
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="EL AMRIA" id="EL AMRIA" name="communes[]">
                                    <label class="form-check-label" for="EL AMRIA">
                                      EL AMRIA
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="HASSI EL GHELA" id="H-EL-GHELA" name="communes[]">
                                    <label class="form-check-label" for="H-EL-GHELA">
                                        H-EL-GHELA
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="OULED BOUDJEMA" id="O-BOUDJEMA" name="communes[]">
                                    <label class="form-check-label" for="O-BOUDJEMA">
                                        O-BOUDJEMA
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="BOUZEDJAR" id="BOUZEDJAR" name="communes[]">
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
                                    <input type="checkbox" class="form-check-input"  value="M'SAID" id="M'SAID" name="communes[]">
                                    <label class="form-check-label" for="M'SAID">
                                      M'SAID
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="HAMAM BOUHDJAR" id="HBH" name="communes[]">
                                    <label class="form-check-label" for="HBH">
                                      HBH
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="CHENTOUF" id="CHENTOUF" name="communes[]">
                                    <label class="form-check-label" for="CHENTOUF">
                                        CHENTOUF
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="HASSASSNA" id="HASSASSNA" name="communes[]">
                                    <label class="form-check-label" for="HASSASSNA">
                                        HASSASSNA
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="OUED BEREKECHE" id="O-BEREKECHE" name="communes[]">
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
                                    <input type="checkbox" class="form-check-input"  value="AIN EL ARBAA" id="AIN EL ARBAA" name="communes[]">
                                    <label class="form-check-label" for="AIN EL ARBAA">
                                      AIN EL ARBAA
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="SIDI BOUMEDIENE" id="S-BOUMEDIENE" name="communes[]">
                                    <label class="form-check-label" for="S-BOUMEDIENE">
                                      S-BOUMEDIENE
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="OUED SEBBAH" id="O-SEBBAH" name="communes[]">
                                    <label class="form-check-label" for="O-SEBBAH">
                                        O-SEBBAH
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="TEMEZOUGA" id="TEMEZOUGA" name="communes[]">
                                    <label class="form-check-label" for="TEMEZOUGA">
                                        TEMEZOUGA
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="AIN KIHAL" id="AIN KIHAL" name="communes[]">
                                    <label class="form-check-label" for="AIN KIHAL">
                                        AIN KIHAL
                                    </label>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="AIN TOLBA" id="AIN TOLBA" name="communes[]">
                                    <label class="form-check-label" for="AIN TOLBA">
                                      AIN TOLBA
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="AGHLLAL" id="AGHLLAL" name="communes[]">
                                    <label class="form-check-label" for="AGHLLAL">
                                      AGHLLAL
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="AOUGBELLIL" id="AOUGBELLIL" name="communes[]">
                                    <label class="form-check-label" for="AOUGBELLIL">
                                        AOUGBELLIL
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="BENI SAF" id="BENI SAF" name="communes[]">
                                    <label class="form-check-label" for="BENI SAF">
                                        BENI SAF
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="SIDI SAFI" id="SIDI SAFI" name="communes[]">
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
                                    <input type="checkbox" class="form-check-input"  value="EMIR ABDELKADER" id="EMIR AEK" name="communes[]">
                                    <label class="form-check-label" for="EMIR AEK">
                                      EMIR AEK
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="OULHACA" id="OULHACA" name="communes[]">
                                    <label class="form-check-label" for="OULHACA">
                                      OULHACA
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="SIDI OURIACHE" id="SIDI OURIACHE" name="communes[]">
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
                            <div class="col" style="">
                                <label class="form-check-label" for="ageExacte">
                                    Exacte
                                  </label>
                                  <input type="number" name="ageExacte" id="ageExacte" class="form-control">
                            </div>
                            <div class="col" style="">
                                <label class="form-check-label" for="ageLess">
                                    Inférieur à
                                  </label>
                                  <input type="number" name="ageLess" id="ageLess" class="form-control">&nbsp &nbsp &nbsp
                                  <input type="checkbox" class="form-check-input"  value="egalLessEqual" id="egalLess" name="ageEqual[]">
                                    <label class="form-check-label" for="egalLess">
                                    Equal
                                    </label>
                            </div>
                            <div class="col" style="">
                                <label class="form-check-label" for="ageMore" >
                                    Supérieur à 
                                  </label>
                                  <input type="number" name="ageMore" id="ageMore" class="form-control" > &nbsp &nbsp &nbsp
                                  <input type="checkbox" class="form-check-input"  value="egalMoreEqual" id="egalMore" name="ageEqual[]" >
                                    <label class="form-check-label" for="egalMore">
                                    Equal
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
                                    <input type="checkbox" class="form-check-input"  value="" id="Tous" name="sexs">
                                    <label class="form-check-label" for="Tous">
                                      Tous
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