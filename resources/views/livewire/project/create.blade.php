<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('project.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.project.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="project.name">
        <div class="validation-message">
            {{ $errors->first('project.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.project.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('project.owner_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="owner">{{ trans('cruds.project.fields.owner') }}</label>
        <x-select-list class="form-control" required id="owner" name="owner" :options="$this->listsForFields['owner']" wire:model="project.owner_id" />
        <div class="validation-message">
            {{ $errors->first('project.owner_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.project.fields.owner_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('package') ? 'invalid' : '' }}">
        <label class="form-label required" for="package">{{ trans('cruds.project.fields.package') }}</label>
        <x-select-list class="form-control" required id="package" name="package" wire:model="package" :options="$this->listsForFields['package']" multiple />
        <div class="validation-message">
            {{ $errors->first('package') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.project.fields.package_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('project.start_date') ? 'invalid' : '' }}">
        <label class="form-label required" for="start_date">{{ trans('cruds.project.fields.start_date') }}</label>
        <x-date-picker class="form-control" required wire:model="project.start_date" id="start_date" name="start_date" picker="date" />
        <div class="validation-message">
            {{ $errors->first('project.start_date') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.project.fields.start_date_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('project.end_date') ? 'invalid' : '' }}">
        <label class="form-label required" for="end_date">{{ trans('cruds.project.fields.end_date') }}</label>
        <x-date-picker class="form-control" required wire:model="project.end_date" id="end_date" name="end_date" picker="date" />
        <div class="validation-message">
            {{ $errors->first('project.end_date') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.project.fields.end_date_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('project.statues') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.project.fields.statues') }}</label>
        @foreach($this->listsForFields['statues'] as $key => $value)
            <label class="radio-label"><input type="radio" name="statues" wire:model="project.statues" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('project.statues') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.project.fields.statues_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('assignees') ? 'invalid' : '' }}">
        <label class="form-label required" for="assignees">{{ trans('cruds.project.fields.assignees') }}</label>
        <x-select-list class="form-control" required id="assignees" name="assignees" wire:model="assignees" :options="$this->listsForFields['assignees']" multiple />
        <div class="validation-message">
            {{ $errors->first('assignees') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.project.fields.assignees_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('project.team_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="team">{{ trans('cruds.project.fields.team') }}</label>
        <x-select-list class="form-control" required id="team" name="team" :options="$this->listsForFields['team']" wire:model="project.team_id" />
        <div class="validation-message">
            {{ $errors->first('project.team_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.project.fields.team_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
