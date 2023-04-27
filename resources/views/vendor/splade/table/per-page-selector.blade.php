<select
    name="per_page"
    class="block bg-white dark:bg-neutral-700 dark:border-neutral-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 min-w-max text-sm border-gray-300 rounded-md"
    @change="table.updateQuery('perPage', $event.target.value)"
  >
    @foreach($table->allPerPageOptions() as $perPage)
        <option value="{{ $perPage }}" @selected($perPage === $table->perPage())>
            {{ $perPage }} {{ trans('splade.per_page') }}
        </option>
    @endforeach
</select>