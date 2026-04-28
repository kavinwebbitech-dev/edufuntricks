// contact
document
  .getElementById("discoveryForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();
    const btn = e.target.querySelector(".discovery-btn-submit");
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML =
      '<span class="spinner-border spinner-border-sm me-2"></span> Sending...';

    setTimeout(() => {
      btn.innerHTML =
        '<i class="bi bi-check-circle-fill me-2"></i> Sent Successfully';
      btn.style.backgroundColor = "#28a745";
      e.target.reset();

      setTimeout(() => {
        btn.disabled = false;
        btn.innerHTML = originalText;
        btn.style.backgroundColor = "";
      }, 3000);
    }, 1500);
  });

//

