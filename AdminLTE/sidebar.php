 <?php
  include 'script.html';
  include 'rel.html';
  ?>
 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="index3.html" class="brand-link">
     <img src="../../AdminLTE/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
     <span class="brand-text font-weight-light">SPKPENTU</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
     <!-- Sidebar user panel (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <div class="image">
         <img src="../../AdminLTE/dist/img/ummu.jpg" class="img-circle elevation-2" alt="User Image">
       </div>
       <div class="info">
         <a href="#" class="d-block">Ummu Habibah Nur'Aini</a>
       </div>
     </div>

     <!-- SidebarSearch Form -->
     <div class="form-inline">
       <div class="input-group" data-widget="sidebar-search">
         <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
         <div class="input-group-append">
           <button class="btn btn-sidebar">
             <i class="fas fa-search fa-fw"></i>
           </button>
         </div>
       </div>
     </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item">
           <a href="../tb_mahasiswa/mahasiswa.php" class="nav-link">
             <i class="nav-icon fas fa-tachometer-alt"></i>
             <p>
               Data Mahasiswa
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="../tb_prodi/prodi.php" class="nav-link">
             <i class="nav-icon fas fa-book"></i>
             <p>
               Data Prodi
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="../tb_levelukt/levelukt.php" class="nav-link">
             <i class="nav-icon fas fa-th"></i>
             <p>
               Data Golongan UKT
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="../tb_kriteria/kriteria.php" class="nav-link">
             <i class="nav-icon fas fa-chart-pie"></i>
             <p>
               Data Kriteria
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="../tb_subkriteria/subkriteria.php" class="nav-link">
             <i class="nav-icon fas fa-tree"></i>
             <p>
               Data Sub Kriteria
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="../tb_nilaikriteriamhs/nilaikriteriamhs.php" class="nav-link">
             <i class="nav-icon far fa-image"></i>
             <p>
               Nilai Kriteria Mahasiswa
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="../tb_vektor/vektor.php" class="nav-link">
             <i class="nav-icon far fa-calendar-alt"></i>
             <p>
               Data Vektor Mahasiswa
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="../tb_user/user.php" class="nav-link">
             <i class="nav-icon fas fa-edit"></i>
             <p>
               Data User
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="../../logout.php" class="nav-link">
             <i class="nav-icon fas fa-sign-out-alt"></i>
             <p>
               Log out
             </p>
           </a>
         </li>
       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>