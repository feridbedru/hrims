<h6 class="ml-2">Fields denoted with <span class="text-danger">*</span> are required.</h6>
<hr>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name" class="col-md-12 control-label">Organization Location Name <span class="text-danger">*</span></label>
            <div class="col-md-12">
                <input class="form-control" name="name" type="text" id="name"
                    value="{{ old('name', optional($organizationLocation)->name) }}" minlength="1" maxlength="255"
                    required="true" placeholder="Enter name here...">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name" class="col-md-12 control-label">Address <span class="text-danger">*</span></label>
            <div class="col-md-12">
                <input class="form-control" name="address" type="text" id="address"
                    value="{{ old('address', optional($organizationLocation)->address) }}" minlength="1"
                    maxlength="255" required="true" placeholder="Enter address here...">
            </div>
        </div>
    </div>
</div>
<div class="form-group {{ $errors->has('cordinates') ? 'has-error' : '' }}">
    <label for="cordinates" class="col-md-12 control-label">Cordinates</label>
    <div class="col-md-12">
        <input class="form-control" name="cordinates" type="text" id="cordinates"
            value="{{ old('cordinates', optional($organizationLocation)->cordinates) }}" minlength="1"
            placeholder="Enter cordinates here...">
    </div>
</div>
<div>	<style>
    #myMap {
       height: 350px;
       width: 680px;
    }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?AIzaSyDpBITI6kuOs7Xo2K2Pbxe8YAZUEda0jPU&sensor=false">
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
    </script>
    <script type="text/javascript"> 
    var map;
    var marker;
    var myLatlng = new google.maps.LatLng(20.268455824834792,85.84099235520011);
    var geocoder = new google.maps.Geocoder();
    var infowindow = new google.maps.InfoWindow();
    function initialize(){
    var mapOptions = {
    zoom: 18,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    map = new google.maps.Map(document.getElementById("myMap"), mapOptions);
    
    marker = new google.maps.Marker({
    map: map,
    position: myLatlng,
    draggable: true 
    }); 
    
    geocoder.geocode({'latLng': myLatlng }, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
    if (results[0]) {
    $('#latitude,#longitude').show();
    $('#address').val(results[0].formatted_address);
    $('#latitude').val(marker.getPosition().lat());
    $('#longitude').val(marker.getPosition().lng());
    infowindow.setContent(results[0].formatted_address);
    infowindow.open(map, marker);
    }
    }
    });
    
    google.maps.event.addListener(marker, 'dragend', function() {
    
    geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
    if (results[0]) {
    $('#address').val(results[0].formatted_address);
    $('#latitude').val(marker.getPosition().lat());
    $('#longitude').val(marker.getPosition().lng());
    infowindow.setContent(results[0].formatted_address);
    infowindow.open(map, marker);
    }
    }
    });
    });
    
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <div id="myMap"></div>
    <input id="address" type="text" style="width:600px;"/><br/>
    <input type="text" id="latitude" name="latitude" placeholder="Latitude"/>
    <input type="text" id="longitude" name="longitude" placeholder="Longitude"/>