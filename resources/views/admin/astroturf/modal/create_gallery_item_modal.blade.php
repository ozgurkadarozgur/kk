<div id="create-gallery-item-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Resim</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="store-gallery-item-form" method="post" action="{{ route('admin.astroturf.gallery.store', $astroturf->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="image" class="col-sm-2 col-form-label">Resim</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control {{ $errors->has('image') ? 'is-invalid' : ''  }}" id="image" name="image">
                        </div>
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="document.getElementById('store-gallery-item-form').submit();" class="btn btn-outline-primary">Kaydet</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">İptal</button>
            </div>
        </div>
    </div>
</div>