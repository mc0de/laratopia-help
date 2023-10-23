<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('marketResearch.title') ? 'invalid' : '' }}">
        <label class="form-label" for="title">{{ trans('cruds.marketResearch.fields.title') }}</label>
        <input class="form-control" type="text" name="title" id="title" wire:model.defer="marketResearch.title">
        <div class="validation-message">
            {{ $errors->first('marketResearch.title') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.marketResearch.fields.title_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('marketResearch.details') ? 'invalid' : '' }}">
        <label class="form-label" for="details">{{ trans('cruds.marketResearch.fields.details') }}</label>
        <textarea class="form-control" name="details" id="details" wire:model.defer="marketResearch.details" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('marketResearch.details') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.marketResearch.fields.details_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('marketResearch.team_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="team">{{ trans('cruds.marketResearch.fields.team') }}</label>
        <x-select-list class="form-control" required id="team" name="team" :options="$this->listsForFields['team']" wire:model="marketResearch.team_id" />
        <div class="validation-message">
            {{ $errors->first('marketResearch.team_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.marketResearch.fields.team_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.market-researchs.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>