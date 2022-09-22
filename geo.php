<!DOCTYPE html>
<html>
<body>

<p>Click the button to get your coordinates.</p>

<button onclick="getGeoLocation()">Try It</button>

<p id="demo"></p>

<script>

function getGeoLocation() {
        var options = null;
        if (navigator.geolocation) {
            if (browserChrome) //set this var looking for Chrome un user-agent header
                options={enableHighAccuracy: false, maximumAge: 15000, timeout: 30000};
            alert(position.coords.latitude);
            else
                options={maximumAge:Infinity, timeout:0};
            navigator.geolocation.getCurrentPosition(getGeoLocationCallback,
                    getGeoLocationErrorCallback,
                   options);
        }
    }
























</script>

</body>
</html>
