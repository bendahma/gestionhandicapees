<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Kaddour Bendahma Med Elamine">

  <title>Gestion Des Handicapées</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
  <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link href="{{asset('css/fontawesome.min.css')}}" rel="stylesheet">

  @yield('bgColor')
  @livewireStyles

</head>

<body id="page-top">
  @auth
    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
          <div class="sidebar-brand-icon">
              <i class="fas fa-wheelchair"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Gestion Handecapées</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt fa-2x" style="font-size:1.3em"></i>
            <span>Accueil</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          dossiers
        </div>

        <li class="nav-item active" >
          <a class="nav-link" href="{{route('hands.create')}}">
            <i class="fas fa-pen"  style="font-size:1.3em"></i>
            <span class="mt-2">NOUVEAUX</span></a>
        </li>

        <li class="nav-item active">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dossierAnnuel" aria-expanded="true" aria-controls="dossierAnnuel">
            <i class="far fa-file-alt"  style="font-size:1.3em"></i>
            <span class="mt-2">RENOUVELLE</span>
          </a>
          <div id="dossierAnnuel" class="collapse" aria-labelledby="dossierAnnuel" data-parent="#dossierAnnuel">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Operation Hand</h6>
              <a class="collapse-item" href="{{route('renouvellement.index')}}" target="_blank">List Des Renouvellement</a>
              <a class="collapse-item" href="{{route('renouvellement.statistique')}}" target="_blank">Statistique</a>
            </div>
          </div>
        </li>

        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Paiement
        </div>
        <li class="nav-item active">
          <a class="nav-link" href="{{route('paie.index')}}" target="_blank">
            <i class="fas fa-dollar-sign"  style="font-size:1.3em"></i> <i class="fas fa-dollar-sign"  style="font-size:1.3em"></i>
            <span class="mt-2">MONDATES</span>
          </a>
        </li>

        <li class="nav-item active">
          <a class="nav-link collapsed" href="{{route('historique.index')}}" target="_blank">
            <i class="fas fa-history"  style="font-size:1.3em"></i>
            <span class="mt-2">Historique</span>
          </a>
        </li>
        
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Papiers officiels
        </div>
        <li class="nav-item active">
          <a class="nav-link collapsed" href="{{route('convocation.index')}}" target="_blank">
            <i class="fas fa-envelope-open-text"  style="font-size:1.3em"></i>
            <span>Convocation </span>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#attestation" aria-expanded="true" aria-controls="cd">
            <i class="far fa-file-word"  style="font-size:1.3em"></i>
            <span>Attestation</span>
          </a>
          <div id="attestation" class="collapse" aria-labelledby="attestation" data-parent="#attestation">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header"></h6>
              <a class="collapse-item" href="{{route('attestation','paiement')}}" target="_blank">Attestation Paiement</a>
              <a class="collapse-item" href="{{route('attestation','perde')}}" target="_blank">Attestation Perde</a>
              <a class="collapse-item" href="{{route('attestation','desistement')}}" target="_blank">Désistement Paie</a>
            </div>
          </div>
        </li>
        
        <li class="nav-item active">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#decision" aria-expanded="true" aria-controls="cd">
            <i class="far fa-file-word"></i>
            <span>Désicion</span>
          </a>
          <div id="decision" class="collapse" aria-labelledby="decision" data-parent="#decision">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header"></h6>
              <a class="collapse-item" href="{{route('decision','paiement')}}" target="_blank">Décision du Paiement</a>
              <a class="collapse-item" href="{{route('decision','reglement')}}" target="_blank">Décision du Réglement</a>
              <a class="collapse-item" href="{{route('decision','suspension')}}" target="_blank">Décision du Suspension</a>
              <a class="collapse-item" href="{{route('decision','arrete')}}" target="_blank">Décision d'arrete'</a>
            </div>
          </div>
        </li>
        @if (Auth::user()->isAdmin())
           
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Finance
        </div>
       
        <li class="nav-item active">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#paieMensuelle" aria-expanded="true" aria-controls="paieMensuelle">
            <i class="fas fa-money-check-alt" style="font-size:1.3em"></i>
            <span>Paiement</span>
          </a>
          <div id="paieMensuelle"  class="collapse" aria-labelledby="headingTwo" data-parent="#paieMensuelle" >
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Paie Mensuelle</h6>
              <a class="collapse-item" onclick="return confirm('Are you sur you want to Do or Re-do the paiement ? Re-doing the paiement will change the intial paiement information . Click OK to continue ')" href="{{route('paie.traitement')}}">Traitement</a>
              <a class="collapse-item" href="{{route('paie.documents')}}" target="_blank">Télécharger Document</a>
            </div>
          </div>
        </li>
        @endif
        <li class="nav-item active">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#RappelMenu" aria-expanded="true" aria-controls="RappelMenu">
            <i class="fas fa-calendar-week" style="font-size:1.3em"></i>
            <span>Rappel</span>
          </a>
          <div id="RappelMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#RappelMenu">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Rappel</h6>
              {{-- <a class="collapse-item" href="{{route('rappel.index')}}">Résume Des Rappels</a> --}}
              <a class="collapse-item" href="{{route('rappel.list')}}" target="_blank">Listes Des Rappels</a>
              @if(Auth::user()->isAdmin())
                  <a class="collapse-item" href="{{route('rappel.create')}}" target="_blank">Saisie Rappel</a>
                  <a class="collapse-item" href="{{route('rappel.add')}}" target="_blank">Ajouter Rappel</a>
                  <a class="collapse-item" href="" target="_blank">Traitement du Rappel</a>
                  <a class="collapse-item" href="{{route('rappel.documents')}}" target="_blank">Télécharger Document</a>

              @endif
            </div>
          </div>
        </li>
       
        <li class="nav-item active" >
          <a class="nav-link collapsed" href="{{route('cds.index')}}" target="_blank">
            <i class="fas fa-compact-disc" style="font-size:1.3em"></i>
            <span>CD</span>
          </a>
        </li>
        
        <li class="nav-item active">
          <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#CfTresor" aria-expanded="true" aria-controls="CfTresor">
            <i class="fas fa-align-center" style="font-size:1.3em"></i>
            <span class="" >Données CF et Trésor</span>
          </a>
          <div id="CfTresor" class="collapse" aria-labelledby="headingTwo" data-parent="#RappelMenu">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">CF & Trésor</h6>
              <a class="collapse-item" href="{{route('cftresor.index')}}">Affiche Les Données</a>
              <a class="collapse-item" onclick="donneeCfTresor(); return false;">Ajouter Les Données</a>
            </div>
          </div>
        </li>
     
        
        
        
       
        <hr class="sidebar-divider d-none d-md-block">
        <!-- Heading -->
        <div class="sidebar-heading">
          Statistique
        </div> 
        <li class="nav-item active">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#statistics" aria-expanded="true" aria-controls="statistics">
                <i class="fas fa-history" style="font-size:1.3em"></i>
                <span>Statistique </span>
          </a>
          <div id="statistics" class="collapse" aria-labelledby="headingTwo" data-parent="#RappelMenu">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header"></h6>
              <button class="collapse-item btn btn-link" onclick="MonthlyStaticticsHandaler()">Statistique Mensuelle</button>
              <a href=" {{route('statistique.mondate')}} " class="collapse-item">Statistique Mandaté</a>
            </div>
          </div>
          
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          LISTES DES HAND
        </div>
        <li class="nav-item active" >
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-file-download" style="font-size:1.3em"></i>
            <span>Listes Handicapées</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Lists</h6>
              <a class="collapse-item" href="{{route('listhands.encours')}}" target="_blank">En-cours</a>
              <a class="collapse-item" href="{{route('listhands.enattente')}}" target="_blank">En-Attente</a>
              <a class="collapse-item" href="{{route('listhands.arrete')}}" target="_blank">Suspendu & Arrete</a>
            </div>
          </div>
        </li>
        <li class="nav-item active">
          <a class="nav-link collapsed" href="{{route('listhands.filtre')}}">
            <i class="fas fa-list-ol " style="font-size:1.3em"></i>
            <span>Liste Mandaté </span>
          </a>
        </li>
        @if(Auth::user()->isAdmin())
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Heading -->
            <div class="sidebar-heading">
              Gestion Du Budget
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder" style="font-size:1.3em"></i>
                <span>Budget</span>
              </a>
              <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Les operations du budget</h6>
                  <a class="collapse-item" href="{{route('budget.index')}}" target="_blank"">Résume du Budget</a>
                  <a class="collapse-item" href="{{route('budget.create')}}" target="_blank">Ajouter Budget</a>
                  <a class="collapse-item" href="{{route('budget.getDesengagemengt')}}" target="_blank">Desengagement</a>
                </div>
              </div>
            </li>
        @endif
        
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Source des données
        </div>
        @if (Auth::user()->isAdmin())
          <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#upload" aria-expanded="true" aria-controls="upload">
              <i class="fas fa-file-upload" style="font-size:1.3em"></i>
              <span>Import</span>
            </a> 
            <div id="upload" class="collapse" aria-labelledby="headingTwo" data-parent="#upload">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data source</h6>
                <a class="collapse-item" href="{{route('upload.index')}}" target="_blank">Upload from Excel</a>             
              </div>
            </div>
          </li>
        @endif

        <li class="nav-item active">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#download" aria-expanded="true" aria-controls="download">
            <i class="fas fa-file-upload" style="font-size:1.3em"></i>
            <span>Export</span>
          </a>
          <div id="download" class="collapse" aria-labelledby="headingTwo" data-parent="#download">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Data source</h6>
              <a class="collapse-item" href="" target="_blank">Export (Excel)</a>             
            </div>
          </div>
        </li>
        
        @if (Auth::user()->isAdmin())
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
              DATABASE
            </div>
            <li class="nav-item active">
                  <a class="nav-link collapsed" href="http://127.0.0.1/phpmyadmin/db_structure.php?server=1&db=gestionhand" target="_blank">
                    <i class="fas fa-database" style="font-size:1.3em"></i>
                    <span>Base Du Données</span>
                </a>
            </li>
            <li class="nav-item active">
                  <a class="nav-link collapsed" href="http://127.0.0.1/phpmyadmin/db_structure.php?server=1&db=gestionhand" target="_blank">
                    <i class="fas fa-database" style="font-size:1.3em"></i>
                    <span>Etat de </span>
                </a>
            </li>
        @endif

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>
            <h5 style="font-weight: 700">
              @yield('page')
            </h5>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black;font-weight:700;font-size:0.9rem">
                  <span class="mr-2 d-none d-lg-inline">{{ Auth::user()->name . ' : ' }}</span>
                  <span class="mr-2 d-none d-lg-inline">{{ Auth::user()->UserRole }}</span>
                  <img class="img-profile rounded-circle" src="{{asset('img/person.png')}}">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="dropdown-item">
                      @csrf
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                      <input type="submit" value="Logout" class="btn btn-link">
                    </form>
                  </div>
                </div>
              </li>

            </ul>

          </nav>
          <!-- End of Topbar -->
          @if(session()->has('success'))
              <div class="container">
                  <div class="alert alert-success alert-dismissible fade show">
                      <h6 class="d-flex justify-content-center" style="font-size: 1.1rem;font-weight:700">{{ session()->get('success') }}</h6>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              </div>
          @endif
          @if(session()->has('update'))
            <div class="container">
                <div class="alert alert-info alert-dismissible fade show">
                    <h6 class="d-flex justify-content-center" style="font-size: 1.1rem;font-weight:700">{{ session()->get('update') }}</h6>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
          @endif
          @if(session()->has('warning'))
              <div class="container ">
                  <div class="alert alert-warning alert-dismissible fade show">
                      <h6 class="d-flex justify-content-center" style="font-size: 1.1rem;font-weight:700">{{ session()->get('warning') }}</h6>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              </div>
          @endif
          @if(session()->has('error'))
              <div class="container ">
                  <div class="alert alert-danger alert-dismissible fade show">
                      <h6 class="d-flex justify-content-center" style="font-size: 1.1rem;font-weight:700">{{ session()->get('error') }}</h6>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              </div>
          @endif
          
          @yield('dashboard')
          @yield('uploadExcel')
          @yield('addOrEditHand')
          @yield('showSuspenduInfo')
          @yield('PaieResume')
          @yield('DocumentsPaie')
          @yield('addBudget')
          @yield('RappelResume')
          @yield('list_rappels')
          @yield('addOrEditRappel')
          @yield('listAttestation')
          @yield('history')
          @yield('PaiementHistory')
          @yield('statRenouvellement')
          @yield('CDsection')
          @yield('List-Filtre')
          @yield('addDesengagement')
          @yield('AfficheCfTresor')
          @yield('uploadDossierAnnuel')
          @yield('rappelFaitList')
          @yield('statTables')
          @yield('msnfcf')
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Gestion Des Handicapées 2020</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
            
          </div>
        </div>
      </div>
    </div>
  @else
    @yield('login')
  @endauth


  <x-delete-hand-form />
  
  @include('admin.statistics.monthly')
  @include('admin.cftresor.donneeCfTresor')

  @livewireScripts

  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('js/sb-admin-2.js')}}"></script>
  <script> 
    document.addEventListener('livewire:load', () => { 
      window.livewire.on('newfocus', inputname => { document.getElementById("dobField").focus(); })
    });
    document.addEventListener('livewire:load', () => { 
      window.livewire.on('focusDateRenouvellement', inputname => { document.getElementById("focusDateRenouvellement").focus(); })
    });
    </script>
</body>

</html>
