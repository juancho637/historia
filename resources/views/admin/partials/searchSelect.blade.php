<!-- Select2 -->
{{--<link rel="stylesheet" href="{{ asset('/plugins/select2/dist/css/select2.min.css') }}">--}}

<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
    <label for="{{ $name }}">Cliente:</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-control" style="width: 100%;"></select>
    {!! $errors->first($name, '<span class="help-block">:message</span>') !!}
</div>

<!-- Select2 -->
<script src="{{ asset('/plugins/select2/dist/js/select2.full.min.js') }}"></script>{{----}}
<script>
    $(function () {
        {{--let client_id = '{{ old($name) }}'; --}}

        $('#{{ $name }}').select2({
            minimumInputLength: 2,
            language: {
                inputTooShort: function () {
                    return "Por favor ingrese 2 o más letras para realizar la busqueda.";
                }
            },
            ajax: {
                url: "{{ route($uri) }}",
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data
                    };
                },
            }
        });

        //Code
        {{-- if(client_id){
            $.get('{{ route('api.clients.show', old('client_id')) }}', function(client) {
                $('#client_id').append(`<option value="{{ old('client_id') }}" selected>${client.text}</option>`);
                $('#address').attr('disabled', false);
                $('#mail').attr('disabled', false);
                $('#cell_phone').attr('disabled', false);
                setFields(client);
            });
        }

        $('#client_id').change(function() {
            $('#address').attr('disabled', false);
            $('#mail').attr('disabled', false);
            $('#cell_phone').attr('disabled', false);
            clients.map((client)=>{
                if(client.id === parseInt($(this).val())){
                    setFields(client);
                }
            });
        }); --}}
    });
</script>