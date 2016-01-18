var jPM = $.jPanelMenu();
var jRes = jRespond([
    {
        label: 'small',
        enter: 0,
        exit: 750
    },{
        label: 'large',
        enter: 800,
        exit: 10000
    }
]);

jRes.addFunc({
    breakpoint: 'small',
    enter: function() {
        jPM.on();
        $('#menu').css({display:'none'});
        $('.menu-trigger').css({display:'block'})
        $('#jPanelMenu-menu').addClass('navbar navbar-default')
    },
    exit: function() {
        jPM.off();
        $('#menu').css({display:'block'});
        $('.menu-trigger').css({display:'none'})
    }
});

function confirmDelete(formId, what){
    what = what == undefined ? 'list' : what;
    if(confirm('Are you sure that you want to delete this '+what+'?')){
        document.getElementById(formId).submit();
    }
    return false;
}