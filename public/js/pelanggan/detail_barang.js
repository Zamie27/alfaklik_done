// Fungsi Sembunyikan Detail Barang
document.addEventListener("DOMContentLoaded", function () {
  // Ambil elemen yang dibutuhkan
  const toggleButton = document.getElementById("toggle-description");
  const shortDescription = document.getElementById("short-description");
  const fullDescription = document.getElementById("full-description");

  // Pastikan elemen-elemen tersebut ada
  if (toggleButton && shortDescription && fullDescription) {
    toggleButton.addEventListener("click", function () {
      if (fullDescription.style.display === "none") {
        shortDescription.style.display = "none";
        fullDescription.style.display = "block";
        toggleButton.textContent = "Lihat Lebih Sedikit";
      } else {
        shortDescription.style.display = "block";
        fullDescription.style.display = "none";
        toggleButton.textContent = "Lihat Selengkapnya";
      }
    });
  } else {
    // Log error jika elemen tidak ditemukan
    console.error(
      "Elemen dengan ID 'toggle-description', 'short-description', atau 'full-description' tidak ditemukan."
    );
  }
});
