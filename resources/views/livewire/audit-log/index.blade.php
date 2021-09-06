<div>
    <div class="">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('audit_log_delete')
            <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                {{ __('Delete Selected') }}
            </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
            <livewire:excel-export model="AuditLog" format="csv" />
            <livewire:excel-export model="AuditLog" format="xlsx" />
            <livewire:excel-export model="AuditLog" format="pdf" />
            @endif


        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="w-full sm:w-1/3 inline-block" />
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
</div>