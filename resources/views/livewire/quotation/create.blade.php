<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('quotation.title') ? 'invalid' : '' }}">
        <label class="form-label required" for="title">{{ trans('cruds.quotation.fields.title') }}</label>
        <input class="form-control" type="text" name="title" id="title" required wire:model.defer="quotation.title">
        <div class="validation-message">
            {{ $errors->first('quotation.title') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.quotation.fields.title_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('quotation.details') ? 'invalid' : '' }}">
        <label class="form-label" for="details">{{ trans('cruds.quotation.fields.details') }}</label>
        <textarea class="form-control" name="details" id="details" wire:model.defer="quotation.details" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('quotation.details') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.quotation.fields.details_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.quotations.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>