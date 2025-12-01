(function($){
    $('.item-quantity').on('change', function(e) {
        const $input = $(this);
        const id = $input.data('id');
        const quantity = $input.val();

        $.ajax({
            url: `/card/${id}`,
            method: 'PUT',
            data: {
                quantity: quantity,
                _token: csrf_token,
            },
            success: function(response) {
                console.log('Cart updated successfully');
                // Optionally reload the page or update the UI
                location.reload();
            },
            error: function(xhr) {
                console.error('Error updating cart:', xhr);
                alert('Failed to update cart. Please try again.');
            }
        });
    });
})(jQuery);







