<div id="create-calendar-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Maç</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="store-calendar-form" method="post" action="{{ route('admin.astroturf.calendar.store', $astroturf->id) }}">
                    @csrf
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Açıklama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''  }}" id="title" name="title" placeholder="Açıklama">
                        </div>
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Başlangıç Saati</label>
                        <div class="col-sm-10">
                            <p id="start_date_text"></p>
                            <input type="hidden" class="form-control {{ $errors->has('start_date') ? 'is-invalid' : ''  }}" id="start_date" name="start_date">
                        </div>
                        <div class="invalid-feedback">
                            {{ $errors->first('start_date') }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Bitiş Saati</label>
                        <div class="col-sm-10">
                            <p id="end_date_text"></p>
                            <input type="hidden" class="form-control {{ $errors->has('end_date') ? 'is-invalid' : ''  }}" id="end_date" name="end_date">
                        </div>
                        <div class="invalid-feedback">
                            {{ $errors->first('end_date') }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_subscriber" class="col-sm-2 col-form-label">Abone</label>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="is_subscriber_yes" name="is_subscriber" value="true">
                                <label for="is_subscriber_yes" class="custom-control-label">Evet</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="is_subscriber_no" name="is_subscriber" value="false" checked>
                                <label for="is_subscriber_no" class="custom-control-label">Hayır</label>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            {{ $errors->first('is_subscriber') }}
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="document.getElementById('store-calendar-form').submit();" class="btn btn-outline-primary">Kaydet</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">İptal</button>
            </div>
        </div>
    </div>
</div>