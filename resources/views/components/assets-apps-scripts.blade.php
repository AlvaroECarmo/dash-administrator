<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
<script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('assets/js/custom/intro.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
<script src="{{ asset('assets/ckeditor5-34.1.0-esncw4a3vicc/build/ckeditor.js') }}"></script>
<script src="{{ asset('assets/mnjs/mncomuns.js') }}"></script>
<script src="{{ asset('assets/plugins/react/react.production.min.js') }}"></script>
<script src="{{ asset('assets/plugins/react/react-dom.production.min.js') }}"></script>
<script src="{{ asset('assets/plugins/axios/axios.min.js') }}"></script>
{{--<script src="{{ asset('translateGoogle/element.js') }}"></script>
<script src="{{ asset('translateGoogle/m=el_main.js') }}"></script>--}}
<script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{asset('assets/plugins/cropimage/ijaboCropTool.min.js')}}"></script>
<script src="{{asset('')}}assets/cropper/edit/cropper.js"></script>
@livewireScripts
@yield('third_party_scripts')
@stack('page_scripts')
@stack('scripts')
