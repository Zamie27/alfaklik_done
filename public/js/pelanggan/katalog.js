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

// JS notifikasi klik tombol Beli barang
document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".add-to-cart");

  buttons.forEach((button) => {
    button.addEventListener("click", function (e) {
      e.preventDefault(); // Cegah tindakan default (jika ada)
      const productId = this.getAttribute("data-id");
      const url = this.getAttribute("data-url");

      // Disable tombol agar tidak bisa diklik lagi
      this.disabled = true;
      this.innerHTML = "Memproses...";

      // Kirim data ke server menggunakan fetch
      fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          id_barang: productId,
          quantity: 1, // Default jumlah
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status === "success") {
            Swal.fire({
              icon: "success",
              title: "Berhasil",
              text: "Barang berhasil ditambahkan ke keranjang!",
              timer: 1500,
              showConfirmButton: false,
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Gagal",
              text: "Terjadi kesalahan saat menambahkan barang ke keranjang.",
            });
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          Swal.fire({
            icon: "error",
            title: "Gagal",
            text: "Terjadi kesalahan saat memproses permintaan.",
          });
        })
        .finally(() => {
          // Aktifkan kembali tombol setelah proses selesai
          this.disabled = false;
          this.innerHTML = "Beli";
        });
    });
  });
});
