<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('website.title') ? 'invalid' : '' }}">
        <label class="form-label" for="title">{{ trans('cruds.website.fields.title') }}</label>
        <input class="form-control" type="text" name="title" id="title" wire:model.defer="website.title">
        <div class="validation-message">
            {{ $errors->first('website.title') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.website.fields.title_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('website.details') ? 'invalid' : '' }}">
        <label class="form-label" for="details">{{ trans('cruds.website.fields.details') }}</label>
        <textarea class="form-control" name="details" id="details" wire:model.defer="website.details" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('website.details') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.website.fields.details_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('website.team_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="team">{{ trans('cruds.website.fields.team') }}</label>
        <x-select-list class="form-control" required id="team" name="team" :options="$this->listsForFields['team']" wire:model="website.team_id" />
        <div class="validation-message">
            {{ $errors->first('website.team_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.website.fields.team_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.websites.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>