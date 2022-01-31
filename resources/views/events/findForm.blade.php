@extends('layouts.tempAdmin')
@section('content')
<!-- Vertical Layout -->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header bg-blue-grey">
        <h2>
          ENTER DATE
        </h2>
      </div>
      <div class="body cuba">
        <form method="POST" action="{{ route('events.find') }}">
          @csrf

          <div class="row clearfix">
            <div class="col-sm-2">
              <label for="start_date">Start Date</label>
              <div class="form-group">
                <div class="form-line">
                  <input type="date" id="start_date" name="start_date" class="form-control" required="required">
                </div>
              </div>
            </div>
          </div>
          <div class="row clearfix">
            <div class="col-sm-2">
              <label for="end_date">End Date</label>
              <div class="form-group">
                <div class="form-line">
                  <input type="date" id="" class="form-control" name="end_date" required />
                </div>
              </div>
            </div>
          </div>
          <div class="row clearfix">
            <div class="col-sm-2">
              <p>
                <b>Status</b>
              </p>
              <select class="form-control show-tick" id="status" type="text" name="status" required>
                <option disabled="disabled" selected="selected">Status</option>
                <option value="All">All</option>
                <option value="Pending">Pending</option>
                <option value="Expired">Expired</option>
                <option value="Approve">Approve</option>
                <option value="Cancel">Cancel</option>
                <option value="Decline">Decline</option>
              </select>
            </div>
          </div>
          <button class="btn btn-success" type="submit">SUBMIT</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- #END# Vertical Layout -->
@endsection