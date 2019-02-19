square_resize('block','square');
//костыль при изменении размера экрана через dev tools
$(window).resize(function(){
    square_resize('block','square');
});

function square_resize(parent_block,child_block){
    var parent = $('.' + parent_block),
        size_child = Math.min(parent.width()*0.95, parent.height()*0.95),
        child =  $('.' + child_block);
    child.css({"height":size_child,"width":size_child});
    console.log(size_child);
    return size_child;
}


$( function() {
    $( ".droptrue" ).sortable({
        connectWith: "div"
    });

    $( ".dropfalse" ).sortable({
        connectWith: "div",
        dropOnEmpty: false
    });

    $( "#sortable" ).disableSelection();
} );