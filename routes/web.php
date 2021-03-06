<?php

// Auth::routes(['register' => false]);
Auth::routes();

Route::get('/', "MainController@index")->name('index');

Route::middleware(['auth','admin'])->group(function(){

    Route::prefix('paie')->group(function(){
        Route::get('/' , 'PaieMensuelleController@index')->name('paie.index');
        Route::get('export' , 'PaieMensuelleController@export')->name('paie.export');
        Route::get('Cnas/{papier}' , 'PaieMensuelleController@Cnas')->name('paie.Cnas');
        Route::get('decision' , 'PaieMensuelleController@decision')->name('paie.decision');
        Route::get('Journal' , 'PaieMensuelleController@Journal')->name('paie.Journal');
        Route::get('BordereauCf' , 'PaieMensuelleController@BordereauCf')->name('paie.BordereauCf');
        Route::get('BordereauCD' , 'PaieMensuelleController@BordereauCD')->name('paie.BordereauCD');
        Route::get('repartition' , 'PaieMensuelleController@Repartition')->name('paie.repartition');
        Route::get('engagement/{papier}' , 'PaieMensuelleController@Engagement')->name('paie.engagement');
        Route::get('mondate/{papier}' , 'PaieMensuelleController@Mondate')->name('paie.mondate');
        Route::get('traitement' , 'PaieMensuelleController@MakePaie')->name('paie.traitement');
        Route::get('documents' , 'PaieMensuelleController@DocumentsPaie')->name('paie.documents');
        Route::post('donneeCfTresor' , 'PaieMensuelleController@DonneeCfTresor')->name('paie.updateCfTresorData');
        Route::get('informationsPaiement' , 'PaieMensuelleController@AfficheDonneesCfTresor')->name('paie.informationsPaiement');
    });

    Route::prefix('cds')->group(function(){
        Route::name('cds.')->group(function(){
            Route::get('/','CdController@index')->name('index');
            Route::post('CdClassique','CdController@CdClassique')->name('CdClassique');
            Route::post('CdMondatement','CdController@CdMondatement')->name('CdMondatement');
            Route::post('CdBeneficier','CdController@CdBeneficier')->name('CdBeneficier');
        });
    });
    
    Route::prefix('budget')->group(function(){
        Route::name('budget.')->group(function(){
            Route::patch('updateBudgetSupplimentaire', 'BudgetController@BudgetSupplimenatire')->name('updateBudgetSupplimentaire');
            Route::get('DownloadBudgetConsomptionPaie' , 'BudgetController@DownloadBudgetConsomptionPaie')->name('DownloadBudgetConsomptionPaie'); 
            Route::get('DownloadBudgetConsomptionCnas' , 'BudgetController@DownloadBudgetConsomptionCnas')->name('DownloadBudgetConsomptionCnas'); 
            Route::get('Desengagement' , 'BudgetController@getDesengagemengt')->name('getDesengagemengt'); 
            Route::patch('DesengagementBudget' , 'BudgetController@DesengagementBudget')->name('DesengagementBudget');
        });

    });

    Route::resource('/budget' , 'BudgetController');

    Route::prefix('rappel')->group(function(){
        Route::name('rappel.')->group(function(){
            Route::get('add' , 'RappelController@Add')->name('add');
            Route::post('Saisie' , 'RappelController@Saisie')->name('Saisie');
            Route::get('{rappel}/{hand}' , 'RappelController@findInfo')->name('findInfo');
            
            Route::get('/documents','RappelController@Documents')->name('documents');
            Route::post('/documents/telecharge','RappelController@Download')->name('download');
            Route::patch('/update/{rappel}','RappelController@updateRappel')->name('updateRappel');
            Route::resource('/' , 'RappelController');
        });
    });

    Route::prefix('cftresor')->group(function(){
        Route::name('cftresor.')->group(function(){
            Route::resource('/','CfTresorController');
        });
    });

    Route::get('/cleanData','HandsInfoController@cleanData');
    Route::get('/checkRipCCP','HandsInfoController@checkRipCCP');
    
});

