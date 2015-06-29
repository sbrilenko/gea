<?php
    // Определение параметров базы данных по умолчанию
    if ($_SERVER[REMOTE_ADDR]=="127.0.0.1") {   // подключение с локального компьютера - отладка на локальной машине
        define("const_dbName","gea");
        define("const_hostName","localhost");
        define("const_userName","root");
        define("const_password","");   
    } else {                                    // подключение с сервера
        define("const_dbName","gea");
        define("const_hostName","localhost");
        define("const_userName","gea");
        define("const_password","bodmVNYs");
    }
    
    // Класс для работы с базой данных MySQL
    class CMySQL
    {
        // Конструктор - соединение с базой данных MySQL
        // [$dbName - имя БД, $hostName - имя хоста, $userName - имя пользователя, $password - пароль]
        function CMySQL($dbName=const_dbName,$hostName=const_hostName,$userName=const_userName,$password=const_password)
        {
            // Ошибка соединения с базой - переход на страницу "Критическая ошибка"
            if(!mysql_connect($hostName,$userName,$password))
            {
               echo "could not connect to database!";
            }

            // Подключение базы данных
            mysql_select_db($dbName) or die(mysql_error());
        }
    }

  $db=new CMySQL();
  @mysql_query("SET NAMES utf8");    
?>