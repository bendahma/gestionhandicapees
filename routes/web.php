<?php

use App\Budget;


Route::get('/checkBudget', function(){
    $budget = new Budget();
    $consommationBudget = $budget->BudgetConsomme(date('Y'));
    dump($consommationBudget['4615']);
    dump($consommationBudget['3313']);
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', "MainController@index")->name('index');

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', "MainController@dashboard")->name('dashboard');
    Route::post('/mois', "MainController@store")->name('mois');
    Route::post('/hands/restore/{hand}', "HandsInfoController@restore")->name('hands.restore');
    Route::resource('/hands' , 'HandsInfoController');
    Route::resource('/upload' , 'UploadHandInfoController');
    Route::get('/hand/suspendu/{hand}', "MainController@suspendu")->name('hand.suspendu');
    Route::get('/ListHands/Suspendu', "listHandController@suspendu")->name('listhands.suspendu');
    Route::get('/ListHands/Arrete', "listHandController@arrete")->name('listhands.arrete');
    Route::get('/ListHands/EnCours', "listHandController@encours")->name('listhands.encours');
    Route::get('/ListHands/EnAttente', "listHandController@enAttente")->name('listhands.enattente');
    Route::resource('/paie' , 'PaieMensuelleController');
    Route::get('/paiement/export' , 'PaieMensuelleController@export')->name('paie.export');
    Route::get('/paiement/Cnas/{papier}' , 'PaieMensuelleController@Cnas')->name('paie.Cnas');
    Route::get('/paiement/decision' , 'PaieMensuelleController@decision')->name('paie.decision');
    Route::get('/paiement/Journal' , 'PaieMensuelleController@Journal')->name('paie.Journal');
    Route::get('/paiement/BordereauCf' , 'PaieMensuelleController@BordereauCf')->name('paie.BordereauCf');
    Route::get('/paiement/BordereauCD' , 'PaieMensuelleController@BordereauCD')->name('paie.BordereauCD');
    Route::get('/paiement/repartition' , 'PaieMensuelleController@Repartition')->name('paie.repartition');
    Route::get('/paiement/engagement/{papier}' , 'PaieMensuelleController@Engagement')->name('paie.engagement');
    Route::get('/paiement/mondate/{papier}' , 'PaieMensuelleController@Mondate')->name('paie.mondate');
    Route::patch('/budget/updateBudgetSupplimentaire', 'BudgetController@BudgetSupplimenatire')->name('budget.updateBudgetSupplimentaire');
    Route::get('/budget/DownloadBudgetConsomptionPaie' , 'BudgetController@DownloadBudgetConsomptionPaie')->name('budget.DownloadBudgetConsomptionPaie'); 
    Route::get('/budget/DownloadBudgetConsomptionCnas' , 'BudgetController@DownloadBudgetConsomptionCnas')->name('budget.DownloadBudgetConsomptionCnas'); 
    Route::resource('/budget' , 'BudgetController');
    Route::get('/rappel/export' , 'RappelController@export')->name('rappel.export');
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

});


