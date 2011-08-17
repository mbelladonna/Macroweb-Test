<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css" media="screen"/>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.5.1.min.js"></script>
        <title><? if(!isset($page_title)) : ?>SMSender<? else: ?><?=$page_title?><?php endif;?></title>
    </head>
    <body>
        <div id="header" style="margin-top: -20px;">
            <h1 style="font-size: 43px;">SMSender</h1>
            <div style="margin-bottom: 10px;">&nbsp;</div>
        </div>
        <?=$content?>
    </body>
</html>
