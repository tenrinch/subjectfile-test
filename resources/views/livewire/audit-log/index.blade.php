<div>
    <div class="pb-4">
        <div class="flex flex-row">
            <select wire:model="perPage" class="appearance-none h-full border-l rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none  bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                @foreach($paginationOptions as $value)
                <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
            <input placeholder="Search" class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-3 py-1 w-1/4 bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"  wire:model.debounce.300ms="search"/>

        </div>
    </div>
     <div wire:loading.delay>
        Loading...
    </div>
    <table class="w-full text-sm bg-white mt-3">
        <thead>
            <tr class="uppercase text-left text-gray-900 bg-gray-200 border-t border-b border-gray-600">
                <th class="pl-4 py-3 text-sm border-r">#</td>
                <th class="px-2 py-3 text-sm border-r">
                    {{ trans('cruds.auditLog.fields.id') }}
                    @include('components.table.sort', ['field' => 'id'])
                </th>
                <th class="px-2 py-3 text-sm border-r">
                    {{ trans('cruds.auditLog.fields.description') }}
                    @include('components.table.sort', ['field' => 'description'])
                </th>
                <th class="px-2 py-3 text-sm border-r text-center">
                    {{ trans('cruds.auditLog.fields.subject_id') }}
                    @include('components.table.sort', ['field' => 'subject_id'])
                </th>
                <th class="px-2 py-3 text-sm border-r">
                    {{ trans('cruds.auditLog.fields.subject_type') }}
                    @include('components.table.sort', ['field' => 'subject_type'])
                </th>
                <th class="px-2 py-3 text-sm border-r">
                    {{ trans('cruds.auditLog.fields.user_id') }}
                    @include('components.table.sort', ['field' => 'user_id'])
                </th>
                <th class="px-2 py-3 text-sm border-r">
                    {{ trans('cruds.auditLog.fields.host') }}
                    @include('components.table.sort', ['field' => 'host'])
                </th>
                <th class="px-2 py-3 text-sm border-r">
                    {{ trans('cruds.auditLog.fields.created_at') }}
                    @include('components.table.sort', ['field' => 'created_at'])
                </th>
            </tr>
        </thead>
        <tbody class="bodyig">
            @forelse($auditLogs as $auditLog)
            <tr>
                <td class="pl-4 py-2 text-sm border-b">
                    <input type="checkbox" value="{{ $auditLog->id }}" wire:model="selected">
                </td>
                <td class="px-2 py-2 text-sm border-b">
                    {{ $auditLog->id }}
                </td>
                <td class="px-2 py-2 text-sm border-b">
                    {{ $auditLog->description }}
                </td>
                <td class="px-2 py-2 text-sm border-b text-center">
                    <a href="{{$auditLog->link}}">  
                        {{ $auditLog->subject_id }}
                    </a>
                </td>
                <td class="px-2 py-2 text-sm border-b">
                    {{ $auditLog->subject_type }}
                </td>
                <td  class="px-2 py-2 text-sm border-b">
                    {{ $auditLog->user->name }}
                </td>
                <td class="px-2 py-2 text-sm border-b">
                    {{ $auditLog->host }}
                </td>
                <td class="px-2 py-2 text-sm border-b">
                    {{ $auditLog->created_at }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10">No entries found.</td>
            </tr>
            @endforelse
                
        </tbody>
    </table>
    {{ $auditLogs->links() }}
</div>