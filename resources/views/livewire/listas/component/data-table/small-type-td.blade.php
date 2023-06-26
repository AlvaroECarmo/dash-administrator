<small class="font-weight-bold">
    {{ $statusList[$typeId]['text'] }}
</small>
<div class="progress progress-sm" style="height: 2px">
    <div
        class="progress-bar {{ $statusList[$typeId]['color'] }}"
        role="progressbar" aria-valuenow="57"
        aria-valuemin="0" aria-valuemax="100"
        style="width: {!! $statusList[$typeId]['count'] !!} ">
    </div>
</div>
