jQuery(document).ready(function () {
    jQuery("#contactUsForm").validate({
        errorLabelContainer: $("#note div.error"),
        rules: {
            message:{
                required:true,
                minlength:15
            }
        }

    });
    displayUploadOption();
    loadGoogleMap();
});

function displayUploadOption() {
    var category = jQuery("#category").val();
    if (category == 'Jobs') {
        jQuery("#uploadResumeDiv").css('display', '');
        jQuery('#resume').addClass('required');
    } else {
        jQuery('#resume').removeClass('required');
        jQuery("#uploadResumeDiv").css('display', 'none');
    }
}

function loadGoogleMap() {
    var lat = 28.543409330780815;  //28.607460;
    var lng = 77.40480780601501;//77.40480780601501
    var initialLocation = new google.maps.LatLng(lat, lng);
    var myOptions = {
        zoom:15,
        center:initialLocation,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    var googleMap = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    createMarkerAndInfoWindowForLocation(initialLocation, 'Intelligrape Software', googleMap, igImageMapUrl);

}
function createMarkerAndInfoWindowForLocation(location, content, map, icon) {
    if (!map) {
        map = googleMap;
    }
    var marker = new google.maps.Marker({map:map, position:location});
    if (icon && icon.length) {
        marker.setIcon(icon);
    }
    var infoWindow = new google.maps.InfoWindow({
        content:content,
        size:new google.maps.Size(60, 130)
    });
    google.maps.event.addListener(marker, 'click', function () {
        infoWindow.open(map, marker);
    });
    return {marker:marker, infoWindow:infoWindow}
}
