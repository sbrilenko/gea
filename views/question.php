<?php
    $page->title="GEA | Задать вопрос";
    $page->addScript("question.js");
    echo "<div class='productCaption'>Задать вопрос</div>";
    
    echo "<p>На этой странице вы можете задать любой интересующий вас вопрос. Мы постараемся как можно быстрее ответить вам.</p>";
   // echo "<img src='img/form.png' alt='form' class='form' />";
   echo "<form action='scripts/form.php' method='post'>
            <input type='hidden' name='type' value='question' />";
   echo "   <div class='leftSide'>
                <div class='container'>
                    <div class='qTitle'>Ваши Ф.И.О.:</div>
                    <div class='inputWrapper'><input type='text' name='fio' /></div>
                    
                    <div class='qTitle'>Ваш email:</div>
                    <div class='inputWrapper'><input type='text' name='email' /></div>
                    
                    <div class='qTitle'>Ваш телефон:</div>
                    <div class='inputWrapper'><input type='text' name='phone' /></div>
                    
                    <div class='qTitle'>Тема вашего вопроса:</div>
                    <div class='inputWrapper'><input type='text' name='theme' /></div>
                </div>
            </div>
            
            <div class='rightSide'>
                <div class='container'>
                    <div class='qTitle'>Ваш вопрос:</div> 
                    <div class='textareaWrapper'>
                        <textarea name='question' cols='25' rows='10'></textarea>
                    </div>
                </div>
            </div>
            
            <div class='bottomSide'>  
                <a class='send'><span>Отправить</span></a>
                <div class='inputCaptchWrapper'><input type='text' name='captch' id='captch' /></div>
                <span class='qTitle' style='position: absolute'>Введите символы с картинки:</span> 
                <img src='captch/index.php?".session_name()."=".session_id()."' alt='captch' />
            </div>";
            echo "</form>";
?>
