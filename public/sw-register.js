if ('serviceWorker' in navigator) {
    console.log('Service Worker');
    navigator.serviceWorker.register('pwabuilder-sw.js')
        .then(function(swReg) {
            const ignore = ['/login', '/register', '/logout'];
            if (ignore.includes(location.pathname)) {
                swReg.unregister()
            }
            console.log('Service Worker is registered', swReg)
        })
        .catch(function(error) {
            console.error('Service Worker Error', error)
        })
}
