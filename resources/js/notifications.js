// Listen for order notifications
if (window.userId) {
    window.Echo.private(`App.User.${window.userId}`)
        .notification((notification) => {
            console.log('Notification received:', notification);
            
            // Update notification badge
            updateNotificationBadge();
            
            // Show toast notification (optional)
            showToast(notification);
        })
        .listen('.OrderCreate', (event) => {
            console.log('Order created event:', event);
            
            // Update notification badge
            updateNotificationBadge();
            
            // Show toast notification
            showToast({
                body: event.message,
                icon: 'fas fa-shopping-cart',
            });
        });
}

function updateNotificationBadge() {
    // Reload notification count
    fetch('/api/notifications/unread-count')
        .then(response => response.json())
        .then(data => {
            const badge = document.querySelector('.navbar-badge');
            if (badge) {
                if (data.count > 0) {
                    badge.textContent = data.count;
                    badge.style.display = 'inline-block';
                } else {
                    badge.style.display = 'none';
                }
            }
        })
        .catch(error => console.error('Error updating notification badge:', error));
}

function showToast(notification) {
    // Using toastr or custom toast implementation
    if (typeof toastr !== 'undefined') {
        toastr.info(notification.body, 'New Notification');
    } else {
        // Fallback to console
        console.log('New notification:', notification.body);
    }
}
