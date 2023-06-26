<div class="mb-3">


    <table id="kt_datatable_example_6" class="table table-striped border rounded gy-5 gs-7">
        <thead>
        <tr class="fw-bolder fs-6 text-gray-800 px-7">
            <th class="min-w-300px" data-priority="1">Name</th>
            <th class="min-w-300px">Position</th>
            <th class="min-w-300px">Salary</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
        </tr>
        <tr>
            <td>Garrett Winters</td>
            <td>Accountant</td>
            <td>Tokyo</td>
        </tr>
        </tbody>
    </table>


</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
            })
            Livewire.hook('element.initialized', (el, component) => {
            })
            Livewire.hook('element.updating', (fromEl, toEl, component) => {
            })
            Livewire.hook('element.updated', (el, component) => {
            })
            Livewire.hook('element.removed', (el, component) => {
            })
            Livewire.hook('message.sent', (message, component) => {
            })
            Livewire.hook('message.failed', (message, component) => {
            })
            Livewire.hook('message.received', (message, component) => {
            })
            Livewire.hook('message.processed', (message, component) => {
                initSelector();
            })
        });

        "use strict";
        var KTDatatablesAdvanced = {
            init: function () {
                var t, e;
                t = {
                    1: {title: "Pending", state: "primary"},
                    2: {title: "Delivered", state: "danger"},
                    3: {title: "Canceled", state: "primary"},
                    4: {title: "Success", state: "success"},
                    5: {title: "Info", state: "info"},
                    6: {title: "Danger", state: "danger"},
                    7: {title: "Warning", state: "warning"}
                }, $("#kt_datatable_example_1").DataTable({
                    columnDefs: [{
                        render: function (e, a, n) {
                            var l = KTUtil.getRandomInt(1, 7);
                            return e + '<span class="ms-2 badge badge-light-' + t[l].state + ' fw-bold">' + t[l].title + "</span>"
                        }, targets: 1
                    }]
                }), $("#kt_datatable_example_2").DataTable({
                    columnDefs: [{
                        visible: !1,
                        targets: -1
                    }]
                }), e = $("#kt_datatable_example_3").DataTable({
                    columnDefs: [{visible: !1, targets: 2}],
                    order: [[2, "asc"]],
                    displayLength: 25,
                    drawCallback: function (t) {
                        var e = this.api(), a = e.rows({page: "current"}).nodes(), n = null;
                        e.column(2, {page: "current"}).data().each((function (t, e) {
                            n !== t && ($(a).eq(e).before('<tr class="group fs-5 fw-bolder"><td colspan="5">' + t + "</td></tr>"), n = t)
                        }))
                    }
                }), function () {
                    var t = {
                        1: {title: "Pending", state: "primary"},
                        2: {title: "Delivered", state: "danger"},
                        3: {title: "Canceled", state: "primary"},
                        4: {title: "Success", state: "success"},
                        5: {title: "Info", state: "info"},
                        6: {title: "Danger", state: "danger"},
                        7: {title: "Warning", state: "warning"}
                    };
                    $("#kt_datatable_example_6").DataTable({
                        language: {lengthMenu: "Show _MENU_"},
                        dom: "<'row'<'col-sm-6 d-flex align-items-center justify-conten-start'l><'col-sm-6 d-flex align-items-center justify-content-end'f>><'table-responsive'tr><'row'<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i><'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>>",
                        responsive: !0, columnDefs: [{
                            render: function (e, a, n) {
                                var l = KTUtil.getRandomInt(1, 7);
                                return e + '<span class="ms-2 badge badge-light-' + t[l].state + ' fw-bold">' + t[l].title + "</span>"
                            }, targets: 1
                        }]
                    })
                }(), $("#kt_datatable_example_7").DataTable({select: !0})
            }
        };

        KTUtil.onDOMContentLoaded((function () {
            KTDatatablesAdvanced.init()
        }));
    </script>
@endpush
