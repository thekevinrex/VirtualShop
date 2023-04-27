<div class="border border-gray-200 rounded-md dark:border-neutral-700 p-3 space-y-4 mb-5">
    <h4 class="text-lg font-semibold">
        @lang('product.information')
    </h4>

    <div class="flex flex-row justify-between">
        <span>@lang('product.id')</span>
        <span>{{ $product->id }}</span>
    </div>

    <div class="flex flex-row justify-between">
        <span>@lang('product.url')</span>
        <span>http://</span>
    </div>

    <div class="flex flex-row justify-between">
        <span>@lang('product.listening')</span>
        <span>-</span>
    </div>

    <div class="flex flex-row justify-between">
        <span>@lang('product.state')</span>
        <span>{{ $product->state }}</span>
    </div>
</div>