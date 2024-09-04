document.addEventListener('DOMContentLoaded', function() {
    // Function to show toast
    function showToast() {
        var toastEl = document.getElementById('purchaseToast');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    }

    // Add event listener to the "Beli" button
    var buyButtons = document.querySelectorAll('.buy-btn');
    buyButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var carModel = button.getAttribute('data-car-model');
            var carPrice = button.getAttribute('data-car-price');

            var modal = document.getElementById('buyModal');
            var carModelInput = modal.querySelector('#carModel');
            var carPriceInput = modal.querySelector('#carPrice');
            
            carModelInput.value = carModel;
            carPriceInput.value = carPrice;
        });
    });

    var purchaseForm = document.getElementById('purchaseForm');
    purchaseForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent actual form submission

        showToast(); // Show the toast notification

        // Reset the form without closing the modal
        purchaseForm.reset();

        // Ensure modal remains open
        var buyModal = bootstrap.Modal.getInstance(document.getElementById('buyModal'));
        if (buyModal) {
            buyModal.show(); // Keep modal open
        }
    });
});
