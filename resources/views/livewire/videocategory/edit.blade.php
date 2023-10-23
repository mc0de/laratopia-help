<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('videocategory.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.videocategory.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="videocategory.name">
        <div class="validation-message">
            {{ $errors->first('videocategory.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.videocategory.fields.name_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.videocategories.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>