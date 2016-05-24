// $(document).ready(function () {
    var contenedor = $('#info');
    var timestamp = 0;
    socketpush();

    function socketpush() {
        console.log('TIMESTAMP:');
        console.log(timestamp);
        console.log('-------------------------------------');

        $.post('httpush.php', {
            timestamp : timestamp
        }).done(function (data) {
            var json = JSON.parse(data);
            timestamp = json.timestamp;
            mensaje = json.mensaje;
            ID = json.ID;
            posicion = json.posicion;

            console.log('RESPUESTA JSON:');
            console.log(json);
            console.log('-------------------------------------');

            if( timestamp != null ){
                $.post('mensajes.php').done(function(html){
                    $('#info').html( html );
                });
            }
            // return;
            setTimeout(function(){
                socketpush();
            },500);
        });
    }
// });