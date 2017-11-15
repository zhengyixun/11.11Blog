$(function(){
    $('.edit').click(function(){
        $('.rightCon').css('display','block');
        $('.con>label').css('display','block');
        $('.rightCon>input').css('display','block');
        $('.wallet').css('display','none');
    })
    $('.say').click(function(){
        $('.rightCon').css('display','block');
        $('.con>label').css('display','none');
        $('.rightCon>input').css('display','none');
        $('.wallet').css('display','none');
    });
    /*wallet*/
    $('.money').click(function(){
        $('.rightCon').css('display','none');
        $('.wallet').css('display','block');

    })
    /*弹出*/
    $(document).on('opening', '.remodal', function () {
        console.log('opening');
    });

    $(document).on('opened', '.remodal', function () {
        console.log('opened');
    });

    $(document).on('closing', '.remodal', function (e) {
        console.log('closing' + (e.reason ? ', reason: ' + e.reason : ''));
    });

    $(document).on('closed', '.remodal', function (e) {
        console.log('closed' + (e.reason ? ', reason: ' + e.reason : ''));
    });

    $(document).on('confirmation', '.remodal', function () {
        console.log('confirmation');
    });

    $(document).on('cancellation', '.remodal', function () {
        console.log('cancellation');
    });

    //  The second way to initialize:
    $('[data-remodal-id=modal2]').remodal({
        modifier: 'with-red-theme'
    });
    /*多选框*/
    $('#chklist').hcheckbox();
    $('#radiolist').hradio();
    $('#btnOK').click(function(){
        var checkedValues = new Array();
        $('#chklist :checkbox').each(function(){
            if($(this).is(':checked')){
                checkedValues.push($(this).val());
            }
        });
        // 求总价
        var sum=0;
        for(var i=0;i<checkedValues.length;i++){
            sum +=parseInt(checkedValues[i]);
        }
        var str='总价为'+sum+'元';
        alert(str);
        // alert(checkedValues.join(','));
    })

});