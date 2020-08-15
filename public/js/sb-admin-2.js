(function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

})(jQuery); // End of use strict

function deleteHandaler(id){
    $('#deleteModel').modal('show');
    let link = '/hands/' + id;
    let form = document.getElementById('deleteForm');
    form.action = link;
}

function MonthlyStaticticsHandaler(){
  $('#MenthlyStatModel').modal('show');
    let link = '/monthlyStatistics' ;
    let form = document.getElementById('MenthlyStatistics');
    form.action = link;
}

function remiHandaler(id){
    $('#remiHand').modal('show');
    let link = '/hands/restore/' + id;
    let form = document.getElementById('remiForm');
    form.action = link;
}

function suspenduRange(){
    $('#suspensionArreteRange').modal('show');
}
function donneeCfTresor(){
    $('#donneeCFTresorForm').modal('show');
}

if(document.getElementById('NewSituation') != null){
    document.getElementById('NewSituation').addEventListener('change',()=>{
      const situationSelector = document.getElementById('NewSituation');
      const situation = situationSelector.options[situationSelector.selectedIndex].value;
      if(situation == 'en cours'){
        document.getElementById('dateRemi').style['display'] = '';
        document.getElementById('raisonRemi').style['display'] = '';
        document.getElementById('RappelTitle').style['display'] = '';
        document.getElementById('meriteRappel').style['display'] = '';
        document.getElementById('rappelDates').style['display'] = '';
        document.getElementById('rappelObs').style['display'] = '';
        /***************************************************************************************** */
        document.getElementById('EnAttentedateComissionPension').style['display'] = 'none';
        document.getElementById('raisonEnAttente').style['display'] = 'none';
      }else if(situation == 'En attente'){

        document.getElementById('EnAttentedateComissionPension').style['display'] = '';
        document.getElementById('raisonEnAttente').style['display'] = '';

        /* ***************************************************************************************** */
        document.getElementById('dateRemi').style['display'] = 'none';
        document.getElementById('raisonRemi').style['display'] = 'none';
        document.getElementById('RappelTitle').style['display'] = 'none';
        document.getElementById('meriteRappel').style['display'] = 'none';
        document.getElementById('rappelDates').style['display'] = 'none';
        document.getElementById('rappelObs').style['display'] = 'none';

       
      }
    });
}

if(document.getElementById('motifSup') != null){
      document.getElementById('motifSup').addEventListener('change',()=>{
        const motifSelect = document.getElementById('motifSup');
        const motif = motifSelect.options[motifSelect.selectedIndex].value;

        if(motif == "AUTRE"){
          document.getElementById('AutreSuppMotif').style["display"] = "block";
        }else{
          document.getElementById('AutreSuppMotif').style["display"] = "none";
        }
    });
}

if(document.getElementById('PaieStatusHand') != null){
    document.getElementById('PaieStatusHand').addEventListener('change',()=>{
       const statusSelect = document.getElementById('PaieStatusHand');
        const status = statusSelect.options[statusSelect.selectedIndex].value;
        if(status == 'En attente'){
          document.getElementById('raisonId').style['display'] = "";
          document.getElementById('DateCommissionPensionId').style['display'] = "";
        }else{
          document.getElementById('raisonId').style['display'] = "none";
          document.getElementById('DateCommissionPensionId').style['display'] = "none";
        
        }      
    });
}

