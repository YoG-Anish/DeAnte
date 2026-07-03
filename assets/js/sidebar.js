document.addEventListener("DOMContentLoaded", function () {
  // Elements
  const barMenuTrigger = document.querySelector(".bar-menu");
  const sidebar = document.getElementById("sidebarMenu");
  const closeSidebarBtn = document.getElementById("closeSidebar");

  const contactModal = document.getElementById("contactModal");
  const closeContactBtn = document.getElementById("closeModal");
  const getInTouchBtns = document.querySelectorAll(
    ".btn-modal-sidebar-contact",
  );

  // --- Sidebar Logic ---
  // Only run if BOTH the trigger and the sidebar exist
  if (barMenuTrigger && sidebar) {
    barMenuTrigger.addEventListener("click", () => {
      sidebar.classList.add("active");
      document.body.style.overflow = "hidden";
    });
  }

  // Check if the close button exists
  if (closeSidebarBtn && sidebar) {
    closeSidebarBtn.addEventListener("click", () => {
      sidebar.classList.remove("active");
      document.body.style.overflow = "auto";
    });
  }

  // --- Contact Modal Logic ---
  // Check if buttons exist (NodeList length) and the modal exists
  if (getInTouchBtns.length > 0 && contactModal) {
    getInTouchBtns.forEach((btn) => {
      btn.addEventListener("click", (e) => {
        e.preventDefault(); // Prevent jump if it's an <a> tag

        // Safety check for sidebar inside this loop
        if (sidebar) {
          sidebar.classList.remove("active");
        }

        contactModal.classList.add("active");
        document.body.style.overflow = "hidden";
      });
    });
  }

  if (closeContactBtn && contactModal) {
    closeContactBtn.addEventListener("click", () => {
      contactModal.classList.remove("active");
      document.body.style.overflow = "auto";
    });
  }

  // --- Global Click Listener ---
  window.addEventListener("click", (e) => {
    // Check sidebar existence and click target
    if (sidebar && e.target === sidebar) {
      sidebar.classList.remove("active");
      document.body.style.overflow = "auto";
    }

    // Check contact modal existence and click target
    if (contactModal && e.target === contactModal) {
      contactModal.classList.remove("active");
      document.body.style.overflow = "auto";
    }
  });
});
