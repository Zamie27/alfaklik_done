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

document.addEventListener("DOMContentLoaded", function () {
  const addToCartButtons = document.querySelectorAll(".add-to-cart");

  addToCartButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const idBarang = button.getAttribute("data-id");
      const url = button.getAttribute("data-url");

      fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-Requested-With": "XMLHttpRequest",
        },
        body: JSON.stringify({
          id_barang: idBarang,
          quantity: 1,
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status === "success") {
            Swal.fire({
              icon: "success",
              title: "Berhasil",
              text: data.message,
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Gagal",
              text: data.message,
            });
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          Swal.fire({
            icon: "error",
            title: "Gagal",
            text: "Terjadi kesalahan.",
          });
        });
    });
  });
});
