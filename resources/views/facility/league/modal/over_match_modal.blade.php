<div id="over-match-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Maç Sonucu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- About Me Box -->
                <div class="card card-info">
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Skor Girin</strong>

                        <form id="modal_over_match_form" method="post" action="#">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label for="modal_over_match_team1_score" id="modal_over_match_team1_text">Takım1 </label>
                                <input type="number" class="form-control" id="modal_over_match_team1_score" name="team1_score">
                            </div>
                            <hr>


                            <div class="form-group">
                                <label for="modal_over_match_team2_score" id="modal_over_match_team2_text">Takım2 </label>
                                <input type="number" class="form-control" id="modal_over_match_team2_score" name="team2_score">
                            </div>
                            <hr>

                        </form>

                        <hr>

                        <button type="button" class="btn btn-block btn-outline-danger" data-toggle="collapse" data-target="#event_cancel_match_collapse" aria-expanded="false" aria-controls="event_cancel_match_collapse">Kaydet</button>

                        <div class="collapse" id="event_cancel_match_collapse">
                            <div class="card card-body text-center">
                                <p>Bu bilgiler ile kaydetmek istediğine emin misin?</p>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success" onclick="document.getElementById('modal_over_match_form').submit();">Evet</button>
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