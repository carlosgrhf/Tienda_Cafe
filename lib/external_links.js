function openExternal(){
    if(!document.getElementsByTagName) return;
    var anchors = document.getElementsByTagName('a');
    for(var i = 0; i < anchors.length; i++){
        var thisAnchor = anchors[i];
        if(thisAnchor.getAttribute('href') && thisAnchor.getAttribute('rel') == 'external'){
            thisAnchor.target = '_blank';
        }
    }
}

window.onload = openExternal;


