@props(['size', 'color', 'border'])

<div class="preloader-wraper">
    <div class="preloader {{ $size }}">
        <div class="spinner-layer {{ $color }}">

            <div class="circle-clipper {{ $border }} left">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper {{ $border }} right">
                <div class="circle"></div>
            </div>

        </div>
    </div>
</div>