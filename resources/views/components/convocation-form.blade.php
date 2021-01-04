<div>
    <form action="" method="POST" id="convocationForm">
        @csrf
        <div class="modal fade" id="convocationModel" tabindex="-1" role="dialog" aria-labelledby="convocationModelTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="convocationModelTitle">Convocation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group text-right">
                        <label for="" class="font-weight-bold text-right">الأوراق</label>
                        <input type="text" name="paper" class="form-control" dir="rtl">
                    </div>
                    <div class="form-group text-right">
                        <label for="" class="font-weight-bold text-right">سبب الإستدعاء</label>
                        <input type="text" name="motif" class="form-control" dir="rtl">
                    </div>
                   
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-success">Télechargé</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulé</button>
                </div>
            </div>
            </div>
        </div>

    </form>
</div>