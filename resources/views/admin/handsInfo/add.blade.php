@extends('layouts.template')

@section('addOrEditHand')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{isset($hand) ? 'Mise a Jour Les Informations Des Handicapées' : 'Ajouter Une Handicapée'}} </h1>
          </div>

        <div class="card shadow">
            <div class="card-body">
                <form method="POST" action="{{isset($hand) ? route('hands.update', $hand->id) : route('hands.store') }}">
                    @csrf
                    @if(isset($hand))
                        @method('PATCH')
                    @endif
                    <h4 class="text-danger font-weight-bold">Etat civile</h3>
                    <hr>
                    <div class="row mt-1">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">Nom & Prenom *</label>
                                <input type="text" class="form-control" required id="name" name="nameFr" placeholder="Nom & Prenom ..." value="{{isset($hand) ? $hand->nameFr : ''}}">
                              </div>
                         </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Date de Naissance *</label>
                                <input type="date" class="form-control" required id="" name="dob" placeholder="Date de naissance ..." value="{{ isset($hand) ? $hand->dob : '' }}">
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="lieuxNaiss" class="font-weight-bold">Lieu de Naissance *</label>
                                <input type="text" class="form-control " id="lieuxNaiss" name="lieuxNaissanceFr" placeholder="Lieu de naissance ..."  value="{{ isset($hand) ? $hand->lieuxNaissanceFr : '' }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">N° Acte Naissance *</label>
                                <input type="text" class="form-control" name="numeroactenaissance" id="" placeholder="N° Acte Naissance ..." value="{{isset($hand) ? $hand->numeroactenaissance : ''}}">
                              </div>
                         </div>
                       
                    </div>
                    <div class="row mt-1">
                        <div class="col text-left">
                            <label for="" class="font-weight-bold">Sex *</label>
                            <select name="sex" id="" class="form-control">
                                <option value="Homme" {{(isset($hand) && $hand->sex == 'H') ? 'selected' : ''}}>Homme</option>
                                <option value="Femme" {{(isset($hand) && $hand->sex == 'F') ? 'selected' : ''}}>Femme</option>
                            </select>

                        </div>
                              
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Prenom pere *</label>
                                <input type="text" class="form-control" name="prenomPereFr" id="" placeholder="Prenom pere ..." value="{{isset($hand) ? $hand->prenomPereFr : ''}}">
                              </div>
                         </div>
                        
                        <div class="col ">
                            <div class="form-group">
                                <label for="" class="font-weight-bold ">Nom mere *</label>
                                <input type="text" class="form-control " name="nomMereFr" id="" placeholder="Nom mere .." value="{{isset($hand) ? $hand->nomMereFr : ''}}">
                            </div>
                        </div>          
                        <div class="col ">
                            <div class="form-group">
                                <label for="" class="font-weight-bold ">Prenom Mere *</label>
                                <input type="text" class="form-control" name="prenomMereFr" id="" placeholder="Prenom Mere" value="{{isset($hand) ? $hand->prenomMereFr : ''}}">
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="row mt-1">
                         
                        
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">َAdresse *</label>
                                <input type="text" class="form-control" name="address" id="" placeholder="Adresse ..." value="{{isset($hand) ? $hand->address : ''}}">
                              </div>
                         </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Commune *</label>
                                <select name="commune" id="" class="form-control">
                                    <option value="" selected disabled>Choisi une Commune</option>
                                    @foreach ($communes as $commune)
                                        <option value="{{$commune->codeCommune}}" {{ isset($hand) && $hand->codeCommune  == $commune->codeCommune ? 'selected' : '' }}>{{$commune->nomCommuneFr}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col ">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Situation familiale *</label>
                                <select id="" class="form-control" name="situationFamilialeFr">
                                    <option value="" disabled>Choisi ...</option>
                                    <option value="celibataire" {{(isset($hand) && $hand->situationFamilialeFr == 'celibataire') ? 'selected' : ''}} >Célibataire</option>
                                    <option value="marie" {{(isset($hand) && $hand->situationFamilialeFr == 'marie') ? 'selected' : ''}}>Marie</option>
                                    <option value="divorce" {{(isset($hand) && $hand->situationFamilialeFr == 'divorce') ? 'selected' : ''}}>Divorcé</option>
                                    <option value="veuf" {{(isset($hand) && $hand->situationFamilialeFr == 'veuf') ? 'selected' : ''}}>Veuf(ve)</option>
                                </select>
                            </div>
                         </div>
                         <div class="col ">
                            <div class="form-group">
                                <label for="" class="font-weight-bold ">Nombre d'enfant *</label>
                            <input type="number" class="form-control" name="nbrenfant" id="" placeholder="Nombre d'enfant .." value="{{ isset($hand) ? $hand->nbrenfant : ''}}">
                            </div>
                        </div> 
                                
                    </div>    
                    <div class="row text-right mt-1">
                        <div class="col text-right">
                            <div class="form-group">
                                <label for="" class="font-weight-bold text-right">اللقب *</label>
                                <input type="text" class="form-control text-right"  id="" name="nomAr" placeholder="اللقب" value="{{ isset($hand) ? $hand->nomAr : '' }}">
                            </div>
                        </div>    
                        <div class="col text-right">
                            <div class="form-group">
                                <label for="" class="font-weight-bold text-right">الإسم *</label>
                                <input type="text" class="form-control text-right" name="prenomAr" id="" placeholder="الإسم" value="{{ isset($hand) ? $hand->prenomAr : '' }}">
                            </div>
                        </div>
                        
                        <div class="col ">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">إسم الإب *</label>
                                <input type="text" class="form-control text-right" name="prenomPereAr" id="" placeholder="إسم الإب ..." value="{{isset($hand) ? $hand->prenomPereAr : ''}}">
                              </div>
                         </div>
                        
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="font-weight-bold ">لقب الأم *</label>
                                <input type="text" class="form-control text-right" name="nomMereAr" id="" placeholder="لقب الأم .." value="{{ isset($hand) ? $hand->nomMereAr : '' }}">
                            </div>
                        </div>          
                        <div class="col text-right">
                            <div class="form-group">
                                <label for="" class="font-weight-bold ">إسم الأم *</label>
                                <input type="text" class="form-control text-right" name="prenomMereAr" id="" placeholder="إسم الأم ..." value="{{ isset($hand) ? $hand->prenomMereAr : '' }}">
                            </div>
                        </div>
                        
                    </div>             
                    <div class="row mt-1">
                        <div class="col-lg-4 text-right">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">مكان الميلاد *</label>
                                <input type="text" class="form-control text-right" name="lieuxNaissanceAr" id="" placeholder="مكان الميلاد ..." value="{{isset($hand) ? $hand->lieuxNaissanceAr : ''}}">
                              </div>
                         </div>
                        <div class="col text-right">
                            <div class="form-group">
                                <label for="" class="font-weight-bold text-right">العنوان بالعربية *</label>
                                <input type="text" class="form-control text-right"  name="addressAr" id="" placeholder="العنوان بالعربية" value="{{ isset($hand) ? $hand->addressAr : '' }}">
                            </div>
                        </div>  
                                 
                        
                        
                    </div>
                    <hr>
                    <h4 class="text-danger font-weight-bold">Carte d'Handicapée</h3>
                    <hr>
                    <div class="row mt-1">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">N° carte *</label>
                                <input type="number" class="form-control" id=""  name="numeroCart" placeholder="N° carte handicapée ..." value="{{isset($hand) ? $hand->cartehand->numeroCart : ''}}">
                              </div>
                         </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Nature d'handicapé *</label>
                                <input type="text" class="form-control" id=""  name="natureHandFr" placeholder="Nature handicapée ..." value="{{isset($hand) ? $hand->cartehand->natureHandFr : ''}}">
                            </div>
                        </div>
                        <div class="col-lg-3 text-right">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">طبيعة الإعاقة * </label>
                                <input type="text" class="form-control text-right"  id="" name="natureHandAr" placeholder="طبيعة الإعاقة ..." value="{{isset($hand) ? $hand->cartehand->natureHandAr : ''}}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="lieuxNaiss" class="font-weight-bold">Date Du Commission * </label>
                                <input type="date" class="form-control " id="lieuxNaiss"  name="dateCarte" placeholder="Date du commission ..." value="{{isset($hand) ? $hand->cartehand->dateCarte : ''}}">
                            </div>
                        </div>
                        <div class="col-lg-1 ">
                            <div class="form-group">
                                <label for="" class="font-weight-bold ">% *</label>
                                <input type="number" class="form-control" name="pourcentage" id=""  placeholder="%" value="{{isset($hand) ? $hand->cartehand->pourcentage : ''}}">
                            </div>
                        </div>   
                    </div>
                    <hr>
                    <h4 class="text-danger font-weight-bold">Carte D'identité Nationale</h3>
                    <hr>
                    <div class="row mt-1">
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">N° carte identité * </label>
                                <input type="number" class="form-control" id=""  name="NumeroNational" placeholder="N° carte Identité ..." value="{{isset($hand) ? $hand->cartenational->NumeroNational: ''}}">
                              </div>
                         </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Date Carte Identite * </label>
                                <input type="date" class="form-control" id=""  name="dateCarteIdentite" value="{{isset($hand) ? $hand->cartenational->dateCarteIdentite : ''}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Commune Carte Identite * </label>
                                <input type="text" class="form-control " id=""  name="communeCarteNationalFr" placeholder="Commune carte identité ..." value="{{isset($hand) ? $hand->cartenational->communeCarteNationalFr : ''}}">
                            </div>
                        </div>
                        <div class="col text-right">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">بلدية إصدار بطاقة * </label>
                                <input type="text" class="form-control text-right"  id="" name="communeCarteNationalAr" placeholder="بلدية إصدار بطاقة " value="{{isset($hand) ? $hand->cartenational->communeCarteNationalAr: ''}}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4 class="text-danger font-weight-bold">Securite sociale</h3>
                        <hr>
                        <div class="row mt-1">
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">N° Securite sociale *</label>
                                    <input type="number" class="form-control"  id="" name="NSS" placeholder="N° Securite Sociale ..." value="{{isset($hand) ? $hand->securitesociale->NSS : ''}}">
                                  </div>
                             </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Date d'assurance</label>
                                    <input type="date" class="form-control" id="" name="DateDebutAssurance" placeholder="Date Securite Sociale ..." value="{{isset($hand) ? $hand->securitesociale->DateDebutAssurance : ''}}">
                                </div>
                            </div>
                        </div>
                        <hr>
                    <h4 class="text-danger font-weight-bold">Informations Du Paiement</h3>
                    <hr>
                    <div class="row mt-1">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">CCP *</label>
                                <input type="text" class="form-control" required  id="" name="CCP" placeholder="CCP..." value="{{isset($hand) ? $hand->paieinformation->CCP : ''}}">
                              </div>
                         </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">RIP *</label>
                                <input type="text" class="form-control" required  id="" name="RIP" placeholder="RIP ..." value="{{isset($hand) ? $hand->paieinformation->RIP : ''}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Date Premier Pension</label>
                                <input type="date" class="form-control " id="" name="datePremierPension" placeholder="Date Premier Pension ..." value="{{isset($hand) ? $hand->paieinformation->datePremierPension : ''}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Date Decision du Paiement</label>
                                <input type="date" class="form-control " id="" name="dateDecisionPension" placeholder="Date Decision du Paiement ..." value="{{isset($hand) ? $hand->paieinformation->dateDecisionPension : ''}}">
                            </div>
                        </div>
                    </div>
                    @if (!isset($hand))
                    <h4 class="text-danger font-weight-bold">Etat Du paiement</h3>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Etat Du Paiement</label>
                                    <select name="statusPaiement" class="form-control" id="PaieStatusHand">
                                        <option value="En cours">En cours</option>
                                        <option value="En attente">En Attente</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-lg-4" id="raisonId" style="display: none">
                                    <div class="form-group">
                                        <label for="" class="font-weight-bold">Raison</label>
                                        <input type="text" class="form-control" id="" name="raisonEnAttente" value="">
                                    </div>
                                    </div>
                                    <div class="col" id="DateCommissionPensionId" style="display: none">
                                    <div class="form-group">
                                        <label for="" class="font-weight-bold">Date Comission Pension</label>
                                        <input type="date" class="form-control " id="" name="EnAttentedateComissionPension" placeholder="Date Premier Pension ..." value="{{isset($hand) ? $hand->paieinformation->datePremierPension : ''}}">
                                    </div>
                                </div>
                                
                        </div>
                    @endif
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Observation</label>
                                <textarea name="obs" id="" cols="30" rows="10" class="form-control">{{isset($hand) ? $hand->obs : ''}}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="{{isset($hand) ? 'Mettre a jours' : 'Ajouter'}}" class="btn btn-success">
                        </div>
                    </div>
                  </form>
            </div>
        </div>
    </div>
    
@endsection