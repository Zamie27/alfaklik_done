// Fungsi Lihat lainnya dashboard
document.getElementById("see-more").addEventListener("click", function () {
  // Pilih semua elemen yang tersembunyi (dengan inline style display: none;)
  const hiddenItems = document.querySelectorAll(
    "#product-list .col[style='display: none;']"
  );

  // Tampilkan elemen dengan menghapus atribut display
  hiddenItems.forEach((item) => (item.style.display = "block"));

  // Sembunyikan tombol setelah semua elemen ditampilkan
  this.style.display = "none";
});

//  Js Klik Tombol Beli Card barang
document.addEventListener("DOMContentLoaded", () => {
  const buttons = document.querySelectorAll(".add-to-cart");

  buttons.forEach((button) => {
    button.addEventListener("click", function (e) {
      e.preventDefault(); // Mencegah perilaku default seperti redirect ke halaman card
      const itemId = this.getAttribute("data-id");
      const url = this.getAttribute("data-url");

      fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-Requested-With": "XMLHttpRequest",
        },
        body: JSON.stringify({ id_barang: itemId }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status === "success") {
            Swal.fire({
              icon: "success",
              title: "Berhasil!",
              text: data.message,
              timer: 1500,
              showConfirmButton: false,
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Gagal!",
              text: data.message,
            });
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Terjadi kesalahan pada sistem.",
          });
        });
    });
  });
});
