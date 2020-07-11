<?php

Auth::routes(['register' => false]);

Route::get('/', "MainController@index")->name('index');

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', "MainController@dashboard")->name('dashboard');
    Route::post('/mois', "MainController@store")->name('mois');

    Route::get('/hand/suspendu/{hand}', "MainController@suspendu")->name('hand.suspendu');

    Route::post('/hands/restore/{hand}', "HandsInfoController@restore")->name('hands.restore');
    Route::resource('/hands' , 'HandsInfoController');

    Route::resource('/upload' , 'UploadHandInfoController');

    Route::get('/ListHands/Arrete', "listHandController@arrete")->name('listhands.arrete');
    Route::get('/ListHands/EnCours', "listHandController@encours")->name('listhands.encours');
    Route::get('/ListHands/EnAttente', "listHandController@enAttente")->name('listhands.enattente');
    Route::get('/ListHands/Filtre', "listHandController@Filtre")->name('listhands.filtre');
    Route::post('/ListHands/FiltreListeHand', "listHandController@FiltreListeHand")->name('listhands.FiltreListeHand');
    
    Route::get('/paie/export' , 'PaieMensuelleController@export')->name('paie.export');
    Route::get('/paie/Cnas/{papier}' , 'PaieMensuelleController@Cnas')->name('paie.Cnas');
    Route::get('/paie/decision' , 'PaieMensuelleController@decision')->name('paie.decision');
    Route::get('/paie/Journal' , 'PaieMensuelleController@Journal')->name('paie.Journal');
    Route::get('/paie/BordereauCf' , 'PaieMensuelleController@BordereauCf')->name('paie.BordereauCf');
    Route::get('/paie/BordereauCD' , 'PaieMensuelleController@BordereauCD')->name('paie.BordereauCD');
    Route::get('/paie/repartition' , 'PaieMensuelleController@Repartition')->name('paie.repartition');
    Route::get('/paie/engagement/{papier}' , 'PaieMensuelleController@Engagement')->name('paie.engagement');
    Route::get('/paie/mondate/{papier}' , 'PaieMensuelleController@Mondate')->name('paie.mondate');
    Route::get('/paie' , 'PaieMensuelleController@index')->name('paie.index');
    Route::get('/paie/traitement' , 'PaieMensuelleController@MakePaie')->name('paie.traitement');
    Route::get('/paie/documents' , 'PaieMensuelleController@DocumentsPaie')->name('paie.documents');

    Route::patch('/budget/updateBudgetSupplimentaire', 'BudgetController@BudgetSupplimenatire')->name('budget.updateBudgetSupplimentaire');
    Route::get('/budget/DownloadBudgetConsomptionPaie' , 'BudgetController@DownloadBudgetConsomptionPaie')->name('budget.DownloadBudgetConsomptionPaie'); 
    Route::get('/budget/DownloadBudgetConsomptionCnas' , 'BudgetController@DownloadBudgetConsomptionCnas')->name('budget.DownloadBudgetConsomptionCnas'); 
    Route::get('/budget/Desengagement' , 'BudgetController@getDesengagemengt')->name('budget.getDesengagemengt'); 
    Route::patch('/budget/DesengagementBudget' , 'BudgetController@DesengagementBudget')->name('budget.DesengagementBudget'); 
    
    Route::resource('/budget' , 'BudgetController');

    Route::get('/rappel/export' , 'RappelController@export')->name('rappel.export');
    Route::get('/rappel/list' , 'RappelController@listePaiementRappel')->name('rappel.list');
    Route::get('/rappel/add' , 'RappelController@Add')->name('rappel.add');
    Route::post('/rappel/Saisie' , 'RappelController@Saisie')->name('rappel.Saisie');
    Route::get('/rappel/{rappel}/{hand}' , 'RappelController@findInfo')->name('rappel.findInfo');
    Route::patch('/rappel/confirm/{rappel}' , 'RappelController@ConfirmRappel')->name('rappel.confirm');
    Route::resource('/rappel' , 'RappelController');

    Route::get('/attestation/{listType}', 'AttestationController@index')->name('attestation');
    Route::get('/attestation/telecharger/{hand}/{papier}', 'AttestationController@Download')->name('attestation.telecharger');
    
    Route::get('/decision/{listType}', 'DecisionController@index')->name('decision');
    Route::get('/decision/telecharger/{hand}/{papier}', 'DecisionController@Download')->name('decision.telecharger');
    
    Route::get('/historique', 'HistoryPaiementController@index')->name('historique.index');
    Route::get('/historique/paiement/{hand}', 'HistoryPaiementController@MoisPaiements')->name('historique.MoisPaiements');
    Route::get('/historique/histoire/{hand}', 'HistoryPaiementController@HistoireSuspension')->name('historique.HistoireSuspension');
    
    Route::patch('/renouvellement/DossierRemi/{hand}', 'RenouvelementDossierController@DossierRemi')->name('renouvellement.DossierRemi');
    Route::get('/renouvellement/statistique', 'RenouvelementDossierController@Statistique')->name('renouvellement.statistique');
    Route::get('/renouvellement/Init', 'RenouvelementDossierController@Init')->name('renouvellement.intia');
    Route::resource('/renouvellement', 'RenouvelementDossierController');
    
    Route::post('/monthlyStatistics', 'StaticticsController@StatistiqueMensuelle');
    
    Route::get('/cds','CdController@index')->name('cds.index');
    Route::post('/cds/CdClassique','CdController@CdClassique')->name('cds.CdClassique');
    Route::post('/cds/CdMondatement','CdController@CdMondatement')->name('cds.CdMondatement');
    Route::post('/cds/CdBeneficier','CdController@CdBeneficier')->name('cds.CdBeneficier');

    Route::get('/download/exportHandsMondate','listHandController@exportHandsMondate')->name('hands.exportHandsMondate');
    Route::get('/download/exportHandsSuspendu','listHandController@exportHandsSuspendu')->name('hands.exportHandsSuspendu');
    Route::post('/download/suspensionHandRange','listHandController@suspensionHandRange')->name('hands.suspensionHandRange');

});


