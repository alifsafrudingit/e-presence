 <!-- App Bottom Menu -->
 <div class="appBottomMenu">
     <a href="{{ route('dashboard') }}" class="item {{ request()->is('dashboard') ? 'active' : '' }}">
         <div class="col">
             <ion-icon name="home-outline" role="img" class="md hydrated" aria-label="home outline"></ion-icon>
             <strong>Home</strong>
         </div>
     </a>
     <a href="{{ route('presence.permission') }}" class="item">
         <div class="col">
             <ion-icon name="calendar-outline" role="img" class="md hydrated"
                 aria-label="calendar outline"></ion-icon>
             <strong>Ijin</strong>
         </div>
     </a>
     <a href="{{ route('presence.create') }}" class="item">
         <div class="col">
             <div class="action-button large">
                 <ion-icon name="camera" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
             </div>
         </div>
     </a>
     <a href="{{ route('presence.history') }}" class="item">
         <div class="col">
             <ion-icon name="document-text-outline" role="img" class="md hydrated"
                 aria-label="document text outline"></ion-icon>
             <strong>Histori</strong>
         </div>
     </a>
     <a href="{{ route('profile.editprofile') }}"
         class="item {{ request()->is('profile.editprofile') ? 'active' : '' }}">
         <div class="col">
             <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
             <strong>Profile</strong>
         </div>
     </a>
 </div>
 <!-- * App Bottom Menu -->
