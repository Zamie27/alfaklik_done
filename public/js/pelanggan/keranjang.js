// JS hapus salah satu barang
document.addEventListener("DOMContentLoaded", function () {
  const deleteButtons = document.querySelectorAll(".btn-delete-item");

  deleteButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const cartId = this.getAttribute("data-id");
      const productName = this.getAttribute("data-name");

      Swal.fire({
        title: `Hapus ${productName}?`,
        text: "Barang akan dihapus dari keranjang Anda.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal",
      }).then((result) => {
        if (result.isConfirmed) {
          // Kirim permintaan ke server untuk menghapus barang
          fetch(`/pelanggan/cart/remove/${cartId}`, {
            // Pastikan URL sesuai route Anda
            method: "POST",
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.status === "success") {
                Swal.fire({
                  icon: "success",
                  title: "Berhasil",
                  text: `Barang "${productName}" berhasil dihapus dari keranjang.`,
                  timer: 1500,
                  showConfirmButton: false,
                }).then(() => {
                  location.reload(); // Refresh halaman
                });
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Gagal",
                  text:
                    data.message || "Terjadi kesalahan saat menghapus barang.",
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
            });
        }
      });
    });
  });
});

// Js alert hapus semua barang
document.addEventListener("DOMContentLoaded", function () {
  const deleteAllButton = document.querySelector(".btn-delete-all");

  if (deleteAllButton) {
    deleteAllButton.addEventListener("click", function () {
      Swal.fire({
        title: "Yakin ingin menghapus semua barang?",
        text: "Semua barang di keranjang akan dihapus!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal",
      }).then((result) => {
        if (result.isConfirmed) {
          // Kirim permintaan untuk menghapus semua barang
          fetch(`/pelanggan/cart/clear`, {
            method: "POST",
            headers: {
              "X-Requested-With": "XMLHttpRequest",
            },
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.status === "success") {
                Swal.fire(
                  "Terhapus!",
                  "Semua barang berhasil dihapus dari keranjang.",
                  "success"
                ).then(() => {
                  location.reload(); // Refresh halaman
                });
              } else {
                Swal.fire(
                  "Gagal!",
                  data.message || "Terjadi kesalahan saat menghapus barang.",
                  "error"
                );
              }
            })
            .catch((error) => {
              console.error("Error:", error);
              Swal.fire(
                "Gagal!",
                "Terjadi kesalahan saat memproses permintaan.",
                "error"
              );
            });
        }
      });
    });
  }
});

// JS alert ubah kuantitas
document.addEventListener("DOMContentLoaded", function () {
  const editButtons = document.querySelectorAll(".btn-edit-quantity");

  editButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const cartId = this.getAttribute("data-id");
      const currentQuantity = this.getAttribute("data-quantity");
      const productName = this.getAttribute("data-name");

      Swal.fire({
        title: `Ubah Kuantiti`,
        text: `Barang: ${productName}`,
        input: "number",
        inputValue: currentQuantity,
        inputAttributes: {
          min: 1,
          step: 1,
        },
        showCancelButton: true,
        confirmButtonText: "Simpan",
        cancelButtonText: "Batal",
        preConfirm: (newQuantity) => {
          if (!newQuantity || newQuantity < 1) {
            Swal.showValidationMessage("Jumlah harus lebih dari 0");
          }
          return newQuantity;
        },
      }).then((result) => {
        if (result.isConfirmed) {
          // Kirim permintaan ke server untuk memperbarui kuantiti
          fetch(`cart/update`, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              id_carts: cartId,
              quantity: result.value,
            }),
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.status === "success") {
                Swal.fire({
                  icon: "success",
                  title: "Berhasil",
                  text: "Kuantiti berhasil diperbarui!",
                  timer: 1500,
                  showConfirmButton: false,
                }).then(() => {
                  location.reload(); // Refresh halaman
                });
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Gagal",
                  text:
                    data.message ||
                    "Terjadi kesalahan saat memperbarui kuantiti.",
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
            });
        }
      });
    });
  });
});
