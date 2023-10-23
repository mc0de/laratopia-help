<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('motion.title') ? 'invalid' : '' }}">
        <label class="form-label" for="title">{{ trans('cruds.motion.fields.title') }}</label>
        <input class="form-control" type="text" name="title" id="title" wire:model.defer="motion.title">
        <div class="validation-message">
            {{ $errors->first('motion.title') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.motion.fields.title_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('motion.details') ? 'invalid' : '' }}">
        <label class="form-label" for="details">{{ trans('cruds.motion.fields.details') }}</label>
        <textarea class="form-control" name="details" id="details" wire:model.defer="motion.details" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('motion.details') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.motion.fields.details_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('motion.minuts') ? 'invalid' : '' }}">
        <label class="form-label" for="minuts">{{ trans('cruds.motion.fields.minuts') }}</label>
        <input class="form-control" type="text" name="minuts" id="minuts" wire:model.defer="motion.minuts">
        <div class="validation-message">
            {{ $errors->first('motion.minuts') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.motion.fields.minuts_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('motion.team_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="team">{{ trans('cruds.motion.fields.team') }}</label>
        <x-select-list class="form-control" required id="team" name="team" :options="$this->listsForFields['team']" wire:model="motion.team_id" />
        <div class="validation-message">
            {{ $errors->first('motion.team_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.motion.fields.team_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.motions.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>