// Modal utility functions
function showModal(modal) {
  if (modal) {
    modal.classList.remove('hidden');
  }
}

function hideModal(modal) {
  if (modal) {
    modal.classList.add('hidden');
  }
}

function initModal(modalId, openBtnId, closeBtnId, cancelBtnId) {
  const modal = document.getElementById(modalId);
  const openBtn = document.getElementById(openBtnId);
  const closeBtn = closeBtnId ? document.getElementById(closeBtnId) : null;
  const cancelBtn = cancelBtnId ? document.getElementById(cancelBtnId) : null;

  // Open modal button
  if (openBtn) {
    openBtn.addEventListener('click', () => {
      showModal(modal);
    });
  }

  // Close button inside modal
  if (closeBtn) {
    closeBtn.addEventListener('click', () => {
      hideModal(modal);
    });
  }

  // Cancel button inside modal (usually for forms)
  if (cancelBtn) {
    cancelBtn.addEventListener('click', () => {
      hideModal(modal);
    });
  }

  // Click outside modal content closes modal
  if (modal) {
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        hideModal(modal);
      }
    });
  }
}

// Close modal with Escape key
function setupEscapeKey() {
  document.addEventListener('keydown', (e) => {
    if (e.key === "Escape") {
      const modals = document.querySelectorAll('.fixed.inset-0.bg-black\\/50.z-50.p-4:not(.hidden)');
      modals.forEach(modal => hideModal(modal));
    }
  });
}

document.addEventListener('DOMContentLoaded', () => {
  // Initialize participant modal
  initModal('participant-modal', 'add-participant-btn', 'close-participant-modal', 'cancel-participant');

  // Initialize spectator modal
  initModal('spectator-modal', 'add-spectator-btn', 'close-spectator-modal', 'cancel-spectator');

  // Initialize view details modal
  initModal('view-modal', null, 'close-view-modal', null);

  // Setup Escape key handler for all modals
  setupEscapeKey();
});
