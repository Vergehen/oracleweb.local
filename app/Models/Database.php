<?php
namespace App\Models;

// Фіча. Бо по іншому не працювало.
putenv("TNS_ADMIN=I:\\Programs\\Oracle_Database_11g_R2_11.2.0.4_win-x64\\product\\11.2.0\\dbhome_1\\network\\admin");

class Database
{
    private static $connection = null;

    public static function getConnection()
    {
        if (self::$connection === null) {
            $config = require_once __DIR__ . '/../../config/database.php';
            self::$connection = odbc_connect($config['dsn'], $config['username'], $config['password']);

            if (self::$connection === false) {
                throw new \Exception('Не вдалося підключитися до бази даних Oracle: ' . odbc_errormsg());
            }
        }

        return self::$connection;
    }

    public static function closeConnection()
    {
        if (self::$connection !== null) {
            odbc_close(self::$connection);
            self::$connection = null;
        }
    }
}
