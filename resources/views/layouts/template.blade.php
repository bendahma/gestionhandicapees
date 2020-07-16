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


</head>

<body id="page-top">
  @auth
    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

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
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Accueil</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Données des Handicapées
        </div>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#handCrud" aria-expanded="true" aria-controls="handCrud">
            <i class="fas fa-pen"></i>
            <span>Gestion Handicapées</span>
          </a>
          <div id="handCrud" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Operation Hand</h6>
              <a class="collapse-item" href="{{route('hands.create')}}">Ajouter Nouveau</a>
            </div>
          </div>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Renouvelement Dossier Annuel
        </div>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dossierAnnuel" aria-expanded="true" aria-controls="dossierAnnuel">
            <i class="far fa-file-alt"></i>
            <span>Dossier Annuel</span>
          </a>
          <div id="dossierAnnuel" class="collapse" aria-labelledby="dossierAnnuel" data-parent="#dossierAnnuel">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Operation Hand</h6>
              <a class="collapse-item" href="{{route('renouvellement.index')}}">Renouvellement</a>
              <a class="collapse-item" href="{{route('renouvellement.statistique')}}">Statistique</a>
            </div>
          </div>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Papiers officiels
        </div>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#attestation" aria-expanded="true" aria-controls="cd">
            <i class="far fa-file-word"></i>
            <span>Attestation</span>
          </a>
          <div id="attestation" class="collapse" aria-labelledby="attestation" data-parent="#attestation">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header"></h6>
              <a class="collapse-item" href="{{route('attestation','paiement')}}">Attestation Paiement</a>
              <a class="collapse-item" href="{{route('attestation','desistement')}}">Désistement Paie</a>
            </div>
          </div>
        </li>
        
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#decision" aria-expanded="true" aria-controls="cd">
            <i class="far fa-file-word"></i>
            <span>Désicion</span>
          </a>
          <div id="decision" class="collapse" aria-labelledby="decision" data-parent="#decision">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header"></h6>
              <a class="collapse-item" href="{{route('decision','paiement')}}">Décision du Paiement</a>
              <a class="collapse-item" href="{{route('decision','reglement')}}">Décision du Réglement</a>
              <a class="collapse-item" href="{{route('decision','suspension')}}">Décision du Suspension</a>
              <a class="collapse-item" href="{{route('decision','arrete')}}">Décision d'arrete'</a>
            </div>
          </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Gestion Du Paiement
        </div>
        <!-- Paiement Mensuelle -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#paieMensuelle" aria-expanded="true" aria-controls="paieMensuelle">
            <i class="fas fa-money-check-alt"></i>
            <span>Paie Mensuelle</span>
          </a>
          <div id="paieMensuelle"  class="collapse" aria-labelledby="headingTwo" data-parent="#paieMensuelle" >
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Paie Mensuelle</h6>
              <a class="collapse-item" href="{{route('paie.index')}}">Résume</a>
              <a class="collapse-item" onclick="return confirm('Are you sur you want to Do or Re-do the paiement ? Re-doing the paiement will change the intial paiement information . Click OK to continue ')" href="{{route('paie.traitement')}}">Traitement</a>
              <a class="collapse-item" href="{{route('paie.documents')}}">Télécharger Document</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="{{route('cds.index')}}">
            <i class="fas fa-compact-disc"></i>
            <span>CD</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="{{route('historique.index')}}" >
            <i class="fas fa-history"></i>
            <span>Historique Des Paiements</span>
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#CfTresor" aria-expanded="true" aria-controls="CfTresor">
            <i class="fas fa-align-center"></i>
            <span class="" >Données CF et Trésor</span>
          </a>
          <div id="CfTresor" class="collapse" aria-labelledby="headingTwo" data-parent="#RappelMenu">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">CF & Trésor</h6>
              <a class="collapse-item" href="">Affiche Les Données</a>
              <a class="collapse-item" onclick="donneeCfTresor(); return false;">Ajouter Les Données</a>
            </div>
          </div>
        </li>
        
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Gestion des Rappels
        </div>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#RappelMenu" aria-expanded="true" aria-controls="RappelMenu">
            <i class="fas fa-calendar-week"></i>
            <span>Rappel</span>
          </a>
          <div id="RappelMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#RappelMenu">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Rappel</h6>
              {{-- <a class="collapse-item" href="{{route('rappel.index')}}">Résume Des Rappels</a> --}}
              <a class="collapse-item" href="{{route('rappel.list')}}">Listes Des Rappels</a>
              <a class="collapse-item" href="{{route('rappel.create')}}">Saisie Rappel</a>
              <a class="collapse-item" href="{{route('rappel.add')}}">Ajouter Rappel</a>
              <a class="collapse-item" href="">Traitement du Rappel</a>
            </div>
          </div>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
        <!-- Heading -->
        <div class="sidebar-heading">
          Statistique
        </div>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#statistics" aria-expanded="true" aria-controls="statistics">
                <i class="fas fa-history"></i>
                <span>Statistique </span>
          </a>
          <div id="statistics" class="collapse" aria-labelledby="headingTwo" data-parent="#RappelMenu">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header"></h6>
              <button class="collapse-item btn btn-link" onclick="MonthlyStaticticsHandaler()">Statistique Mensuelle</button>
            </div>
          </div>

          
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          LISTES DES HAND
        </div>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-list-ol"></i>
            <span>Listes des mondatés</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Lists</h6>
              <a class="collapse-item" href="{{route('listhands.encours')}}">En-cours</a>
              <a class="collapse-item" href="{{route('listhands.enattente')}}">En-Attente</a>
              <a class="collapse-item" href="{{route('listhands.arrete')}}">Suspendu & Arrete</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="{{route('listhands.filtre')}}">
            <i class="fas fa-list-ol"></i>
            <span>Liste Mondaté Filtre</span>
          </a>
        </li>
        
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <!-- Heading -->
        <div class="sidebar-heading">
          Gestion Du Budget
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Budget</span>
          </a>
          <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Les operations du budget</h6>
              <a class="collapse-item" href="{{route('budget.index')}}">Résume du Budget</a>
              <a class="collapse-item" href="{{route('budget.create')}}">Ajouter Budget</a>
              <a class="collapse-item" href="{{route('budget.getDesengagemengt')}}">Desengagement</a>
            </div>
          </div>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Source des données
        </div>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#upload" aria-expanded="true" aria-controls="upload">
            <i class="fas fa-file-upload"></i>
            <span>Import</span>
          </a>
          <div id="upload" class="collapse" aria-labelledby="headingTwo" data-parent="#upload">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Data source</h6>
              <a class="collapse-item" href="{{route('upload.index')}}">Upload from Excel</a>             
            </div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#download" aria-expanded="true" aria-controls="download">
            <i class="fas fa-file-upload"></i>
            <span>Export</span>
          </a>
          <div id="download" class="collapse" aria-labelledby="headingTwo" data-parent="#download">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Data source</h6>
              <a class="collapse-item" href="">Export (Excel)</a>             
            </div>
          </div>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          DATABASE
        </div>
        <li class="nav-item">
          <a class="nav-link collapsed" href="http://127.0.0.1/phpmyadmin/db_structure.php?server=1&db=gestionhand" target="_blank">
            <i class="fas fa-database"></i>
            <span>Base Du Données</span>
          </a>
          
        </li>
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
            
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                  <img class="img-profile rounded-circle" src="{{asset('img/person.png')}}">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  {{-- <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                  </a>
                  <div class="dropdown-divider"></div> --}}
                  <div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="dropdown-item">
                      @csrf
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                      <input type="submit" value="Logout" class="btn btn-link">
                    </form>
                  </div>
                  {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    
                    Logout
                  </a> --}}
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



  @include('admin.statistics.monthly')
  @include('admin.paie.donneeCfTresor')

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

  <script src="{{asset('js/jquery.easing.min.js')}}"></script>

  <script src="{{asset('js/sb-admin-2.js')}}"></script>

  <script src="{{asset('js/Chart.js')}}"></script>

  <script src="{{asset('js/chart-area-demo.js')}}"></script>
  <script src="{{asset('js/chart-pie-demo.js')}}"></script>
  <script src="{{asset('js/datatables-demo.js')}}"></script>

  <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>

@yield('scripts')
</body>

</html>
