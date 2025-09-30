// assets/function/indicator.js
  function updateRowIndicator() {
    const tbody = document.getElementById("produkTabel");
    const rows = tbody.getElementsByTagName("tr").length;
    document.getElementById("row-indicator").innerText = rows;
  }

  // Hitung saat halaman pertama kali load
  document.addEventListener("DOMContentLoaded", updateRowIndicator);

  // Kalau ada perubahan data (tambah/hapus), panggil lagi updateRowIndicator();

  document.addEventListener("DOMContentLoaded", () => {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
  });
