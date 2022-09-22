<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>         
    function geolocation(){
    var latitude;
    var longitude;

    if (!navigator.geolocation){ 
                    $('#Adlocation').text('no-browser-support');		            
    }
    else {
        navigator.geolocation.getCurrentPosition(function(position){
            // Get the coordinates of the current possition.
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            latitude = JSON.stringify(pos['lat']);
            longitude = JSON.stringify(pos['lng']);
                
            //window.location.href = 'logT.php?latitude=' + latitude + '&longitude=' + longitude; 
            console.log(pos);
        }, function(){               
                            $('#Adlocation').text('User denied Geolocation');
            console.log('message: User denied Geolocation');            
        });
    }
            return latitude;
    } 	
    geolocation();
</script>

<div id='Adlocation'></div>














