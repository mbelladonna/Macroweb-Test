<?                      
    if (isset($error)) :
?>
    <div class="error"><?echo $error?></div>
<?
    unset($error);
    endif;
?>

<div class="form">
<? echo "Continuar a chequeo de pin para request : <br>"; ?>
<pre><?echo print_r($request, true);?></pre>
</div>
