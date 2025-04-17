<div class="modal fade" id="modalNewParapheur" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('parapheur.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Nouveau parapheur</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nom" class="form-label">Nom du Parapheur*</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="existing_document_id" class="form-label">Sélectionner un document existant</label>
            <select name="existing_document_id" id="existing_document_id" class="form-select">
              <option value="">-- aucun --</option>
              @foreach(\App\Models\Document::all() as $doc)
                <option value="{{ $doc->id }}">{{ $doc->titre }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Ou ajouter un nouveau document</label>
            <div class="input-group">
              <input type="file" name="new_document" class="form-control" id="new_document">
              <label class="input-group-text" for="new_document">
                <i class="bi bi-upload"></i>
              </label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
      </form>
    </div>
  </div>
</div>

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
</style>
