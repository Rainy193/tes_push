<div class="iq-sidebar">
            <div class="iq-sidebar-logo d-flex justify-content-between">
            <a href="dashboard.php" class="header-logo">
                  <img src="../assets/images/logo.png" class="img-fluid rounded-normal" alt="">
                  <div class="logo-title">
                     <span class="text-danger text-uppercase">Peliharaan<span class="text-primary ml-1"></span></span>
                  </div>
               </a>
               <div class="iq-menu-bt-sidebar">
                  <div class="iq-menu-bt align-self-center">
                     <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                        <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                     </div>
                  </div>
               </div>
            </div>
            <hr class="sidebar-divider">
            <div id="sidebar-scrollbar">
               <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                     <li class="active active-menu">
                      <a href="dashboard.php"><i class="las la-house-damage"></i><span>Dashboard</span></a>
                    </li>
                    <hr class="sidebar-divider">
                    <li class=" active-menu">
                      <a href="peliharaan.php"  class="iq-waves-effect"><i class="fa-duotone fa-solid fa-paw"></i><span>Peliharaan</span></a>
                    </li>

                    <li class=" active-menu">
                      <a href="dokter.php"><i class="fa-solid fa-stethoscope"></i><span>Dokter</span></a>
                    </li>

                    <li class=" active-menu">
                      <a href="record.php"><i class="fa-solid fa-notes-medical"></i><span>Catatan Kesehatan</span></a>
                    </li>      

                    <li class=" active-menu">
                      <a href="owner.php" class="iq-waves-effect"  aria-expanded="false" ><span class="ripple rippleEffect"></span><i class="fa-solid fa-user-tie"></i><span>Pemilik Hewan</span></a>
                    </li>    
                    <?php
  // Cek apakah level pengguna adalah 'Admin' atau 'Operator'
  if (isset($_SESSION['role']) && ($_SESSION['role'] === 'admin')) {
  ?>     
                    <hr class="sidebar-divider">
                     <li>
                          <a href="pengguna.php" class="iq-waves-effect"  aria-expanded="false"><span class="ripple rippleEffect"></span><i class="las la-user-tie iq-arrow-left"></i><span>User</span></a>
                     </li> 
                     <?php
  }
  ?>
                     <hr class="sidebar-divider">
                     
                     <li class=" active-menu">
                      <a href="logout.php" class="iq-waves-effect"  data-toggle="modal" data-target="#logoutModal" aria-expanded="false" ><span class="ripple rippleEffect"></span><i class="ri-login-box-line ml-2"></i><span>Logout</span></a>
                    </li>  

                    <hr class="sidebar-divider">
                  </ul>
               </nav>
            

            </div>
         </div>

         

            