Route::middleware(['auth'])->group(function(){

    Route::get('/dashboard', "MainController@dashboard")->name('dashboard');

    Route::get('/hand/suspendu/{hand}', "MainController@suspendu")->name('hand.suspendu');

    Route::post('/hands/restore/{hand}', "HandsInfoController@restore")->name('hands.restore');
    Route::get('/hands/editSuspensionInfo/{id}', "HandsInfoController@editHandSuspensionInfo")->name('hands.editSuspensionInfo');
    Route::patch('/hands/UpdateSuspendu', "HandsInfoController@updateHandSuspensionInfo")->name('hands.updateSuspensionInfo');
    Route::post('/msnfcf','HandsInfoController@Msnfcf')->name('hands.msnfcf');
    Route::get('/msnfcf/reint','HandsInfoController@MsnfcfReinit')->name('hands.MsnfcfReinit');
    Route::resource('/hands' , 'HandsInfoController');

    Route::resource('/upload' , 'UploadHandInfoController');

    Route::prefix('ListHands')->group(function(){
        Route::name('listhands.')->group(function(){
            Route::get('Arrete', "listHandController@arrete")->name('arrete');
            Route::get('EnCours', "listHandController@encours")->name('encours');
            Route::get('EnAttente', "listHandController@enAttente")->name('enattente');
            Route::get('Filtre', "listHandController@Filtre")->name('filtre');
            Route::post('FiltreListeHand', "listHandController@FiltreListeHand")->name('FiltreListeHand');
        });
    });

    Route::prefix('rappel')->group(function(){
        Route::name('rappel.')->group(function(){
            Route::get('list' , 'RappelController@listePaiementRappel')->name('list');
            Route::get('export' , 'RappelController@export')->name('export');
            Route::post('rappelFait' , 'RappelController@rappelFait')->name('rappelFait');
            Route::patch('confirm/{rappel}' , 'RappelController@ConfirmRappel')->name('confirm');
        });
    });
    
    Route::prefix('attestation')->group(function(){
        Route::name('attestation')->group(function(){
            Route::get('/{listType}', 'AttestationController@index');
            Route::get('/telecharger/{hand}/{papier}', 'AttestationController@Download')->name('.telecharger');
        });
    });

    Route::prefix('decision')->group(function(){
        Route::name('decision')->group(function(){
            Route::get('/{listType}', 'DecisionController@index');
            Route::get('/telecharger/{hand}/{papier}', 'DecisionController@Download')->name('.telecharger');
            Route::get('/telecharger/reglement/renouvellement/{hand}', 'DecisionController@RenouvellementDossier')->name('.renouvellement');
        });
    });
        
    Route::prefix('historique')->group(function(){
        Route::name('historique.')->group(function(){
            Route::get('/', 'HistoryPaiementController@index')->name('index');
            Route::get('paiement/{hand}', 'HistoryPaiementController@HistoriquePaie')->name('HistoriquePaie');
            Route::get('suspension/{hand}', 'HistoryPaiementController@HistoriqueSuspension')->name('HistoireSuspension');        
            Route::delete('suspension/delete/{history}', 'HistoryPaiementController@DeleteHistoriqueSuspension')->name('DeleteHistoireSuspension');        
        });
    });
    
    Route::prefix('renouvellement')->group(function(){
        Route::name('renouvellement.')->group(function(){
            Route::put('DossierRemi/{id}', 'RenouvelementDossierController@DossierRemi')->name('DossierRemi');
            Route::get('statistique', 'RenouvelementDossierController@Statistique')->name('statistique');
            Route::get('Init', 'RenouvelementDossierController@Init')->name('intia');
            Route::post('suspendu', 'RenouvelementDossierController@suspenduNonRenouvelle')->name('suspendu');
            Route::get('suspenduTous', 'RenouvelementDossierController@suspenduTousNonRenouvelle')->name('suspenduAll');
            Route::get('listnonrenouvelle/{codeComune}', 'RenouvelementDossierController@ListNonRenouvelle')->name('listnonrenouvelle');
            Route::get('listnonrenouvelleTouts/', 'RenouvelementDossierController@ListNonRenouvelleToutes')->name('renouvelleTous');
            Route::get('listnonrenouvelle/NonRenouvelle/download', 'RenouvelementDossierController@export')->name('NonRenouvelleDownload');
            Route::post('renouvelleDossierFromFile','RenouvelementDossierController@renouvelleDossierFromFile')->name('renouvelleDossierFromFile');
            Route::resource('/', 'RenouvelementDossierController');        
        });
    });

    Route::post('/monthlyStatistics', 'StaticticsController@StatistiqueMensuelle');
    
    Route::prefix('download')->group(function(){
        Route::name('hands.')->group(function(){
            Route::get('exportHandsMondate','listHandController@exportHandsMondate')->name('exportHandsMondate');
            Route::get('exportHandsSuspendu','listHandController@exportHandsSuspendu')->name('exportHandsSuspendu');
            Route::post('suspensionHandRange','listHandController@suspensionHandRange')->name('suspensionHandRange');
        });
    });

    Route::prefix('convocation')->group(function(){
        Route::name('convocation.')->group(function(){
            Route::get('/','ConvocationController@index')->name('index');
            Route::get('suspension/{hand}','ConvocationController@Suspension')->name('suspension');
            Route::post('{hand}','ConvocationController@SuspensionAny')->name('any');
        });
    });

    Route::prefix('update')->group(function(){
        Route::name('database.')->group(function(){
            Route::get('download', 'UploadHandInfoController@DownloadUpdate')->name('download');
            Route::get('upload', 'UploadHandInfoController@UploadUpdate')->name('upload');
        });
    });

    Route::get('/notification/telecharger/{hand}/{papier}', 'MainController@Notification')->name('notification.telecharger');

    Route::prefix('monthlyPaie')->group(function(){
        Route::name('monthlyPaie.')->group(function(){
            Route::get('/list/{paieId}','PaieMensuelleController@listMensuelle')->name('list');
        });
    });

    Route::prefix('statistique')->group(function(){
        Route::name('statistique.')->group(function(){
            Route::get('/','StaticticsController@index')->name('index');
            Route::get('/mondate','StaticticsController@StatistiqueMondate')->name('mondate');
        });
    });
    
});