@extends('layouts.template')

@section('PaieResume')

    <div class="container">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Le Budget d'année {{date('Y')}}  </h1>
         </div>

        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Chapitre 46-15 Article U</div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800">{{ number_format($budget->budgetMondatement,2,',',' ') }} DZD</div>
                    </div>
                    <div class="col-auto">
                     <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Chapitre 33-13 article 02</div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800">{{ number_format($budget->budgetAssurance,2,',',' ') }} DZ</div>
                    </div>
                    <div class="col-auto">
                     <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                  </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Le Budget Supplémentaire d'année {{date('Y')}}  </h1>
       </div>

      <div class="row">
          <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Chapitre 46-15 Article U</div>
                    <div class="h4 mb-0 font-weight-bold text-gray-800">{{ number_format($budget->budgetMondatement,2,',',' ') }} DZD</div>
                  </div>
                  <div class="col-auto">
                   <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Chapitre 33-13 article 02</div>
                    <div class="h4 mb-0 font-weight-bold text-gray-800">{{ number_format($budget->budgetAssurance,2,',',' ') }} DZ</div>
                  </div>
                  <div class="col-auto">
                   <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Consommation du Budget Jusqu'a {{date('M Y')}}</h1>
      </div>
      <div class="row">
         <div class="col-xl-4 col-md-6 mb-4">
           <div class="card border-success shadow h-100 py-2">
             <div class="card-body">
               <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                   <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Chapitre 46-15 Article U</div>
                   <div class="h4 mb-0 font-weight-bold text-gray-800">{{ number_format($budget->budgetMondatementConsomme,2,',',' ') }} DZD</div>
                 </div>
                 <div class="col-auto">
                   <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                 </div>
               </div>
             </div>
           </div>
         </div>
         
         <div class="col-xl-4 col-md-5 mb-4">
           <div class="card border-primary shadow h-100 py-2">
             <div class="card-body">
               <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                   <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Chapitre 33-13 article 02</div>
                   <div class="h4 mb-0 font-weight-bold text-gray-800">{{ number_format($budget->budgetAssuranceConsomme,2,',',' ') }} DZ</div>
                 </div>
                 <div class="col-auto">
                  <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
               </div>
               </div>
             </div>
           </div>
         </div>
       </div>
       <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Le reste du Budget D'année {{date('Y')}}</h1>
      </div>
      <div class="row">
         <div class="col-xl-4 col-md-6 mb-4">
           <div class="card border-success shadow h-100 py-2">
             <div class="card-body">
               <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                   <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Chapitre 46-15 Article U</div>
                   <div class="h4 mb-0 font-weight-bold text-gray-800">{{ number_format(($budget->budgetMondatement - $budget->budgetMondatementConsomme),2,',',' ') }} DZD</div>
                 </div>
                 <div class="col-auto">
                   <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                 </div>
               </div>
             </div>
           </div>
         </div>
         
         <div class="col-xl-4 col-md-5 mb-4">
           <div class="card border-primary shadow h-100 py-2">
             <div class="card-body">
               <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                   <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Chapitre 33-13 article 02</div>
                   <div class="h4 mb-0 font-weight-bold text-gray-800">{{ number_format(( $budget->budgetAssurance - $budget->budgetAssuranceConsomme),2,',',' ') }} DZ</div>
                 </div>
                 <div class="col-auto">
                  <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
               </div>
               </div>
             </div>
           </div>
         </div>
       </div>
       <div class="d-sm-flex align-items-center justify-content-between mb-4">
       <h1 class="h3 mb-0 text-gray-800">Fiche du consommation du budget d'année {{date('Y')}}</h1>
      </div>
      <div class="row">
        <div class="col-lg-5">
          <div class="card border-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col">
                  <h5 style="color:black;font-weight:700" class="pt-2">Chapitre 46-15 Article U</h5> 
                </div>
                <div class="col-lg-4">
                  <a href="{{route('budget.DownloadBudgetConsomptionPaie')}}" class="d-none d-sm-inline-block btn btn-md btn-primary"><i class="fas fa-download fa-sm text-white-50"></i> Télécharger</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-lg-5">
          <div class="card border-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col">
                  <h5 style="color:black;font-weight:700" class="pt-2">Chapitre 33-13 Article 02</h5> 
                </div>
                <div class="col-lg-4">
                  <a href="{{route('budget.DownloadBudgetConsomptionCnas')}}" class="d-none d-sm-inline-block btn btn-md btn-primary"><i class="fas fa-download fa-sm text-white-50"></i> Télécharger</a>
                </div>
              </div>
            </div>
          </div>
        </div>
       
      </div>
    </div>

    <br><br><br><br>
@endsection