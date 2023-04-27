<x-modules.container class="container">

    <x-modules.title style="top:10%; left:5%" />
    <x-modules.des style="top:calc(10% + 50px); left:55%" />


    <x-modules.image style="top:calc(10% + 50px); left:2%" class="w-1/2 h-20">
        @choice('product.image', 0)
    </x-modules.image>


</x-modules.container>
<span>
    @lang('product.title') + @lang('product.des') + @choice('product.image', 0) (@lang('product.left'))
</span>