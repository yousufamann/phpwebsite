      // Toggle mobile menu
      const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
      const sidebar = document.querySelector('.sidebar');
      const closeSidebarBtn = document.querySelector('.close-sidebar');
      const overlay = document.querySelector('.overlay');
      const mainContent = document.querySelector('.main-content');
      
      function openSidebar() {
          sidebar.classList.add('active');
          overlay.classList.add('active');
          document.body.style.overflow = 'hidden';
          mainContent.classList.add('sidebar-open');
      }
      
      function closeSidebar() {
          sidebar.classList.remove('active');
          overlay.classList.remove('active');
          document.body.style.overflow = 'auto';
          mainContent.classList.remove('sidebar-open');
      }

      mobileMenuBtn.addEventListener('click', openSidebar);
      closeSidebarBtn.addEventListener('click', closeSidebar);
      overlay.addEventListener('click', closeSidebar);

      // Toggle user dropdown
      const userProfile = document.querySelector('.user-profile');
      const userDropdown = document.querySelector('.user-dropdown');
      
      userProfile.addEventListener('click', function(e) {
          e.stopPropagation();
          userDropdown.classList.toggle('active');
      });

      // Close dropdown when clicking outside
      document.addEventListener('click', function() {
          userDropdown.classList.remove('active');
      });

      // Prevent dropdown from closing when clicking inside it
      userDropdown.addEventListener('click', function(e) {
          e.stopPropagation();
      });

      // Handle window resize
      function handleResize() {
          if (window.innerWidth > 1200 && !document.fullscreenElement) {
              sidebar.classList.add('active');
              overlay.classList.remove('active');
              document.body.style.overflow = 'auto';
              mainContent.classList.add('sidebar-open');
              document.querySelector('.mobile-menu-btn').style.display = 'none';
              document.querySelector('.close-sidebar').style.display = 'none';
          } else if (!document.fullscreenElement) {
              sidebar.classList.remove('active');
              mainContent.classList.remove('sidebar-open');
              document.querySelector('.mobile-menu-btn').style.display = 'block';
              document.querySelector('.close-sidebar').style.display = 'block';
          }
      }

      // Fullscreen change event
      function handleFullscreenChange() {
          if (document.fullscreenElement) {
              sidebar.classList.add('active');
              mainContent.classList.add('sidebar-open');
              document.querySelector('.mobile-menu-btn').style.display = 'none';
              document.querySelector('.close-sidebar').style.display = 'block';
              overlay.classList.remove('active');
          } else {
              if (window.innerWidth <= 1200) {
                  sidebar.classList.remove('active');
                  mainContent.classList.remove('sidebar-open');
                  document.querySelector('.mobile-menu-btn').style.display = 'block';
              }
          }
      }

      // Initialize on load
      document.addEventListener('DOMContentLoaded', function() {
          handleResize();
          
          // Check if in fullscreen mode
          if (document.fullscreenElement) {
              handleFullscreenChange();
          }
      });

      window.addEventListener('resize', handleResize);
      document.addEventListener('fullscreenchange', handleFullscreenChange);