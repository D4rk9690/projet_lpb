document.addEventListener('DOMContentLoaded', function() {
    // Show/Hide description box
    var showDescriptionButtons = document.getElementsByClassName('btn-show-description');
    Array.prototype.forEach.call(showDescriptionButtons, function(button) {
      button.addEventListener('click', function() {
        var houseId = this.getAttribute('data-house');
        var descriptionBox = document.querySelector('.description[data-house="' + houseId + '"]');
        descriptionBox.classList.toggle('show');
      });
    });
  
    // Handle reservation form submission
    var reservationForms = document.getElementsByClassName('reservation-form');
    Array.prototype.forEach.call(reservationForms, function(form) {
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        var houseId = this.querySelector('input[name="house_id"]').value;
        var reservationDate = this.querySelector('input[name="reservation_date"]').value;
        var confirmation = confirm("Do you want to save this date?");
        if (confirmation) {
          // Send reservation data to the server
          saveReservationDate(houseId, reservationDate);
        }
      });
    });
  
    // Function to save reservation date to the server
    function saveReservationDate(houseId, reservationDate) {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'save_reservation.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Reservation saved successfully
          alert('Reservation saved successfully!');
          location.reload();
        }
      };
      xhr.send('house_id=' + encodeURIComponent(houseId) + '&reservation_date=' + encodeURIComponent(reservationDate));
    }
  });
  