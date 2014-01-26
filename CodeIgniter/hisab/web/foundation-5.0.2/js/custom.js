/**
 * Created by JetBrains PhpStorm.
 * User: Prasad
 * Date: 1/24/14
 * Time: 11:16 PM
 * To change this template use File | Settings | File Templates.
 */

$(function(){
    $('#expenditure').on('submit',function(){
        var members = $('#members').find('input[type=checkbox]').is(':checked');
        if(members)
        {
            return true;
        }
        else
        {
            $('#members').find('small').show();
            return false;
        }
    });

    $('#inviteForm').on('valid', function () {

            var inviteForm = $('#inviteForm');
            var inviteeEmailId = $('#inviteeEmailId').val();
            var houseSeoTitle =  $('input[name=houseSeoTitle]').val();
            var data = {emailId:inviteeEmailId, houseSeoTitle:houseSeoTitle};
            $.ajax({
                type: "POST",
                url: '/invite/' + houseSeoTitle + '/',
                data: data,
                success:(function(data){
                    var returnedData = jQuery.parseJSON(data);
                    if(returnedData.error)
                    {
                        $('#inviteeEmailId').parent().addClass('error').attr('data-invalid');
                        $('#inviteeEmailId').siblings('small').text(returnedData.msg).show();
                    }
                    else
                    {
                        $('#inviteeEmailId').parent().addClass('error');
                        $('#inviteeEmailId').siblings('small').removeClass('error').addClass('success').text(returnedData.msg).show();
                    }
                })
            });
    });
});


