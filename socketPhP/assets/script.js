// var conn = new WebSocket('ws://localhost:8080');
var conn = new WebSocket('ws://wisquimas.ngrok.io');

var contenedor = $('#info');
console.log(conn);

conn.onopen = function(e) {
    console.log("Connection established!");
    console.log(e);
};

conn.onmessage = function(e) {
    console.log("Recibiendo mensaje");
    console.log(e);
    contenedor.append('<div>'+e.data+'</div>');
};

$('#submit').on('submit',function(e){
    e.preventDefault();
    conn.send( $(this).find('input').val() );
    $(this).find('input').val('');
});