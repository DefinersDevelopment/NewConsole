/********************************
Globals

*********************************/
_log = 'dev';

/*********************************
Event Listeners

    ______                 __      
   / _____   _____  ____  / /______
  / __/ | | / / _ \/ __ \/ __/ ___/
 / /___ | |/ /  __/ / / / /_(__  ) 
/_____/ |___/\___/_/ /_/\__/____/  
                                   

**********************************/


function addViewPostClick(){
    // TODO should i add a class/id hiearchy here??
    addUniqueEvent(".isPost",'click',viewPostClick);
}   
function addCatClick(){
    // TODO should i add a class/id hiearchy here??
    addUniqueEvent(".isCat",'click', categoryClick);
    
}
function addPrevClick(){
    // TODO should i add a class/id hiearchy here??
    addUniqueEvent(".prevClick",'click', prevClick);
    
}
function addNextClick(){
    // TODO should i add a class/id hiearchy here??
    addUniqueEvent(".nextClick",'click', nextClick);
    
}
function addShowPostCreateFormClick(){
    // TODO should i add a class/id hiearchy here??
    addUniqueEvent(".showPostCreateFormClick",'click', showPostCreateFormClick);
}
function addFormSaveClick(){
    // TODO should i add a class/id hiearchy here??
    addUniqueEvent(".formSaveClick",'click', formSaveClick);
}
function addEditPostClick(){
    // TODO should i add a class/id hiearchy here??
    addUniqueEvent(".editPostClick",'click', editPostClick);
    
}
function addToggleFavPostClick(){
    // TODO should i add a class/id hiearchy here??
    addUniqueEvent(".toggleFavPostClick",'click', toggleFavPostClick);
}
function addGetFavsClick(){
    addUniqueEvent(".getFavsClick",'click', getFavsClick);  
}
function addSearchClick(){
    addUniqueEvent(".searchClick",'click', searchClick);        
}
function addSearchReturnPress(){
    addUniqueEvent("#searchBox",'keydown', searchClick);        
}
function addLicensePostClick(){
    addUniqueEvent(".licensePostClick",'click', licensePostClick);  
}

function addDeletePostClick(){
    addUniqueEvent(".deletePostClick",'click', deletePostClick);  
}
function addLogoutClick(){
    addUniqueEvent(".logoutClick",'click', logoutClick);  
}
function addAllUnreadsClick(){
    addUniqueEvent(".getAllUnreadsClick",'click', getAllUnreadsClick);      
}
  
/******** END EVENT LISTNER SECTION ******************/





/********************************************************
NAVIGATION STUFF
  _   _             _             _   _             
 | \ | |           (_)           | | (_)            
 |  \| | __ ___   ___  __ _  __ _| |_ _  ___  _ __  
 | . ` |/ _` \ \ / | |/ _` |/ _` | __| |/ _ \| '_ \ 
 | |\  | (_| |\ V /| | (_| | (_| | |_| | (_) | | | |
 |_| \_|\__,_| \_/ |_|\__, |\__,_|\__|_|\___/|_| |_|
                       __/ |                        
                      |___/                         
*********************************************************/


// Function that is run when a category is clicked
function categoryClick(){       
    data = new Object;
    setCatActive(this);
    //console.log("my object: %o", this);
    endPoint = '/a/getMiddleByCat/' + this.getAttribute('catId');
    console.log("this is endpoint " + endPoint)
    makeAjaxCall(endPoint,'GET',data, loadMiddleHTML);
    setContext('browseCat');
}


// Function that is run when a post is clicked in middle col
// to populate the right area
function viewPostClick(){
    data = new Object;
    postId = this.getAttribute('postId');
    setEntryActive(this);
    endPoint = '/a/getPost/' + postId;
    logIt("this is endpoint " + endPoint)   
    makeAjaxCall(endPoint, 'GET',data, loadRightHTML);
    setCurrentPostId(postId); // load right does this too;
    setContext('viewPost');
}


