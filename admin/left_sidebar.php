 <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
     <div class="sb-sidenav-menu">
         <div class="nav">
             <div class="sb-sidenav-menu-heading">Core</div>
             <a class="nav-link" href="dashboard.php">
                 <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                 Dashboard
             </a>

             <a class="nav-link" href="category.php">
                 <div class="sb-nav-link-icon">
                     <i class="fas fa-table"></i>
                 </div>
                 Category
             </a>
               <a class="nav-link" href="tag.php">
                 <div class="sb-nav-link-icon">
                     <i class="fas fa-table"></i>
                 </div>
                 Tag
             </a>
              <a class="nav-link" href="post.php">
                 <div class="sb-nav-link-icon">
                     <i class="fas fa-table"></i>
                 </div>
                 Post
             </a>
         </div>
     </div>
     <div class="sb-sidenav-footer">
         <div class="small">Logged in as:</div>
         <?php echo $_SESSION['name']; ?>
     </div>
 </nav>