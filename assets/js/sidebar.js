  // Side Tab Button Toggle
  const sideBtn = document.getElementById('more-info-btn');
  const sidePanel = document.getElementById('side-panel');

  sideBtn.addEventListener('click', function () {
    sidePanel.classList.toggle('open');
    sideBtn.classList.toggle('open');
  });

  // Close panel when clicking outside
  document.addEventListener('click', function (e) {
    if (!sidePanel.contains(e.target) && !sideBtn.contains(e.target)) {
      sidePanel.classList.remove('open');
      sideBtn.classList.remove('open');
    }
  });
