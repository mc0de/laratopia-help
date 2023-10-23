<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('system.title') ? 'invalid' : '' }}">
        <label class="form-label required" for="title">{{ trans('cruds.system.fields.title') }}</label>
        <input class="form-control" type="text" name="title" id="title" required wire:model.defer="system.title">
        <div class="validation-message">
            {{ $errors->first('system.title') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.system.fields.title_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('system.details') ? 'invalid' : '' }}">
        <label class="form-label" for="details">{{ trans('cruds.system.fields.details') }}</label>
        <textarea class="form-control" name="details" id="details" wire:model.defer="system.details" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('system.details') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.system.fields.details_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('system.team_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="team">{{ trans('cruds.system.fields.team') }}</label>
        <x-select-list class="form-control" required id="team" name="team" :options="$this->listsForFields['team']" wire:model="system.team_id" />
        <div class="validation-message">
            {{ $errors->first('system.team_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.system.fields.team_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.systems.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>