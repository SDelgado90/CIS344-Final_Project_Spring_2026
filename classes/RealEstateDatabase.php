<?php
require_once __DIR__ . '/Database.php';

class RealEstateDatabase {

    private PDO $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Add User
    public function addUser(string $userName, string $contactInfo, string $passwordHash, string $userType): bool {

        $sql = "INSERT INTO Users (userName, contactInfo, passwordHash, userType)
                VALUES (:userName, :contactInfo, :passwordHash, :userType)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':userName' => $userName,
            ':contactInfo' => $contactInfo,
            ':passwordHash' => $passwordHash,
            ':userType' => $userType
        ]);
    }

    // Get User By Username
    public function getUserByUsername(string $userName) {

        $sql = "SELECT * FROM Users
                WHERE userName = :userName
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':userName' => $userName
        ]);

        return $stmt->fetch();
    }

    // Add Property
    public function addProperty(
        string $title,
        string $propertyType,
        string $address,
        string $city,
        float $price,
        string $status,
        int $agentId
    ): bool {

        $sql = "INSERT INTO Properties
                (title, propertyType, address, city, price, status, agentId)
                VALUES
                (:title, :propertyType, :address, :city, :price, :status, :agentId)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':title' => $title,
            ':propertyType' => $propertyType,
            ':address' => $address,
            ':city' => $city,
            ':price' => $price,
            ':status' => $status,
            ':agentId' => $agentId
        ]);
    }

    // Get All Properties
    public function getAllProperties(): array {

        $sql = "SELECT p.*, u.userName AS agentName
                FROM Properties p
                JOIN Users u ON p.agentId = u.userId
                ORDER BY p.propertyId DESC";

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll();
    }

    // Get Property By ID
    public function getPropertyById(int $propertyId) {

        $sql = "SELECT p.*, u.userName AS agentName
                FROM Properties p
                JOIN Users u ON p.agentId = u.userId
                WHERE p.propertyId = :propertyId";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':propertyId' => $propertyId
        ]);

        return $stmt->fetch();
    }

    // Add Inquiry
    public function addInquiry(int $userId, int $propertyId, string $message): bool {

        $sql = "INSERT INTO Inquiries
                (userId, propertyId, message, inquiryDate)
                VALUES
                (:userId, :propertyId, :message, NOW())";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':userId' => $userId,
            ':propertyId' => $propertyId,
            ':message' => $message
        ]);
    }
    // Add delete function
        public function deleteProperty(int $propertyId): bool {

    $this->conn->beginTransaction();

    try {

        $stmt = $this->conn->prepare(
            "DELETE FROM favorites WHERE propertyId = :propertyId"
        );
        $stmt->execute([
            ':propertyId' => $propertyId
        ]);

        $stmt = $this->conn->prepare(
            "DELETE FROM inquiries WHERE propertyId = :propertyId"
        );
        $stmt->execute([
            ':propertyId' => $propertyId
        ]);

        $stmt = $this->conn->prepare(
            "DELETE FROM transactions WHERE propertyId = :propertyId"
        );
        $stmt->execute([
            ':propertyId' => $propertyId
        ]);

        $stmt = $this->conn->prepare(
            "DELETE FROM properties WHERE propertyId = :propertyId"
        );
        $stmt->execute([
            ':propertyId' => $propertyId
        ]);

        $this->conn->commit();

        return true;

    } catch (Exception $e) {

        $this->conn->rollBack();

        return false;
    }
}
    }
?>
