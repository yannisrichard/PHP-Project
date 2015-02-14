<?php
namespace Model\Database;

use Model\Status;

class StatusMapper
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function persist(Status $status)
    {
        $query = "INSERT INTO STATUSES VALUES (:status_id, :status_message, :status_user, :status_date);";

        if (isset($_SESSION['is_authenticated']) && $_SESSION['is_authenticated']) {
            $user_id = $_SESSION['user_id'];
        } else {
            $user_id = null;
        }

        return $this->connection->executeQuery($query, [
            ':status_id' => $status->getId(),
            ':status_user' => $status->getOwner()->getId(),
            ':status_message' => $status->getText(),
            ':status_date' => $status->getDate()->format('Y-m-d H:i:s'),
        ]);
    }

    public function remove($status_id)
    {
        $query = "DELETE FROM STATUSES WHERE status_id = :status_id";

        return $this->connection->executeQuery($query, [
            ':status_id' => $status_id,
        ]);
    }
}
