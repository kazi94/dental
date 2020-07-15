@extends('layouts.app')
@section('content')
<div class="app-main__inner">
  
  <h3>APPLICATIONS
  </h3>
  
  <div class="row">
    
    <div class="col-md-9">
      
      <div class="row">
        
        <div class="col-md-3 mr-3" style="cursor: pointer;">
          
          <div class="mb-3 text-center card card-body" onclick="window.location.href = '{{ route('patient.index') }}'">
            
            <i class=" pe-7s-graph1 icon-gradient bg-asteroid fa-5x mb-2">
            </i>
            
            <h5 class="card-title">MON CABINET
            </h5>
            Consulter le tableau de bord  de votre cabinet.
            
          </div>
          
        </div>
        
        <div class="col-md-3 mr-3" style="cursor: pointer;">
          
          <div class="mb-3 text-center card card-body card-patient" onclick="window.location.href = '{{ route('patient.index') }}'">
            
            <i class=" pe-7s-id icon-gradient bg-happy-itmeo fa-5x mb-2">
            </i>
            
            <h5 class="card-title">MES PATIENTS
            </h5>
            Gérez vos patients et leurs dossiers médicales.
            
          </div>
          
        </div>
        
        <div class="col-md-3 mr-3" style="cursor: pointer;">
          
          <div class="mb-3 text-center card card-body" onclick="window.location.href = '{{ route('patient.index') }}'">
            
            <i class=" pe-7s-note2 icon-gradient bg-happy-fisher fa-5x mb-2">
            </i>
            
            <h5 class="card-title">MES ORDONNANCES
            </h5>
            Gérez vos les ordonnances de vos patients.
            
          </div>
          
        </div>
        
        <div class="col-md-3 mr-3" style="cursor: pointer;">
          
          <div class="mb-3 text-center card card-body" onclick="window.location.href = '{{ route('patient.index') }}'">
            
            <i class=" pe-7s-cash icon-gradient bg-grow-early fa-5x mb-2">
            </i>
            
            <h5 class="card-title">MES HONORAIRES
            </h5>
            Gérez les honoraires de vos patients .
            
          </div>
          
        </div>
        
        <div class="col-md-3 mr-3" style="cursor: pointer;">
          
          <div class="mb-3 text-center card card-body" onclick="window.location.href = '{{ route('appointement.index') }}'">
            
            <i class=" pe-7s-date icon-gradient bg-plum-plate fa-5x mb-2">
            </i>
            
            <h5 class="card-title">AGENDA
            </h5>
            Gérez les prises de rendez-vous des patients .
            
          </div>
          
        </div>
        
        <div class="col-md-3 mr-3" style="cursor: pointer;">
          
          <div class="mb-3 text-center card card-body" onclick="window.location.href = '{{ route('setting.index') }}'">
            
            <i class=" pe-7s-config  icon-gradient bg-mean-fruit fa-5x mb-2">
            </i>
            
            <h5 class="card-title">REGLAGES
            </h5>
            Gérez les réglages de votre cabinet.
            
          </div>
          
        </div>
        
        
      </div>
      
    </div>
    
    <div class="col-md-3">
      
      <div class="row">
        
        <div class="col-md-12">
          
          <div class="mb-3 text-center card card-body" onclick="window.location.href = '{{ route('setting.index') }}'">
            
            <i class=" pe-7s-graph icon-gradient bg-mean-fruit fa-5x mb-2">
            </i>
            
            <h5 class="card-title">Dr. Kazi Sidou
            </h5>
            ICI INFORMATIONS PROFESSIONNEL ET DERNIER CONNEXION...
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            
          </div>
          
        </div>
        
      </div>
      
    </div>
    
  </div>
  
  <h3>OUTILS
  </h3>
  
  <div class="row">
    
    <div class="col-md-3 mr-3" style="cursor: pointer;">
      
      <div class="mb-3 text-center card card-body" onclick="window.location.href = '{{ route('patient.index') }}'">
        
        <i class=" pe-7s-video icon-gradient bg-mean-fruit fa-5x mb-2">
        </i>
        
        <h5 class="card-title">VIDEOS DEMOS
        </h5>
        Gérez votre bibliothèque de vidéos.
        
      </div>
      
    </div>
    
    <div class="col-md-3 mr-3" style="cursor: pointer;">
      
      <div class="mb-3 text-center card card-body" onclick="window.location.href = '{{ route('patient.index') }}'">
        
        <i class=" pe-7s-photo icon-gradient bg-mean-fruit fa-5x mb-2">
        </i>
        
        <h5 class="card-title">MES PHOTOS
        </h5>
        Gérez votre bibliothèque de photos.
        
      </div>
      
    </div>
    
  </div>
</div>
@endsection
