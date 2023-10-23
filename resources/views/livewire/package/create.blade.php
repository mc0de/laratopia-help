<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('package.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.package.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="package.name">
        <div class="validation-message">
            {{ $errors->first('package.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.package.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('package.ads') ? 'invalid' : '' }}">
        <label class="form-label" for="ads">{{ trans('cruds.package.fields.ads') }}</label>
        <input class="form-control" type="text" name="ads" id="ads" wire:model.defer="package.ads">
        <div class="validation-message">
            {{ $errors->first('package.ads') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.package.fields.ads_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('package.post') ? 'invalid' : '' }}">
        <label class="form-label" for="post">{{ trans('cruds.package.fields.post') }}</label>
        <input class="form-control" type="text" name="post" id="post" wire:model.defer="package.post">
        <div class="validation-message">
            {{ $errors->first('package.post') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.package.fields.post_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('package.design') ? 'invalid' : '' }}">
        <label class="form-label" for="design">{{ trans('cruds.package.fields.design') }}</label>
        <input class="form-control" type="text" name="design" id="design" wire:model.defer="package.design">
        <div class="validation-message">
            {{ $errors->first('package.design') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.package.fields.design_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('package.video') ? 'invalid' : '' }}">
        <label class="form-label" for="video">{{ trans('cruds.package.fields.video') }}</label>
        <input class="form-control" type="text" name="video" id="video" wire:model.defer="package.video">
        <div class="validation-message">
            {{ $errors->first('package.video') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.package.fields.video_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('package.platforms') ? 'invalid' : '' }}">
        <label class="form-label" for="platforms">{{ trans('cruds.package.fields.platforms') }}</label>
        <input class="form-control" type="text" name="platforms" id="platforms" wire:model.defer="package.platforms">
        <div class="validation-message">
            {{ $errors->first('package.platforms') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.package.fields.platforms_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('package.story') ? 'invalid' : '' }}">
        <label class="form-label" for="story">{{ trans('cruds.package.fields.story') }}</label>
        <input class="form-control" type="text" name="story" id="story" wire:model.defer="package.story">
        <div class="validation-message">
            {{ $errors->first('package.story') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.package.fields.story_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>