<?php

Auth::routes(['register' => false]);

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
            Route::resource('/' , 'BudgetController');
        });

    });

    Route::prefix('rappel')->group(function(){
        Route::name('rappel.')->group(function(){
            Route::get('add' , 'RappelController@Add')->name('add');
            Route::post('Saisie' , 'RappelController@Saisie')->name('Saisie');
            Route::get('{rappel}/{hand}' , 'RappelController@findInfo')->name('findInfo');
            Route::patch('confirm/{rappel}' , 'RappelController@ConfirmRappel')->name('confirm');
            Route::resource('/' , 'RappelController');
        });
    });

    Route::prefix('cftresor')->group(function(){
        Route::name('cftresor.')->group(function(){
            Route::resource('/','CfTresorController');
        });
    });
    
});

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', "MainController@dashboard")->name('dashboard');

    Route::get('/hand/suspendu/{hand}', "MainController@suspendu")->name('hand.suspendu');

    Route::post('/hands/restore/{hand}', "HandsInfoController@restore")->name('hands.restore');
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

    Route::get('/rappel/list' , 'RappelController@listePaiementRappel')->name('rappel.list');
    Route::get('/rappel/export' , 'RappelController@export')->name('rappel.export');

    Route::get('/attestation/{listType}', 'AttestationController@index')->name('attestation');
    Route::get('/attestation/telecharger/{hand}/{papier}', 'AttestationController@Download')->name('attestation.telecharger');
    
    Route::get('/decision/{listType}', 'DecisionController@index')->name('decision');
    Route::get('/decision/telecharger/{hand}/{papier}', 'DecisionController@Download')->name('decision.telecharger');
    
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
            Route::patch('DossierRemi/{hand}', 'RenouvelementDossierController@DossierRemi')->name('DossierRemi');
            Route::get('statistique', 'RenouvelementDossierController@Statistique')->name('statistique');
            Route::get('Init', 'RenouvelementDossierController@Init')->name('intia');
            Route::post('suspendu', 'RenouvelementDossierController@suspenduNonRenouvelle')->name('suspendu');
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

    
});


