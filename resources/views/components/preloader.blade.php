@props(['size', 'color', 'border' => '', 'wraper' => 'full'])

@if (in_array($wraper, ['full']))
<div class="preloader-wraper">
@endif
    <div class="preloader {{ $size }}" {{ $attributes }} >
        <div class="spinner-layer {{ $color }}">

            <div class="circle-clipper {{ $border }} left">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper {{ $border }} right">
                <div class="circle"></div>
            </div>

        </div>
    </div>
@if (in_array($wraper, ['full']))
</div>
@endif