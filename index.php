<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Галерея jQuery засобами PHP</title>
    <link rel="stylesheet" type="text/css" href="css/lightbox.min.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />

</head>
<body>
<div id="container">
    <div id="heading"> <!-- заголовок -->
        <h1>A cool jQuery gallery</h1>
    </div>
    <div id="gallery"> <!-- в цьому блоці будуть відображатися картинки-->
        <?php
        $directory = 'files'; //папка з картинками
        $allowed_types=array('jpg','jpeg','gif','png'); //допустимі типи
        $file_parts=array();
        $ext='';
        $title='';
        $i=0;
        //пробуємо відкрити папку
        $dir_handle = @opendir($directory) or die("Сталася помилка при відкритті зображень із папки!");
        while ($file = readdir($dir_handle)) //перевіряємо файли в папці
        {
            if($file=='.' || $file == '..') continue; //пропускаємо посилання на поточну і батьківську папки
             $file_parts = explode('.',$file); //розбиваємо назву файлу на частини через крапку
             $ext = strtolower(array_pop($file_parts)); //визначаємо розширення файлу
             $title = implode('.',$file_parts); // назва файлу
             $title = htmlspecialchars($title); // перетворення назви в html безпечний вигляд
             $nomargin='';
             if(in_array($ext,$allowed_types)) //якщо розширення допустиме
             {
             if(($i+1)%4==0) $nomargin='nomargin'; // останнє зображення в рядку отримує css клас 'nomargin'
             echo '  
             <div class="pic '.$nomargin.'"
                style="background:url('.$directory.'/'.$file.') no-repeat 50% 50%;">
                 <a href="'.$directory.'/'.$file.'" title="'.$title.'"
                target="_blank">'.$title.'</a>
             </div>';
            $i++; //номер зображення
         }
        }
        closedir($dir_handle); //закриваємо папку
        ?>
        <div></div>
    </div>
    <div id="footer"> <!-- підвал -->
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!--<script type="text/javascript" src="js/jquery.min.js"></script>-->
<script type="text/javascript" src="js/lightbox.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>