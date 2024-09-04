document.addEventListener('DOMContentLoaded', function() {
    const fadeElements = document.querySelectorAll('.fade-in');
  
    function checkVisibility() {
      fadeElements.forEach(el => {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom >= 0) {
          el.classList.add('visible');
        } else {
          el.classList.remove('visible');
        }
      });
    }
  
    window.addEventListener('scroll', checkVisibility);
    checkVisibility(); // Cek visibilitas saat halaman dimuat
  });


  document.addEventListener('DOMContentLoaded', function() {
    const zoomElements = document.querySelectorAll('.zoom-on-scroll');
  
    function checkZoom() {
      zoomElements.forEach(el => {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom >= 0) {
          el.classList.add('zoomed');
        } else {
          el.classList.remove('zoomed');
        }
      });
    }
  
    window.addEventListener('scroll', checkZoom);
    checkZoom(); // Cek zoom saat halaman dimuat
  });
