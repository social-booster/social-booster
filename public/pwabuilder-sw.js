// This is the service worker with the Cache-first network

const CACHE = "pwabuilder-precache";

importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js');


self.addEventListener("message", (event) => {
    if (event.data && event.data.type === "SKIP_WAITING") {
        self.skipWaiting();
    }
});
const reg=/^\/(document.*)?$/g

workbox.routing.registerRoute(
    reg,
    new workbox.strategies.CacheFirst({
    cacheName: CACHE
  })
);
