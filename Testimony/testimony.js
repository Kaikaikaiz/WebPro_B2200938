document.addEventListener("DOMContentLoaded", function() {
    fetch("testimony.php")
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error('Error', data.error);
        } else {
            updateDisplay(data.testimony);
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
    });
});

function updateDisplay(testimony) {
    var testimonyList = $('#testimonies');
    testimonyList.empty();
    testimony.forEach(function(testimony) {
        var listItem = '<div class="testimony"><p>' + testimony + '</p></div>';
        testimonyList.append(listItem);
    });
}

