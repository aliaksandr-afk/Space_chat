function sendDeleteAjax(param) {
    console.log(param);
    $.ajax({
        url: "index.php", // проверка сообщений в бд
        type: "post", // метод передачи
        dataType: "json", // тип передачи данных
        data: {
            'ajax': 'true',
            "action" : 'delete',
            "id" : param
        },
        success: function(data){
            $('.messages').html(data.result);
        }
    });
}

$(document).ready(function(){
    $('#common_submit').click(function(){
        var common_text = $('#common_text').val();
        document.getElementById('common_text').value='';
        $.ajax({
            url: "index.php", // куда отправляем
            type: "post", // метод передачи
            dataType: "json", // тип передачи данных
            data: {
                'ajax': 'true',
                "action": 'add',
                "common_text": common_text
            },
            success: function(data){
                $('.messages').html(data.result);
            }
        });
    });

    var timerId = setInterval(function() {
        $.ajax({
            url: "index.php", // проверка сообщений в бд
            type: "post", // метод передачи
            dataType: "json", // тип передачи данных
            data: {
                'ajax': 'true',
                "action": 'get',
            },
            success: function(data){
                $('.messages').html(data.result); 
                //скролл
                $('.messages').scrollTop($('#scroll')[0].scrollHeight);
            }
        });
    }, 2000);
});
