@if($isManager && !$isDRH)
    <small class="font-weight-norma text-sm">
        Pendente no Director
    </small>
    <div class="progress progress-sm" style="height: 2px">
        <div
            class="progress-bar bg-success"
            role="progressbar" aria-valuenow="57"
            aria-valuemin="0" aria-valuemax="100"
            style="width: 45% ">
        </div>
    </div>
@endif
@if($isDRH)
    <small class="font-weight-normal text-sm">
        Pendente na D.R.H
    </small>
    <div class="progress progress-sm" style="height: 2px">
        <div
            class="progress-bar bg-primary"
            role="progressbar" aria-valuenow="57"
            aria-valuemin="0" aria-valuemax="100"
            style="width: 90% ">
        </div>
    </div>
@endif

