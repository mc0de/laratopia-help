<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('design.project_id') ? 'invalid' : '' }}">
        <label class="form-label" for="project">{{ trans('cruds.design.fields.project') }}</label>
        <x-select-list class="form-control" id="project" name="project" :options="$this->listsForFields['project']" wire:model="design.project_id" />
        <div class="validation-message">
            {{ $errors->first('design.project_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.design.fields.project_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('design.post_id') ? 'invalid' : '' }}">
        <label class="form-label" for="post">{{ trans('cruds.design.fields.post') }}</label>
        <x-select-list class="form-control" id="post" name="post" :options="$this->listsForFields['post']" wire:model="design.post_id" />
        <div class="validation-message">
            {{ $errors->first('design.post_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.design.fields.post_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.design_design') ? 'invalid' : '' }}">
        <label class="form-label required" for="design">{{ trans('cruds.design.fields.design') }}</label>
        <x-dropzone id="design" name="design" action="{{ route('admin.designs.storeMedia') }}" collection-name="design_design" max-file-size="5" max-width="1200" max-height="630" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.design_design') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.design.fields.design_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('design.statues') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.design.fields.statues') }}</label>
        @foreach($this->listsForFields['statues'] as $key => $value)
            <label class="radio-label"><input type="radio" name="statues" wire:model="design.statues" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('design.statues') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.design.fields.statues_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('design.confirmation') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.design.fields.confirmation') }}</label>
        @foreach($this->listsForFields['confirmation'] as $key => $value)
            <label class="radio-label"><input type="radio" name="confirmation" wire:model="design.confirmation" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('design.confirmation') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.design.fields.confirmation_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('design.note') ? 'invalid' : '' }}">
        <label class="form-label" for="note">{{ trans('cruds.design.fields.note') }}</label>
        <input class="form-control" type="text" name="note" id="note" wire:model.defer="design.note">
        <div class="validation-message">
            {{ $errors->first('design.note') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.design.fields.note_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('design.review') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.design.fields.review') }}</label>
        @foreach($this->listsForFields['review'] as $key => $value)
            <label class="radio-label"><input type="radio" name="review" wire:model="design.review" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('design.review') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.design.fields.review_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('design.team_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="team">{{ trans('cruds.design.fields.team') }}</label>
        <x-select-list class="form-control" required id="team" name="team" :options="$this->listsForFields['team']" wire:model="design.team_id" />
        <div class="validation-message">
            {{ $errors->first('design.team_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.design.fields.team_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.designs.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>