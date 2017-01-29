<div class="modal fade" id="elimThing">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">{{ Lang::get('lang.delete') }} <span class="what-to-elim"></span></h4>
      </div>
      <div class="modal-body">
        {{ Lang::get('lang.delete_text') }}
        <div class="alert responseAjax">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <p></p>
        </div>
      </div>
      <div class="modal-footer">
        <img src="{{ asset('images/loader.gif') }}" class="miniLoader">
        <button type="button" class="btn btn-danger btn-elim-thing-modal">{{ Lang::get('lang.delete') }}</button>
      </div>
    </div>
  </div>
</div>