/*
finds current active post and loads the next one in the div of entries
*/
function nextClick(){

    logIt('next clicked');
    
    // TODO make this a function getCurPostId();
    curPostId = getCurrentPostId();
    allPosts = $('.isPost');

    // if there is no active post, do nothing
    // TODO, is this good logic
    if (! curPostId){ 
        // if we dont have any posts, return
        if ( allPosts.length < 1){ return;}
        // there are some posts!
        allPosts[0].click(); 
        return;
    }

    

    foundIndex = -1;
    for (i = 0; i < allPosts.length; i++) { 
            if (curPostId == allPosts[i].getAttribute('postId')){
                foundIndex = i;
                break;
            }
    }
    // if cur not found (technically not possible)
    // or cur value is last in array
    // then there is no next, do nothing
    if (foundIndex == -1 || foundIndex == allPosts.length - 1 ){
        return;
    } else {
        nextPost = allPosts[foundIndex +1];
    }

    nextPost.click();
}


function prevClick(){
    logIt('prev clicked');
    
    // TODO make this a function getCurPostId();
    curPostId = getCurrentPostId();
    allPosts = $('.isPost');

    // if there is no active post, do nothing
    // TODO, is this good logic
    if (! curPostId){ 
        // if we dont have any posts, return
        if ( allPosts.length < 1){ return;}
        // there are some posts!
        last=allPosts.length - 1;
        allPosts[last].click(); 
        return;
    }

    foundIndex = -1;
    for (i = 0; i < allPosts.length; i++) { 
            if (curPostId == allPosts[i].getAttribute('postId')){
                foundIndex = i;
                break;
            }
    }
    // if cur not found (technically not possible)
    // or cur value is index 0
    // then there is no previous, do nothing
    if (foundIndex == -1 || foundIndex == 0){
        return;
    } else {
        prevPost = allPosts[foundIndex -1];
    }

    prevPost.click();
}

function showPostCreateFormClick(){
    logIt('show form clicked');
    data = new Object;
    endPoint = '/admin/showForm/article' ;
    logIt("this is endpoint " + endPoint);
    setCurrentPostId('');   
    makeAjaxCall(endPoint, 'GET',data, loadRightHTML);
    setContext('createPost');
}

function formSaveClick(){
    logIt('form save click ');
    //dump(this);
    // TODO, make this dynamic not hard coded form
    // name
    data = new Object;
    data.formData = $("#theForm").serializeArray();
    //logIt(data); return;
    makeAjaxCall('/admin/savePost', 'POST',data, loadRightHTML);
}

function editPostClick(){
    logIt('edit post click');
    setEntryActive(this);
    // TODO, make this dynamic not hard coded form
    // name
    data = new Object;
    //logIt(data); return;
    postId = this.getAttribute('postId'); // edit button in middle col
    
    logIt('this is post id in edit ' + postId);

    if (! postId) {
        postId = getCurrentPostId(); // for edit bttn on top bar
    }

    if (! postId) { 
        logIt('edit could not find any post ID'); 
        return; 
    }
    endpoint = '/admin/editPost/' + postId;
    logIt("endpoint " + endpoint);
    makeAjaxCall(endpoint, 'GET',data, loadRightHTML);
    setContext('editPost');
}

function toggleFavPostClick(){
    logIt('edit post click');
    data= new Object;
    
    if ($(this).hasClass('far')){
        onOff = 'on';
    } else {
        onOff = 'off'
    }
    endpoint = '/a/toggleFavorite/' + onOff +'/' + this.getAttribute('postId');
    logIt("endpoint " + endpoint);
    makeAjaxCall(endpoint, 'GET',data, handleToggleFav);         
}

function getFavsClick(e){
    logIt('get favs click');
    data= new Object;
    endpoint = '/a/getFavorites/';
    logIt("endpoint " + endpoint);
    makeAjaxCall(endpoint, 'GET',data, loadMiddleHTML);
}
function searchClick(e){ 
    if ( ($(this).attr('id') == 'searchBox' && e.keyCode == 13) || e.event == 'click') {

        logIt('search click ' + $('#searchBox').val() );
        data = new Object;
        data.terms = $('#searchBox').val();
        makeAjaxCall('/a/post/search','POST',data,loadMiddleHTML);
        e.preventDefault();
        setContext('searchPost');
    }
}

function licensePostClick(e){
    logIt('copy content click');
    $postId = getCurrentPostId();
    if ($postId){
        data= new Object;
        endpoint = '/a/post/license/' + postId;
        logIt("endpoint " + endpoint);
        makeAjaxCall(endpoint, 'GET',data, notifyUser);

/*
I dont like doing this here, but the copy command must
be in an event handler
*/

        var selection = document.getSelection();
        var range = document.createRange();
        //  range.selectNodeContents(textarea);
        range.selectNode(document.getElementById('contentWrapper'));
        selection.removeAllRanges();
        selection.addRange(range);
        
        ok = document.execCommand('copy');

    } else {
        logIt('license has no postId');
    }
}

