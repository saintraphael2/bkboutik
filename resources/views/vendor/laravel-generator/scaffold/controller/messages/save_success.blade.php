@if($config->options->localized)
    Flash::success(__('messages.saved', ['model' => __('models/{{ $config->modelNames->camelPlural }}.singular')]));
@else
    Flash::success('{{ $config->modelNames->human }} enregistré(e) avec succès.');
@endif
