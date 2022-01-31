@section('content')
<!-- Vertical Layout -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card bg-grey">
            <div class="header">
                <h2>
                    CREATE NEW EVENT
                </h2>
            </div>
            <div class="body cuba">
                <form action="{{ route('myBookings.store') }}" method="POST" onsubmit="return Compare()">
                    @csrf
                    <input type="hidden" id="location" name="location" value="Masjid Kariah Kampung Sri Kendong">
                    <div class="container">
                        <div class="row clearfix">
                            <label for="eventType">Event Type</label>
                            <div class="form-group">
                                <div class="demo-radio-button">
                                    <input type="radio" id="chkCer" name="eventType" value="Ceramah" onclick="ShowHideDiv()" class="radio-col-red" checked />
                                    <label for="chkCer">CERAMAH</label>
                                    <input type="radio" id="chkAkad" name="eventType" value="Akad Nikah" onclick="ShowHideDiv()" class="radio-col-pink" />
                                    <label for="chkAkad">AKAD NIKAH</label>
                                    <input type="radio" id="chkKem" name="eventType" value="Kem" onclick="ShowHideDiv()" class="radio-col-purple" />
                                    <label for="chkKem">KEM</label>
                                    <input type="radio" id="chkKul" name="eventType" value="Kuliah Maghrib" onclick="ShowHideDiv()" class="radio-col-deep-purple" />
                                    <label for="chkKul">KULIAH MAGHRIB</label>
                                    <input type="radio" id="chkSol" name="eventType" value="Solat Jumaat" onclick="ShowHideDiv()" class="radio-col-indigo" />
                                    <label for="chkSol">SOLAT JUMAAT</label>
                                    <input type="radio" id="chkTah" name="eventType" value="Tahlil/Doa Selamat" onclick="ShowHideDiv()" class="radio-col-blue" />
                                    <label for="chkTah">TAHLIL/DOA SELAMAT</label>
                                    <input type="radio" id="chkLain" name="eventType" value="Lain-lain" onclick="ShowHideDiv()" class="radio-col-light-blue" />
                                    <label for="chkLain">LAIN-LAIN</label>
                                </div>
                            </div>
                            <input type="hidden" id="location" name="location" value="Masjid Kariah Kampung Sri Kendong">
                            <div class="container">
                                <div class="row" id="dvlocation" style="display: none">
                                    <label for="location">Location</label>
                                    <div class="value">
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" id="location" name="location" value="Masjid Kampung Sri Kendong">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </dic>
                    <div class="row clearfix">
                        <div class="col-sm-5">
                            <label for="eventName">Event's Name</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="eventName" name="eventName" class="form-control" required="required">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-3">
                            <label for="txtFrom">Start Date</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" id="txtFrom" class="form-control" name="startDate" min="<?= date('Y-m-d'); ?>" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="txtTo">End Date</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" class="form-control" id="txtTo" name="endDate" disabled="disabled" value="" min="<?= date('Y-m-d'); ?>" required="required" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-3">
                            <label for="startTime">Start Time</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="time" class="form-control" name="startTime" id="txtStartTime" required="required" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="endTime">End Time</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="time" class="form-control" name="endTime" id="txtEndTime" required="required" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row clearfix">
                            <label for="part">Participation</label>
                            <div class="form-group">
                                <div class="demo-radio-button">
                                    <input type="radio" id="com" name="part" value="Committee Member" onclick="ShowHideDivPart()" class="radio-col-pink" checked />
                                    <label for="com">COMMITTEE MEMBER ONLY</label>
                                    <input type="radio" id="others" name="part" value="Others" onclick="ShowHideDivPart()" class="radio-col-pink" />
                                    <label for="others">LIMITED PARTICIPANT</label>
                                    <input type="radio" id="unlimited" name="part" value="Unlimited" onclick="ShowHideDivPart()" class="radio-col-pink" />
                                    <label for="unlimited">UNLIMITED PARTICIPANT</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="numPart" name="numPart" value="0">
                    <input type="hidden" id="minAge" name="minAge" value="0">
                    <input type="hidden" id="active" name="active" value="0">
                    <input type="hidden" id="status" name="status" value="Pending">
                    <input type="hidden" id="numPart" name="numPart" value="0">
                    <input type="hidden" id="minAge" name="minAge" value="0">
                    <input type="hidden" id="active" name="active" value="1">
                    <div class="row clearfix" id="dvpart" style="display: none">
                        <div class="col-sm-2">
                            <label for="numPart">Maximum Participation</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="numPart" name="numPart" class="form-control" value=0 required="required" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="minAge">Minimum Age</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="minAge" name="minAge" class="form-control" value=0 required="required" />
                                </div>
                            </div>
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
