$(document).ready(function(){
    $("a>span.badge").load("utils/count.php");

    setInterval(function(){
        const container = $("a>span.badge");
        container.load('utils/count.php');
        container.text() == "0" ? container.hide() : container.show();
        }, 10000);

 });