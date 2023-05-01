<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="antialiased">

    <div class="relative w-full flex flex-col shadow-lb mb-6 mt-4 overflow-x-auto">
        <div class="flex justify-between mb-4">
            <label for="date_init" class="mr-2">Fecha inicio:</label>
            <input type="date" id="date_init" name="date_init" min="2021-01-01" max="2023-12-31">
            <label for="date_end" class="ml-4 mr-2">Fecha fin:</label>
            <input type="date" id="date_end" name="date_end" min="2021-01-01" max="2023-12-31">
            <button onclick="filtrar()" data-te-ripple-init data-te-ripple-color="light"
                class="rounded bg-emerald-600 px-8 pt-2 pb-2 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]">
                filtrar
                </a>
        </div>
        <table class="text-left w-full" id="example-table">
            <thead class="bg-emerald-600 flex text-white w-full">
                <tr class="flex border border-solid border border-l-0 divide-x-2 w-full">
                    <th class="p-2 w-1/3 text-center">nombre indicador</th>
                    <th class="p-2 w-1/3 text-center">codigo indicador</th>
                    <th class="p-2 w-1/3 text-center">unidad medida indicador</th>
                    <th class="p-2 w-1/3 text-center">valor indicador</th>
                    <th class="p-2 w-1/3 text-center">fecha indicador</th>
                    <th class="p-2 w-1/3 text-center">tiempo indicador</th>
                    <th class="p-2 w-1/3 text-center">origen indicador</th>
                    <th class="p-2 w-1/3 text-center">accion</th>
                </tr>
            </thead>
            <tbody class="bg-grey-light flex flex-col items-center justify-between overflow-y-scroll w-full">
            </tbody>
        </table>
    </div>
</body>
<script>
    $(document).ready(function() {
        $.ajax({
            url: '/api/indicators',
            method: 'GET',
            success: function(response) {
                // Procesar la respuesta del API
                console.log(response);
                // Agregar los datos a la tabla
                $.each(response, function(index, data) {

                    var row = $(
                        '<tr class="flex w-full border border-solid border border-l-0 divide-x-2">'
                    );
                    row.append($('<td class="p-2 w-1/3 text-center">').text(data
                        .name_indicator));
                    row.append($('<td class="p-2 w-1/3 text-center">').text(data
                        .code_indicator));
                    row.append($('<td class="p-2 w-1/3 text-center">').text(data
                        .unit_measure_indicator));
                    row.append($('<td class="p-2 w-1/3 text-center">').text(data.value));
                    row.append($('<td class="p-2 w-1/3 text-center">').text(data
                        .date_indicator));
                    row.append($('<td class="p-2 w-1/3 text-center">').text(data
                        .time_indicator));
                    row.append($('<td class="p-2 w-1/3 text-center">').text(data
                        .origin_indicator));
                    var deleteBtn = $('<button onclick="destroy(' + data.id + ')">')
                        .addClass(
                            'rounded bg-red-600 px-8 pt-2 pb-2 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]'
                        );
                    deleteBtn.attr('data-te-ripple-init', '');
                    deleteBtn.attr('data-te-ripple-color', 'light');
                    deleteBtn.text('Eliminar');

                    row.append($('<td class="p-2 w-1/3 text-center">').append(deleteBtn));
                    $('#example-table tbody').append(row);
                });
            },
            error: function(xhr, status, error) {
                // Manejar el error de la solicitud AJAX
                console.error(error);
            }
        });
    });
</script>
<script>
    function destroy(id) {
        $.ajax({
            url: '/api/indicators/' + id,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('se elimino el dato correctamente!');
            },
            error: function(xhr, status, error) {
                // Manejar el error de la solicitud AJAX
                console.error(error);
            }
        });
    }
</script>
<script>
    function filtrar() {
        var date_init = $('#date_init').val();
        var date_end = $('#date_end').val();
        $('#example-table tbody').empty();
        $.ajax({
            url: '/filter/'+date_init+'/'+date_end,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Procesar la respuesta del API
                console.log(response);
                // Agregar los datos a la tabla
                $.each(response, function(index, data) {
                    var row = $(
                        '<tr class="flex w-full border border-solid border border-l-0 divide-x-2">'
                    );
                    row.append($('<td class="p-2 w-1/3 text-center">').text(data
                        .name_indicator));
                    row.append($('<td class="p-2 w-1/3 text-center">').text(data
                        .code_indicator));
                    row.append($('<td class="p-2 w-1/3 text-center">').text(data
                        .unit_measure_indicator));
                    row.append($('<td class="p-2 w-1/3 text-center">').text(data.value));
                    row.append($('<td class="p-2 w-1/3 text-center">').text(data
                        .date_indicator));
                    row.append($('<td class="p-2 w-1/3 text-center">').text(data
                        .time_indicator));
                    row.append($('<td class="p-2 w-1/3 text-center">').text(data
                        .origin_indicator));
                    var deleteBtn = $('<button onclick="destroy(' + data.id + ')">')
                        .addClass(
                            'rounded bg-red-600 px-8 pt-2 pb-2 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]'
                        );
                    deleteBtn.attr('data-te-ripple-init', '');
                    deleteBtn.attr('data-te-ripple-color', 'light');
                    deleteBtn.text('Eliminar');

                    row.append($('<td class="p-2 w-1/3 text-center">').append(deleteBtn));
                    $('#example-table tbody').append(row);
                });
            },
            error: function(xhr, status, error) {
                // Manejar el error de la solicitud AJAX
                console.error(error);
            }
        });
    }
</script>

</html>
