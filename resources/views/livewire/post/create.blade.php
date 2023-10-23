<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('post.project_id') ? 'invalid' : '' }}">
        <label class="form-label" for="project">{{ trans('cruds.post.fields.project') }}</label>
        <x-select-list class="form-control" id="project" name="project" :options="$this->listsForFields['project']" wire:model="post.project_id" />
        <div class="validation-message">
            {{ $errors->first('post.project_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.post.fields.project_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('post.title') ? 'invalid' : '' }}">
        <label class="form-label" for="title">{{ trans('cruds.post.fields.title') }}</label>
        <input class="form-control" type="text" name="title" id="title" wire:model.defer="post.title">
        <div class="validation-message">
            {{ $errors->first('post.title') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.post.fields.title_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('post.content') ? 'invalid' : '' }}">
        <label class="form-label" for="content">{{ trans('cruds.post.fields.content') }}</label>
        <input class="form-control" type="text" name="content" id="content" wire:model.defer="post.content">
        <div class="validation-message">
            {{ $errors->first('post.content') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.post.fields.content_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('category') ? 'invalid' : '' }}">
        <label class="form-label" for="category">{{ trans('cruds.post.fields.category') }}</label>
        <x-select-list class="form-control" id="category" name="category" wire:model="category" :options="$this->listsForFields['category']" multiple />
        <div class="validation-message">
            {{ $errors->first('category') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.post.fields.category_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('post.status') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.post.fields.status') }}</label>
        @foreach($this->listsForFields['status'] as $key => $value)
            <label class="radio-label"><input type="radio" name="status" wire:model="post.status" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('post.status') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.post.fields.status_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('post.confirmation') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.post.fields.confirmation') }}</label>
        @foreach($this->listsForFields['confirmation'] as $key => $value)
            <label class="radio-label"><input type="radio" name="confirmation" wire:model="post.confirmation" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('post.confirmation') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.post.fields.confirmation_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('post.note') ? 'invalid' : '' }}">
        <label class="form-label" for="note">{{ trans('cruds.post.fields.note') }}</label>
        <input class="form-control" type="text" name="note" id="note" wire:model.defer="post.note">
        <div class="validation-message">
            {{ $errors->first('post.note') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.post.fields.note_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('post.review') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.post.fields.review') }}</label>
        @foreach($this->listsForFields['review'] as $key => $value)
            <label class="radio-label"><input type="radio" name="review" wire:model="post.review" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('post.review') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.post.fields.review_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('post.team_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="team">{{ trans('cruds.post.fields.team') }}</label>
        <x-select-list class="form-control" required id="team" name="team" :options="$this->listsForFields['team']" wire:model="post.team_id" />
        <div class="validation-message">
            {{ $errors->first('post.team_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.post.fields.team_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>