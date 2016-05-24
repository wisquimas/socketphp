<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    /**
     * @var \SplObjectStorage
     */
    protected $clients;

    /**
     * Chat constructor.
     */
    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    /**
     * Trigger al abrir conexion
     * @param ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        $this->EnviarATodos("New connection! ({$conn->resourceId})\n");
        echo "New connection! ({$conn->resourceId})\n";
    }

    /**
     * Trigger al recibir mensajes
     * @param ConnectionInterface $from
     * @param string              $msg
     */
    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        $this->EnviarATodos($msg);
    }

    /**
     * Funcion para enviar mensaje a todos los clientes
     * @param string $mensaje
     */
    private function EnviarATodos( $mensaje = '' ){
        foreach ($this->clients as $client) {
            $client->send($mensaje);
        }
    }

    /**
     * Cerrar conexion
     * @param ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        $this->EnviarATodos("Connection {$conn->resourceId} has disconnected\n");
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    /**
     * Trigger Error
     * @param ConnectionInterface $conn
     * @param \Exception          $e
     */
    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}