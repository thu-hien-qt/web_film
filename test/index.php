<?php
session_start();
if (isset($_POST['reset'])) {
    $_SESSION['chats'] = array();
    header("Location: index.php");
    return;
}
if (isset($_POST['message'])) {
    if (!isset($_SESSION['chats'])) $_SESSION['chats'] = array();
    $_SESSION['chats'][] = array($_POST['message'], date(DATE_RFC2822));
    header("Location: index.php");
    return;
}
?>
<html>


<body>
 

    <h1>Chat</h1>
    <form method="post" action="index.php">
        <p>
            <input type="text" name="message" size="60" />
            <input type="submit" value="Chat" />
            <input type="submit" name="reset" value="Reset" />
        </p>
    </form>
    <div id="chatcontent">
        Loading...
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
    </script>
    <script type="text/javascript">

        function updateMsg() {
            window.console && console.log('Requesting JSON');
            $.getJSON('chatlist.php', function(rowz) {
                window.console && console.log('JSON Received');
                window.console && console.log(rowz);
                $('#chatcontent').empty();
                for (var i = 0; i < rowz.length; i++) {
                    entry = rowz[i];
                    $('#chatcontent').append('<p>' + entry[0] +
                        '<br/>&nbsp;&nbsp;' + entry[1] + "</p>\n");
                }
                setTimeout('updateMsg()', 4000);
            });
        }
        // Make sure JSON requests are not cached
        $(document).ready(function() {
            console.log("hi");
            $.ajaxSetup({
                cache: false
            });
            updateMsg();
        });
    </script>