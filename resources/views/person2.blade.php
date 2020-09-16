<!DOCTYPE html>
<html>
<head>
    <title>Pusher Test</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        let msg_box =   $('.messages-box .container');
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('f693735002c629355d6a', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('FirstPersonEvent', function(data) {
            let new_message = data;
            //Send Luiza Data
            $(".messages-box .container").append("<div class='sent-msg right-msg'><span>"+new_message.text+"</span></div>");
            $(".messages-box .container").animate({ scrollTop:  $(".messages-box .container")[0].scrollHeight}, 1000);
        });

        $( document ).ready(function() {
            $("#click1").on('click', function(){

                let chat = $("#chat1").val();

                if(chat != ''){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "second_person_text",
                        type:"POST",
                        data:{
                            text:chat
                        },
                        success:function(response){
                            console.log(response);
                        },
                    });

                    $(".messages-box .container").append("<div class='sent-msg left-msg'><span>"+chat+"</span></div>");
                    $('#chat1').val('');
                    $(".messages-box .container").animate({ scrollTop:  $(".messages-box .container")[0].scrollHeight}, 1000);
                }


            });


            $(document).keypress(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13'){

                    let chat = $("#chat1").val();


                    if(chat != ''){
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "second_person_text",
                            type:"POST",
                            data:{
                                text:chat
                            },
                            success:function(response){
                                console.log(response);
                            },
                        });

                        $(".messages-box .container").append("<div class='sent-msg left-msg'><span>"+chat+"</span></div>");
                        $('#chat1').val('');
                        $(".messages-box .container").animate({ scrollTop: $('.messages-box .container')[0].scrollHeight}, 1000);
                    }

                }
            });
        });

    </script>
    <style>
        .chat-container{
            width: 300px;
        }
        .messages-box{
            padding: 15px;
            box-sizing: border-box;
            height: 280px;
            border: 1px solid #e6e6e6;
            border-radius: 5px;
            margin-bottom: 10px;
            background: #f5f6fa;
            /*overflow-y: scroll;*/
            display: flex;
            flex-direction: column;
            align-items: center;
            position:   relative;
            width:      100%;
        }
        .type-msg{
            display: flex;
            justify-content: space-between;
        }
        .type-msg input{
            width: 88%;
            border-radius: 3px;
            border: 1px solid #ddd;
            height: 30px;
            padding: 5px;
            box-sizing: border-box;
        }
        .type-msg button{
            background: #3593e0;
            color: #ffffff;
            border: none;
            cursor: pointer;
            width: 31px;
            border-radius: 50%;
        }
        .sent-msg{
            margin-bottom: 5px;
        }
        .sent-msg span{
            display: block;
            border-radius: 7px;
            box-sizing: border-box;
            padding: 7px;
            font-family: Arial;
            font-size: 14px;
        }
        .sent-msg.left-msg span{
            background: #3593e0;
            color: #ffffff;
        }
        .sent-msg.right-msg span{
            background: #d8d8d8;
            color: #000000;
        }

        .sent-msg.left-msg{
            display: flex;
            justify-content: flex-start;
        }
        .sent-msg.right-msg{
            display: flex;
            justify-content: flex-end;
        }
        .chat-with{
            text-align: center;
            padding: 14px;
            background: #3593e0;
            font-size: 24px;
            color: #ffffff;
            border-top-right-radius: 4px;
            border-top-left-radius: 4px;
            font-family: Arial;
        }
        .container{
            overflow:   auto;
            position:   absolute;
            bottom:     0;
            width: 96%;
            max-height: 278px;
        }
    </style>
</head>
<body>
<div class="chat-container">
    <div class="chat-with">Person 1</div>
    <div class="messages-box">
        <div class="container"></div>
    </div>
    <div class="type-msg">
        <input id="chat1" type="text" name="text" placeholder="Type you message...">
        <button id="click1"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
    </div>
</div>

</body>
</html>

