var $target = $('#content');
var olCounter = 1;
var ulFirst = true;
$('.bold').click(function(){
    var caretPos = $target[0].selectionStart;
    var textAreaTxt = $target.val();
    var txtToAdd = "**BOLD**";
    $target.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
});
$('.italic').click(function(){
    var caretPos = $target[0].selectionStart;
    var textAreaTxt = $target.val();
    var txtToAdd = "*ITALIC*";
    $target.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
});
$('.strikethrough').click(function(){
    var caretPos = $target[0].selectionStart;
    var textAreaTxt = $target.val();
    var txtToAdd = "~~STRIKETHROUGH~~";
    $target.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
});
$('.quote').click(function(){
    var caretPos = $target[0].selectionStart;
    var textAreaTxt = $target.val();
    var txtToAdd = "\n\n>QUOTE";
    $target.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
});
$('.code').click(function(){
    var caretPos = $target[0].selectionStart;
    var textAreaTxt = $target.val();
    var txtToAdd = "\n\n`CODE`";
    $target.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
});
$('.heading1').click(function(){
    var caretPos = $target[0].selectionStart;
    var textAreaTxt = $target.val();
    var txtToAdd = "\n\n# HEADING1";
    $target.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
});
$('.heading2').click(function(){
    var caretPos = $target[0].selectionStart;
    var textAreaTxt = $target.val();
    var txtToAdd = "\n\n# HEEADING2";
    $target.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
});

$('.link').click(function(){
    var caretPos = $target[0].selectionStart;
    var textAreaTxt = $target.val();
    var link = $('#mylink').val();
    var title = $('#mytitle').val();
    if(title == '')
        title = "TITLE";
    if(link == '')
        link = "https://example.com";
    var txtToAdd = "["+title+"](" + link +")";
    $target.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
});
$('.image').click(function(){
    var caretPos = $target[0].selectionStart;
    var textAreaTxt = $target.val();
    var image = $('#myimage').val();
    var title = $('#myimagetitle').val();
    if(image == '')
        image = "image.png";
    if(title == '')
        title = "IMAGE";
    var txtToAdd = '\n\n!['+title+']('+image+')';
    $target.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
});

$('.listul').click(function(){
    var caretPos = $target[0].selectionStart;
    var textAreaTxt = $target.val();
    if(ulFirst)
        var txtToAdd = '\n\n - TEXT';
    else 
        var txtToAdd = '\n - TEXT';
    ulFirst = false;
    $target.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
});
$('.listol').click(function(){
    var caretPos = $target[0].selectionStart;
    var textAreaTxt = $target.val();
    if(olCounter == 1)
        var txtToAdd = '\n\n' + (olCounter) + '. TEXT';
    else 
        var txtToAdd = '\n' +  (olCounter) + '. TEXT';

    olCounter++;
    $target.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
});