function deletePostClick(){

    // name
    data = new Object;
    //logIt(data); return;
    postId = this.getAttribute('postId'); // edit button in middle col
    
    logIt('this is post id in edit ' + postId);

    if (! postId) { 
        logIt('edit could not find any post ID'); 
        return; 
    }

    endpoint = '/admin/post/delete/' + postId;
    logIt("endpoint " + endpoint);
    makeAjaxCall(endpoint, 'GET',data, notifyUser);

}
function logoutClick(e){
    e.preventDefault();
    document.getElementById('logout-form').submit();
}
function getAllUnreadsClick(e){
    logIt('all unreads click');
    data= new Object;
    
    endpoint = '/a/unreads/' ;
    logIt("endpoint " + endpoint);
    makeAjaxCall(endpoint, 'GET',data, loadMiddleHTML);     
}
/***
 *                  .---.                             
 *                  |   |                             
 *                  '---'                             
 *                  .---.                             
 *                  |   |                             
 *        __        |   |    __     ____     _____    
 *     .:--.'.      |   | .:--.'.  `.   \  .'    /    
 *    / |   \ |     |   |/ |   \ |   `.  `'    .'     
 *    `" __ | |     |   |`" __ | |     '.    .'       
 *     .'.''| |     |   | .'.''| |     .'     `.      
 *    / /   | |_ __.'   '/ /   | |_  .'  .'`.   `.    
 *    \ \._,\ '/|      ' \ \._,\ '/.'   /    `.   `.  
 *     `--'  `" |____.'   `--'  `"'----'       '----' 
 *
 *                  _  _  _                   _         
 *                 | || || |                 | |        
 *       ___  __ _ | || || |__    __ _   ___ | | __ ___ 
 *      / __|/ _` || || || '_ \  / _` | / __|| |/ // __|
 *     | (__| (_| || || || |_) || (_| || (__ |   < \__ \
 *      \___|\__,_||_||_||_.__/  \__,_| \___||_|\_\|___/
 *                                                      
 *                                                      
 */



// Success callback for loading posts in middle col

function loadMiddleHTML(response){
    scrollToTop('#search');
    if (response.data){
        document.getElementById("entries").innerHTML = response.data;
        logIt('trying to add post clicks'); 
        addViewPostClick();
        addEditPostClick();
        addToggleFavPostClick();
        clearRight();
        setCurrentPostId('');
        addDeletePostClick();
    }
}


// Success callback for loading a post in right main area
function loadRightHTML(response){
    scrollToTop('#topBar'); 
    if (response.data){
        document.getElementById("contentWrapper").innerHTML = response.data;
        // HACK Alert! this is for FORMS not posts
        // there is no saveClick class for posts!
        logIt('adding formSaveClick listener from load right')
        addFormSaveClick();
    } 
// if we have loaded a post, set the global var
    if (response.postId){
        logIt('load right setting cur post id ' + response.postId);
        setCurrentPostId(response.postId);
    }

// if we have loaded a post decrement unreads everywhere
    if (response.cats){
        handleUnreads(response.cats, response.postId);
    }
}

function handleToggleFav (response){
    logIt('we got back ok, i guess this is post' + response.data);
    if (response.error == 0){
        selector = '#fav-'+response.data;
        toggleFontAwesome(selector);
    } else {
        // TODO alert user of error
    }
}
/*
The JS to select the text I found on google
I dont really know exactly how it works.
*/
function notifyUser(response){
    alert(response.message);
}



