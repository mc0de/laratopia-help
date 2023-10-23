<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('video.project_id') ? 'invalid' : '' }}">
        <label class="form-label" for="project">{{ trans('cruds.video.fields.project') }}</label>
        <x-select-list class="form-control" id="project" name="project" :options="$this->listsForFields['project']" wire:model="video.project_id" />
        <div class="validation-message">
            {{ $errors->first('video.project_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.video.fields.project_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('video.post_id') ? 'invalid' : '' }}">
        <label class="form-label" for="post">{{ trans('cruds.video.fields.post') }}</label>
        <x-select-list class="form-control" id="post" name="post" :options="$this->listsForFields['post']" wire:model="video.post_id" />
        <div class="validation-message">
            {{ $errors->first('video.post_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.video.fields.post_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.video_video') ? 'invalid' : '' }}">
        <label class="form-label required" for="video">{{ trans('cruds.video.fields.video') }}</label>
        <x-dropzone id="video" name="video" action="{{ route('admin.videos.storeMedia') }}" collection-name="video_video" max-file-size="25" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.video_video') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.video.fields.video_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('category') ? 'invalid' : '' }}">
        <label class="form-label" for="category">{{ trans('cruds.video.fields.category') }}</label>
        <x-select-list class="form-control" id="category" name="category" wire:model="category" :options="$this->listsForFields['category']" multiple />
        <div class="validation-message">
            {{ $errors->first('category') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.video.fields.category_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('video.status') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.video.fields.status') }}</label>
        @foreach($this->listsForFields['status'] as $key => $value)
            <label class="radio-label"><input type="radio" name="status" wire:model="video.status" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('video.status') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.video.fields.status_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('video.confirmation') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.video.fields.confirmation') }}</label>
        @foreach($this->listsForFields['confirmation'] as $key => $value)
            <label class="radio-label"><input type="radio" name="confirmation" wire:model="video.confirmation" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('video.confirmation') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.video.fields.confirmation_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('video.notes') ? 'invalid' : '' }}">
        <label class="form-label" for="notes">{{ trans('cruds.video.fields.notes') }}</label>
        <textarea class="form-control" name="notes" id="notes" wire:model.defer="video.notes" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('video.notes') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.video.fields.notes_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('video.review') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.video.fields.review') }}</label>
        @foreach($this->listsForFields['review'] as $key => $value)
            <label class="radio-label"><input type="radio" name="review" wire:model="video.review" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('video.review') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.video.fields.review_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('video.team_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="team">{{ trans('cruds.video.fields.team') }}</label>
        <x-select-list class="form-control" required id="team" name="team" :options="$this->listsForFields['team']" wire:model="video.team_id" />
        <div class="validation-message">
            {{ $errors->first('video.team_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.video.fields.team_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.videos.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>