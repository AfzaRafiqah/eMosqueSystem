<!-- Vertical Layout -->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header bg-blue-grey">
        <h2>
          REGISTER
        </h2>
        @if(session()->has('warning'))
        <div class="alert alert-warning">
          {{ session()->get('warning') }}
        </div>
        @endif
        @if(session()->has('danger'))
        <div class="alert alert-danger">
          {{ session()->get('danger') }}
        </div>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success">
          {{ session()->get('success') }}
        </div>
        @endif
      </div>
      <div class="body cuba">
        <form method="POST" action="{{ route('participates.store') }}">
          @csrf

          <div class="row clearfix">
            <div class="col-sm-5">
              <label for="eventName">Name</label>
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="name" name="name" class="form-control" required="required">
                </div>
              </div>
            </div>
          </div>
          <div class="row clearfix">
            <div class="col-sm-2">
              <label for="age">Age</label>
              <div class="form-group">
                <div class="form-line">
                  <input type="number" id="age" class="form-control" name="age" min="1" required />
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" id="eventId" name="eventId" value={{$event}}>
          <button class="btn btn-success" type="submit">SUBMIT</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- #END# Vertical Layout -->