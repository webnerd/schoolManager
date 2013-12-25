/**
 * Created by JetBrains PhpStorm.
 * User: Prasad
 * Date: 12/2/13
 * Time: 9:28 PM
 * To change this template use File | Settings | File Templates.
 */
$(function() {
    $( ".datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat:'yy-mm-dd',
        showOn: "button",
        buttonImage: "/web/images/calendar_icon.jpg",
        buttonImageOnly: true
    });
});