// Sembunyikan deskripsi lebih dari 100 huruf
document.addEventListener("DOMContentLoaded", function () {
  const userNameElement = document.getElementById("deskripsi");
  const fullName = userNameElement.textContent.trim(); // Ambil nama lengkap

  if (fullName.length > 10) {
    const shortName = `${fullName.substring(0, 10)}...`; // Potong setelah 6 karakter
    userNameElement.textContent = shortName;
  }
});
