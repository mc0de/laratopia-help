<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('ad.project_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="project">{{ trans('cruds.ad.fields.project') }}</label>
        <x-select-list class="form-control" required id="project" name="project" :options="$this->listsForFields['project']" wire:model="ad.project_id" />
        <div class="validation-message">
            {{ $errors->first('ad.project_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.ad.fields.project_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('ad.title') ? 'invalid' : '' }}">
        <label class="form-label" for="title">{{ trans('cruds.ad.fields.title') }}</label>
        <input class="form-control" type="text" name="title" id="title" wire:model.defer="ad.title">
        <div class="validation-message">
            {{ $errors->first('ad.title') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.ad.fields.title_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('ad.content') ? 'invalid' : '' }}">
        <label class="form-label" for="content">{{ trans('cruds.ad.fields.content') }}</label>
        <input class="form-control" type="text" name="content" id="content" wire:model.defer="ad.content">
        <div class="validation-message">
            {{ $errors->first('ad.content') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.ad.fields.content_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('category') ? 'invalid' : '' }}">
        <label class="form-label" for="category">{{ trans('cruds.ad.fields.category') }}</label>
        <x-select-list class="form-control" id="category" name="category" wire:model="category" :options="$this->listsForFields['category']" multiple />
        <div class="validation-message">
            {{ $errors->first('category') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.ad.fields.category_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.ad_file') ? 'invalid' : '' }}">
        <label class="form-label" for="file">{{ trans('cruds.ad.fields.file') }}</label>
        <x-dropzone id="file" name="file" action="{{ route('admin.ads.storeMedia') }}" collection-name="ad_file" max-file-size="10" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.ad_file') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.ad.fields.file_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('ad.statues') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.ad.fields.statues') }}</label>
        @foreach($this->listsForFields['statues'] as $key => $value)
            <label class="radio-label"><input type="radio" name="statues" wire:model="ad.statues" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('ad.statues') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.ad.fields.statues_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('ad.team_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="team">{{ trans('cruds.ad.fields.team') }}</label>
        <x-select-list class="form-control" required id="team" name="team" :options="$this->listsForFields['team']" wire:model="ad.team_id" />
        <div class="validation-message">
            {{ $errors->first('ad.team_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.ad.fields.team_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.ads.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>