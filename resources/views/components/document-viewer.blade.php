<!-- resources/views/components/document-viewer.blade.php -->
<div id="documentViewer" class="position-fixed top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.2); display: none; z-index: 2000;">
  <div class="d-flex justify-content-center align-items-center h-100">
    <div class="bg-white shadow rounded p-3 position-relative" style="width: 90%; height: 90%; border-radius: 20px; overflow: hidden;">
      
      <!-- En-tête -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="badge bg-light text-dark px-3 py-2" style="border-radius: 50px;">Doc. <span id="docIndex">1/1</span> - <span id="docTitle">Titre</span></span>
        <button onclick="toggleDocumentViewer()" class="btn btn-sm btn-light" style="border-radius: 50%;">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>

      <!-- Aperçu PDF avec <iframe> -->
      <div class="rounded shadow-sm" style="height: calc(100% - 110px); overflow: hidden;">
        <iframe id="pdfFrame" src="" width="100%" height="100%" style="border: none;"></iframe>
      </div>

      <!-- Bouton de téléchargement -->
      <div class="text-center mt-3">
        <a id="downloadBtn" href="#" class="btn btn-outline-light" style="background-color: #3d0072; color: white; border-radius: 25px;">
          <i class="bi bi-download me-2"></i>Télécharger
        </a>
      </div>

    </div>
  </div>
</div>

<script>
  function toggleDocumentViewer(url = '', title = 'Document', index = '1/1') {
    const viewer = document.getElementById('documentViewer');
    const frame = document.getElementById('pdfFrame');
    const docTitle = document.getElementById('docTitle');
    const docIndex = document.getElementById('docIndex');
    const downloadBtn = document.getElementById('downloadBtn');

    if (viewer.style.display === 'none' || viewer.style.display === '') {
      frame.src = url;
      docTitle.textContent = title;
      docIndex.textContent = index;
      downloadBtn.href = url;
      viewer.style.display = 'block';
    } else {
      frame.src = '';
      viewer.style.display = 'none';
    }
  }
</script>
