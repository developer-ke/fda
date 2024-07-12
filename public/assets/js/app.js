var term = document.getElementById("lostTerm");
var btn = document.getElementById("lbtn");
term.addEventListener("click", function () {
    if (term.checked) {
        btn.disabled = false;
    } else {
        btn.disabled = true;
    }
});
if (document.querySelector(".found-container")) {
    var fterm = document.querySelector("#fterm");
    var subBtn = document.querySelector("#fsubmit");
    fterm.addEventListener("click", function () {
        if (fterm.checked) {
            subBtn.disabled = false;
        } else {
            subBtn.disabled = true;
        }
    });

    document.querySelector(".GeoLocationBtn").addEventListener("click", (e) => {
        e.preventDefault();
        // Check if Geolocation is supported by the browser
        if (navigator.geolocation) {
            // Get the current position
            navigator.geolocation.getCurrentPosition(function (position) {
                var lat = position.coords.latitude;
                var long = position.coords.longitude;

                // Do something with the latitude and longitude
                document.querySelector("#latitude").value = lat;
                document.querySelector("#longitude").value = long;
                // Now you can assign these values to your elements or variables as needed
                document.querySelector(".flocation").value = lat + "," + long;
            });
        } else {
            Swal.fire({
                title: "This form uses your location, please allow your device to access your location",
                showClass: {
                    popup: `
                         animate__animated
                         animate__fadeInUp
                         animate__faster`,
                },
                hideClass: {
                    popup: `
                         animate__animated
                         animate__fadeOutDown
                         animate__faster`,
                },
            });
        }
    });
}
