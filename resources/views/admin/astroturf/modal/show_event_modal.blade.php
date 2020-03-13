<div id="show-event-modal" class="modal" tabindex="-1" role="dialog">
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
                        <strong><i class="fas fa-book mr-1"></i> Açıklama</strong>

                        <p id="modal_event_title_text" class="text-muted"></p>

                        <hr>
                        <strong><i class="fas fa-book mr-1"></i> Maç Tarihi</strong>

                        <p id="modal_event_start_date_text" class="text-muted"></p>
                        <p id="modal_event_end_date_text" class="text-muted"></p>

                        <hr>
                        <button type="button" class="btn btn-block btn-outline-danger" data-toggle="collapse" data-target="#event_cancel_match_collapse" aria-expanded="false" aria-controls="event_cancel_match_collapse">Maçı İptal Et</button>

                        <div class="collapse" id="event_cancel_match_collapse">
                            <div class="card card-body text-center">
                                <form id="destroy-event-form" method="post" action="{{ route('admin.astroturf.calendar.destroy', $astroturf->id) }}">
                                    @csrf
                                    @method("delete")
                                    <input type="hidden" id="modal_calendar_id" name="calendar_id">
                                </form>
                                <p>Maçı iptal etmek istediğine emin misin?</p>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success" onclick="document.getElementById('destroy-event-form').submit();">Evet</button>
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