document.getElementById('contact-link').onclick = function(e) {
    e.preventDefault();
    document.getElementById('contact-modal').style.display = 'block';
    };
    document.getElementById('close-modal').onclick = function() {
    document.getElementById('contact-modal').style.display = 'none';
    };
  function toggleContactMenu() {
    const menu = document.getElementById('contactMenu');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
  }

  // Optional: Hide menu when clicking outside
  document.addEventListener('click', function(event) {
    const dropdown = document.querySelector('.dropdown');
    const menu = document.getElementById('contactMenu');
    if (!dropdown.contains(event.target)) {
      menu.style.display = 'none';
    }
  });


  

