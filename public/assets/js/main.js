(function () {
  /* ========= Preloader ======== */
  const preloader = document.querySelectorAll('#preloader')

  window.addEventListener('load', function () {
    if (preloader.length) {
      this.document.getElementById('preloader').style.display = 'none'
    }
  })

  /* ========= Add Box Shadow in Header on Scroll ======== */
  window.addEventListener('scroll', function () {
    const header = document.querySelector('.header')
    if (window.scrollY > 0) {
      header.style.boxShadow = '0px 0px 30px 0px rgba(200, 208, 216, 0.30)'
    } else {
      header.style.boxShadow = 'none'
    }
  })

  /* ========= sidebar toggle ======== */
   const sidebarNavWrapper = document.querySelector(".sidebar-nav-wrapper");
  const mainWrapper = document.querySelector(".main-wrapper");
  const menuToggleButton = document.querySelector("#menu-toggle"); // Potensi null
  const menuToggleButtonIcon = document.querySelector("#menu-toggle i"); // Potensi null jika menuToggleButton null
  const overlay = document.querySelector(".overlay"); // Potensi null

  // Hanya tambahkan event listener jika elemen-elemen ini ada
  if (menuToggleButton && sidebarNavWrapper && overlay && mainWrapper) { // Ditambahkan pengecekan
    menuToggleButton.addEventListener("click", () => {
      sidebarNavWrapper.classList.toggle("active");
      overlay.classList.add("active");
      mainWrapper.classList.toggle("active");

      if (menuToggleButtonIcon) { // Tambahkan pengecekan untuk icon juga
        if (document.body.clientWidth > 1200) {
          if (menuToggleButtonIcon.classList.contains("lni-chevron-left")) {
            menuToggleButtonIcon.classList.remove("lni-chevron-left");
            menuToggleButtonIcon.classList.add("lni-menu");
          } else {
            menuToggleButtonIcon.classList.remove("lni-menu");
            menuToggleButtonIcon.classList.add("lni-chevron-left");
          }
        } else {
          if (menuToggleButtonIcon.classList.contains("lni-chevron-left")) {
            menuToggleButtonIcon.classList.remove("lni-chevron-left");
            menuToggleButtonIcon.classList.add("lni-menu");
          }
        }
      }
    });

    overlay.addEventListener("click", () => {
      sidebarNavWrapper.classList.remove("active");
      overlay.classList.remove("active");
      mainWrapper.classList.remove("active");
    });
  }

  // Anda mungkin juga perlu menambahkan pengecekan serupa untuk bagian preloader dan header scroll
  // jika elemen #preloader atau .header juga tidak selalu ada di semua halaman.
  // Contoh untuk preloader:
  const preloaderElement = document.getElementById('preloader'); // Gunakan getElementById karena Anda pakai itu di event load
  if (preloaderElement) {
      window.addEventListener('load', function () {
          preloaderElement.style.display = 'none';
      });
  } else {
      // Jika #preloader tidak ada, pastikan tidak ada efek samping lain.
      // Biasanya aman jika hanya menyembunyikan.
  }

  // Contoh untuk header shadow:
  const header = document.querySelector('.header');
  if (header) { // Tambahkan pengecekan
    window.addEventListener('scroll', function () {
      if (window.scrollY > 0) {
        header.style.boxShadow = '0px 0px 30px 0px rgba(200, 208, 216, 0.30)';
      } else {
        header.style.boxShadow = 'none';
      }
    });
  }

})();