
const staticAssets = [
    './',
    './index.php',
    './assets/plugins/custom/datatables/datatables.bundle.css',
    './assets/plugins/custom/vis-timeline/vis-timeline.bundle.css',
    './assets/plugins/global/plugins.bundle.css',
    './assets/plugins/global/plugins.bundle.css',
    './assets/plugins/cropimage/ijaboCropTool.min.css',
    './assets/css/style.bundle.css',
    './vendor/laraberg/css/laraberg.css',
    './assets/icons/favicon.ico',
    './assets/plugins/global/plugins.bundle.js',
    './assets/js/scripts.bundle.js',
    './assets/plugins/custom/fslightbox/fslightbox.bundle.js',
    'https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700',
    './assets/plugins/custom/vis-timeline/vis-timeline.bundle.js',
    './assets/js/widgets.bundle.js',
    './assets/js/custom/widgets.js',
    './assets/js/custom/apps/chat/chat.js',
    './assets/js/custom/intro.js',
    './assets/plugins/custom/formrepeater/formrepeater.bundle.js',
    './assets/ckeditor5-34.1.0-esncw4a3vicc/build/ckeditor.js',
    './assets/mnjs/mnckeditorconfig.js',
    './assets/mnjs/mncomuns.js',
    './assets/plugins/react/react.production.min.js',
    './assets/plugins/axios/axios.min.js',
    './vendor/laraberg/js/laraberg.js'

];
const cacheName = "ParlamentoAO";
self.addEventListener('install', async e => {
    const cache = await caches.open(cacheName);
    await cache.addAll(staticAssets);
    return self.skipWaiting();
});

self.addEventListener('activate', e => {
    self.clients.claim();
});

self.addEventListener('fetch', async e => {
    const req = e.request;
    const url = new URL(req.url);

    if (url.origin === location.origin) {
        e.respondWith(cacheFirst(req));
    } else {
        e.respondWith(networkAndCache(req));
    }
});

async function cacheFirst(req) {
    const cache = await caches.open(cacheName);
    const cached = await cache.match(req);
    return cached || fetch(req);
}

async function networkAndCache(req) {
    const cache = await caches.open(cacheName);
    try {
        const fresh = await fetch(req);
        await cache.put(req, fresh.clone());
        return fresh;
    } catch (e) {
        const cached = await cache.match(req);
        return cached;
    }
}


/*
<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
<script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>

<script src="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('assets/js/custom/intro.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
<script src="{{ asset('assets/ckeditor5-34.1.0-esncw4a3vicc/build/ckeditor.js') }}"></script>
{{--<script src="{{ asset('assets/mnjs/mnckeditorconfig.js') }}"></script>--}}
<script src="{{ asset('assets/mnjs/mncomuns.js') }}"></script>
<script src="{{ asset('assets/plugins/react/react.production.min.js') }}"></script>
<script src="{{ asset('assets/plugins/react/react-dom.production.min.js') }}"></script>
<script src="{{ asset('assets/plugins/axios/axios.min.js') }}"></script>
<script src="{{ asset('translateGoogle/element.js') }}"></script>
<script src="{{ asset('translateGoogle/m=el_main.js') }}"></script>
<script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
 */
