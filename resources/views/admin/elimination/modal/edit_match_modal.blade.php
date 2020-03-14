<div id="edit-match-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Maç Detayı</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- About Me Box -->
                <div class="card card-info">
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Takımlar</strong>

                        <p id="modal_edit_match_teams_text" class="text-muted"></p>

                        <hr>

                        <form id="modal_edit_match_form" method="post" action="#">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="modal_edit_match_start_date"><i class="fas fa-book mr-1"></i> Maç Tarihi</label>
                                <input type="date" class="form-control" id="modal_edit_match_start_date" name="start_date">
                            </div>
                            <hr>

                            <div class="form-group">
                                <label for="modal_edit_match_start_time"><i class="fas fa-book mr-1"></i> Maç Saati</label>
                                <input type="time" class="form-control" id="modal_edit_match_start_time" name="start_time">
                            </div>
                            <hr>

                            <div class="form-group">
                                <label for="modal_edit_match_astroturf_id"><i class="fas fa-book mr-1"></i> Saha</label>
                                <select name="astroturf_id" id="modal_edit_match_astroturf_id" class="form-control">
                                    @foreach($elimination->facility->astroturfs as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                        <hr>

                        <button type="button" class="btn btn-block btn-outline-danger" data-toggle="collapse" data-target="#event_cancel_match_collapse" aria-expanded="false" aria-controls="event_cancel_match_collapse">Kaydet</button>

                        <div class="collapse" id="event_cancel_match_collapse">
                            <div class="card card-body text-center">
                                <p>Bu bilgiler ile kaydetmek istediğine emin misin?</p>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success" onclick="document.getElementById('modal_edit_match_form').submit();">Evet</button>
                                    <button type="button" class="btn btn-danger">Hayır</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>