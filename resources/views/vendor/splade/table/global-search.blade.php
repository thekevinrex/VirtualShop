<div class="relative flex flex-row items-center bg-white dark:bg-neutral-700">

    <label for="searchInput-global" class="pl-3 hidden sm:flex items-center shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
    </label>

    <input
      class="dark:bg-neutral-700 dark:text-gray-200 h-14 w-full appearance-none rounded-md border-none px-3 py-2 text-gray-900 focus:outline-none focus:border-none focus:shadow-none focus:ring-0 sm:text-sm"
      placeholder="{{ $table->searchInputs('global')->label }}"
      value="{{ $table->searchInputs('global')->value }}"
      id="searchInput-global"
      type="text"
      name="searchInput-global"
      v-bind:class="{ 'opacity-50': table.isLoading }"
      v-bind:disabled="table.isLoading"
      @input="table.debounceUpdateQuery('filter[global]', $event.target.value, $event.target)"
    >
    
</div>