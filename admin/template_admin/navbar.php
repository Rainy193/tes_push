<!-- TOP Nav Bar -->
<?php
  // session_start(); // Start the session to access session variables

  // Assuming the username is stored in the session under 'username'
  $nama = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; // Default to 'Guest' if not set
  ?>
         <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
               <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="iq-menu-bt d-flex align-items-center">
                  </div>
                  <div class="navbar-breadcrumb">
                     <p class="mb-0"><span class="text-danger">Hi there,</span> Great to see you again</p>
                  </div>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  </div>
                  <ul class="navbar-list">
                     <li class="line-height">
                        <a href="" class="search-toggle iq-waves-effect d-flex align-items-center">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo "Hai ", ucfirst(strtolower($nama)); ?></span>
                        <img src="../assets/images/user/user.png" class="img-fluid rounded-circle" alt="user">
                        </a>
                     
                     </li>
                  </ul>
               </nav>
            </div>
         </div>
         <!-- TOP Nav Bar END -->