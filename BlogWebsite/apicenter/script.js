
        // Mobile menu toggle functionality
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.getElementById('sidebar');

        function checkScreenSize() {
            if (window.innerWidth <= 768) {
                mobileMenuBtn.style.display = 'block';
                sidebar.classList.remove('open');
            } else {
                mobileMenuBtn.style.display = 'none';
                sidebar.classList.add('open');
            }
        }

        // Check on load
        window.addEventListener('load', checkScreenSize);
        // Check on resize
        window.addEventListener('resize', checkScreenSize);

        // Toggle sidebar on mobile
        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (event) => {
            if (window.innerWidth <= 768 &&
                !sidebar.contains(event.target) &&
                !mobileMenuBtn.contains(event.target) &&
                sidebar.classList.contains('open')) {
                sidebar.classList.remove('open');
            }
        });