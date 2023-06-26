<small class="font-weight-normal">
    {{ $stadoJustificacao[$statusId]['text'] }}
</small>
<div class="progress progress-sm" style="height: 2px">
    <div
        class="progress-bar {{ $stadoJustificacao[$statusId]['color'] }}"
        role="progressbar" aria-valuenow="57"
        aria-valuemin="0" aria-valuemax="100"
        style="width: {!! $stadoJustificacao[$statusId]['count'] !!} ">
    </div>
</div>