/*********************************************
Helpers
                                                  
,--.  ,--.       ,--.                             
|  '--'  | ,---. |  | ,---.  ,---. ,--.--. ,---.  
|  .--.  || .-. :|  || .-. || .-. :|  .--'(  .-'  
|  |  |  |\   --.|  || '-' '\   --.|  |   .-'  `) 
`--'  `--' `----'`--'|  |-'  `----'`--'   `----'  
                     `--'                         

*********************************************/
/*
Generic Ajax function, may not work in all cases
endPoint is a string for the URL to be called
data is a JS object
successFunc is a call back function
*/
function makeAjaxCall(endPoint, method, data, successFunc){
    
    data._token = document.getElementById("token").getAttribute('value');

    $.ajax({
        method: method,
        url:    endPoint,
        data: data,
        beforeSend: function(){ 
            
        },
        complete: function(){
            
        },
        success: function(response){
            // TODO check error code here!
            temp = JSON.parse(response);
            //logIt(temp.data);

            if (temp.error > 0){
                // TODO handle this better
                logIt('we got a graceful error from the system');
                if (temp.message){
                    logIt(temp.message);
                }
            }
            //logIt(temp.data);

            successFunc(temp);
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log("Ajax Error");
            console.log(JSON.stringify(jqXHR));
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            /* TODO show user a nice error code somewhere */
            response = JSON.parse(jqXHR);
            console.log('This is status: '  + response.status );
            // TODO if we get 401, redirect to login
        }
    });
}

function setContext(context){
    document.getElementById('currentContext').setAttribute('value', context);
}

// Scroll the view back to the top -- can be used for when content changes to show the user the first items
function scrollToTop(topDiv) {
    $('#content').animate({
        scrollTop: $(topDiv).offset().top
    }, '500');
}
function setCatActive(that){
    $('.isCat').removeClass('active');
    $(that).closest('.isCat').addClass('active');
}
function setEntryActive(that){
    $('.entry').removeClass('active');
    $(that).closest('.entry').addClass('active');
}

function toggleFontAwesome(selector){

    if ($(selector).hasClass('far')){
        $(selector).removeClass('far');
        $(selector).addClass('fas');
    } else {
        $(selector).removeClass('fas');
        $(selector).addClass('far');
    }
}
function getCurrentPostId(){
    return document.getElementById('currentPost').getAttribute('value');
}

function setCurrentPostId(postId){
    logIt('IN FUNC  set cur post =  ' + postId);
    document.getElementById('currentPost').setAttribute('value', postId);   
}

function logIt(msg,status){
    // status not null means log in prod
    if (_log == 'dev' || status == 'prod'){
        console.log(msg);
    }
}

function dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }
    logIt("This is Obect Dump!!");
    logIt(out);
}

function addUniqueEvent(selector,event,func){
        temps = $(selector);
        indicatorClass = 'has' + event + 'Event';

    for (i = 0; i < temps.length; i++) {

        if ($(temps[i]).hasClass(indicatorClass)){
            // do nothing
        } else {
            $(temps[i]).on(event, func);
            $(temps[i]).addClass(indicatorClass);
        }
    }

}

function handleUnreads(cats,postId){

    logIt ('handling unreads');
// first, see if this post was previosuly unread
    post = $('#unreadPost-' + postId);

    if (post.length > 0) { // we found the post
        isUnread = post.attr('isUnread');
        logIt ('this is unread status ' + isUnread);
        if (! isUnread){
            logIt ('was previously read');
            return;
        }

        // TODO, this display will change
        post.html('');
        post.attr('isUnread', '');

        // post could be in multiple categories
        for (i=0;i<cats.length;i++){
            logIt('loop: cat id is ' + cats[i].category_id);

            unreadCat = $('#unreadCat-' + cats[i].category_id);
            
            if (unreadCat.length > 0){
                curNum = unreadCat.html();
                curNum = curNum.trim();
                curNum = parseInt(curNum,10);

                logIt ('found unreadCat with unread number of >' + curNum +'<');
                if (! Number.isInteger(curNum)){
                    logIt ('unread number not an INT. Boo!');
                    return;
                }
                if (curNum == 0){
                    return;
                }
                newNum = curNum - 1;
                unreadCat.html(newNum);
            }
        
        }

    } else {
        logIt('error could not find a post ');
        return;
    }

    
    
}

// clears the right content area
function clearRight(){
    document.getElementById("contentWrapper").innerHTML = '';
}

$(document).ready(function() { 
    // register the nav links to show cats
    // in middle col when clicked
    addCatClick();

    // register the prev and next buttons
    // that are top of right area
    addPrevClick();
    addNextClick();

    // on login, we load the middle so we
    // need these:
    addShowPostCreateFormClick();
    addEditPostClick();
    addToggleFavPostClick();
    addViewPostClick();
    addDeletePostClick();
    addAllUnreadsClick();

    // fav bttn in bottom nav
    addGetFavsClick();
    addSearchClick();
    addSearchReturnPress();
    addLicensePostClick(); 
    addLogoutClick();
});
    
