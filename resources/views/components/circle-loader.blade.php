@props(['size', 'color', 'border'])

<div class="circle-preloader-wraper">
    <div class="circle-preloader {{ $size . " " . $color . " " . $border }}" style="--progress-fill:180deg;">
        <div class="mask full">
            <div class="fill"></div>
        </div>
        <div class="mask">
            <div class="fill"></div>
        </div>
        <div class="inside">{{ $slot }}</div>
    </div>
</div>';