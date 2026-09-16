// Self-destructing and self-unregistering service worker
// Permanently fixes net::ERR_HTTP2_PROTOCOL_ERROR caused by legacy interception of assets
self.addEventListener('install', event => {
  self.skipWaiting();
});

self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(keys => Promise.all(keys.map(key => caches.delete(key))))
      .then(() => self.clients.claim())
      .then(() => self.registration.unregister())
  );
});

// Do not intercept fetch requests — allow the browser network layer to handle requests naturally
