
<?php
class UserModel
{
    //Obtiene todos los usuarios
    public static function getAll(mysqli $db): array
    {
        $res = $db->query("SELECT * FROM users");
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    //Obtiene un usuario por su id
    public static function getById(mysqli $db, int $id): ?array
    {
        $stmt = $db->prepare("SELECT id, email, name, surname, role, pass_hash FROM users WHERE id=? LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc() ?: null;
    }

    //Actualiza los datos de un usuario existente
    public static function update(
        mysqli $db,
        int $id,
        string $name,
        string $surname,
        string $email,
        string $pass_hash,
        string $role
    ): bool {
        $stmt = $db->prepare(
            "UPDATE users
             SET name = ?, surname = ?, email = ?, pass_hash = ?, role = ?
             WHERE id = ?"
        );
        $stmt->bind_param("sssssi", $name, $surname, $email, $pass_hash, $role, $id);
        try {
            $stmt->execute();
            $stmt->close();
            return true;
            /*header('Location: /../login.php?registered=1');
            exit;*/
        } catch (mysqli_sql_exception $ex) {
            $stmt->close();
            $stmt->close();
            if ((int)$ex->getCode() === 1062) {
                return false; 
            }
            throw $ex;

            /*if ((int)$ex->getCode() === 1062) {
                header('Location: /../register-start.php?e=dup');
            } else {
                header('Location: /../register-start.php?e=err');
            }
            exit;*/
        }
    }

    //Elimina un usuario por su id
    public static function delete(mysqli $db, int $id): bool
    {
        $stmt = $db->prepare("DELETE FROM users WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    //Crea un usuario
    public static function create(
        mysqli $db,
        string $email,
        string $name,
        string $surname,
        string $pass_hash,
        string $role
    ): bool {
        $stmt = $db->prepare(
            "INSERT INTO users (email, name, surname, pass_hash, role, created_at)
         VALUES (?, ?, ?, ?, ?, NOW())"
        );
        $stmt->bind_param("sssss", $email, $name, $surname, $pass_hash, $role);
        //var_dump($stmt);
        try {
            $stmt->execute();
            $stmt->close();
            return true;
            /*header('Location: /../login.php?registered=1');
            exit;*/
        } catch (mysqli_sql_exception $ex) {
            $stmt->close();
            if ((int)$ex->getCode() === 1062) {
                return false; // duplicado
            }
            throw $ex;
            /*if ((int)$ex->getCode() === 1062) {
                header('Location: /../register-start.php?e=dup');
            } else {
                header('Location: /../register-start.php?e=err');
            }
            exit;*/
        }
    }

    //Verifica si existe usuario por su email
    public static function existsByEmail($db, $email)
    {
        $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch() ? true : false;
    }

    //Obtiene datos de usuario por su email
    public static function getByEmail(mysqli $db, string $email): ?array
    {
        $stmt = $db->prepare(
            'SELECT id, role, pass_hash FROM users WHERE email = ? LIMIT 1'
        );
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $res  = $stmt->get_result();
        $user = $res->fetch_assoc();
        $stmt->close();

        return $user ?: null;
    }
}
