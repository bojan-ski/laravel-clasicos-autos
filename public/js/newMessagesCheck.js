document.addEventListener('DOMContentLoaded', async function() {
    const notificationBadge = document.getElementById('message-notification-badge');
    const mobileNotificationBadge = document.getElementById('mobile-message-notification-badge');

    if (!notificationBadge) return;
    if (!mobileNotificationBadge) return;
    
    async function updateUnreadMessageBadge() {        
        try {
            const response = await fetch('/new_messages');
            
            if (!response.ok) {
                throw new Error('Network error!');
            }
            
            const data = await response.json();         
            
            if (data.count > 0) {
                notificationBadge.textContent = data.count;
                notificationBadge.classList.remove('hidden');

                mobileNotificationBadge.textContent = data.count;
                mobileNotificationBadge.classList.remove('hidden');
            } else {
                notificationBadge.classList.add('hidden');
                mobileNotificationBadge.classList.add('hidden');
            }
        } catch (error) {
            throw new Error('Network error!');
        }
    }
    
    await updateUnreadMessageBadge();
    
    setInterval(updateUnreadMessageBadge, 60000);
});