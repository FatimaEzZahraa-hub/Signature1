<div class="modal fade" id="modalAddDocument" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('parapheur.addDocument', $parapheur) }}" method="POST" enctype="multipart/form-data" id="addDocumentForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Ajouter des documents</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="existing_document_ids" class="form-label">Sélectionner des documents existants</label>
            <select name="existing_document_ids[]" id="existing_document_ids" class="form-select" multiple size="5" required>
              @foreach(\App\Models\Document::all() as $doc)
                <option value="{{ $doc->id }}">{{ $doc->titre }}</option>
              @endforeach
            </select>
            <small class="text-muted">Maintenez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs documents</small>
          </div>
          <div class="mb-3">
            <label class="form-label">Ou ajouter de nouveaux documents</label>
            <div class="input-group">
              <input type="file" name="new_documents[]" class="form-control" id="new_documents" multiple>
              <label class="input-group-text" for="new_documents">
                <i class="bi bi-upload"></i>
              </label>
            </div>
            <small class="text-muted">Vous pouvez sélectionner plusieurs fichiers</small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary" id="submitDocuments">Ajouter</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.getElementById('addDocumentForm').addEventListener('submit', function(e) {
    const existingDocs = document.getElementById('existing_document_ids');
    const newDocs = document.getElementById('new_documents');
    
    if (existingDocs.selectedOptions.length === 0 && newDocs.files.length === 0) {
        e.preventDefault();
        alert('Veuillez sélectionner au moins un document ou télécharger un nouveau fichier.');
        return false;
    }
    
    // Afficher les données sélectionnées dans la console
    console.log('Documents existants sélectionnés:', Array.from(existingDocs.selectedOptions).map(opt => opt.value));
    console.log('Nouveaux fichiers:', Array.from(newDocs.files).map(file => file.name));
});
</script>

<style>
.modal-content {
  border-radius: 10px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}
.modal-header {
  border-bottom: 1px solid #eee;
  padding: 1rem 1.5rem;
}
.modal-title {
  color: #3d0072;
  font-size: 1.25rem;
  margin: 0;
}
.modal-body {
  padding: 1.5rem;
}
.modal-footer {
  border-top: 1px solid #eee;
  padding: 1rem 1.5rem;
}
.form-label {
  color: #666;
  font-weight: 500;
  margin-bottom: 0.5rem;
}
.form-control, .form-select {
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 0.5rem 0.75rem;
}
.form-control:focus, .form-select:focus {
  border-color: #3d0072;
  box-shadow: 0 0 0 0.2rem rgba(61, 0, 114, 0.25);
}
.btn-primary {
  background-color: #3d0072;
  border-color: #3d0072;
  padding: 0.5rem 1.5rem;
}
.btn-primary:hover {
  background-color: #2b0052;
  border-color: #2b0052;
}
.btn-secondary {
  background-color: #6c757d;
  border-color: #6c757d;
  padding: 0.5rem 1.5rem;
}
.btn-secondary:hover {
  background-color: #5a6268;
  border-color: #545b62;
}
.input-group-text {
  background-color: #f8f9fa;
  border: 1px solid #ddd;
  color: #666;
}
.form-select[multiple] {
  height: auto;
  min-height: 120px;
}
</style> 