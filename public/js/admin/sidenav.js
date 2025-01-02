// Pilih semua link dalam sidebar
const navLinks = document.querySelectorAll("#sidebarNav .nav-link");

navLinks.forEach((link) => {
  link.addEventListener("click", function (e) {
    // Hapus class 'active' dari semua link
    navLinks.forEach((nav) => nav.classList.remove("active", "bg-danger"));

    // Tambahkan class 'active' dan 'bg-danger' ke link yang diklik
    this.classList.add("active", "bg-danger");
  });
});
