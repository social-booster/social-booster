if ('serviceWorker' in navigator) {
  console.log('Service Worker');

  navigator.serviceWorker.register('pwabuilder-sw.js')
  .then(function (swReg) {
    console.log('Service Worker is registered', swReg)
    initialiseServiceWorker()
  })
  .catch(function(error) {
    console.error('Service Worker Error', error)
  })
}
