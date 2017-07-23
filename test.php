<style>

.przewijkacal {border:1px solid red; position:absolute; top:20px; right:30px; width:320px; height:60px;overflow:hidden;}

.przewijkaokno { border:1px solid gold; position:absolute; top:1px; right:25px; width:270px; height:56px;overflow:hidden;}

.przewijkazaw {position:absolute; top:0px; left:0px; width:4000px; height:56px; overflow:visible;transition: transform .2s ease-in-out;}


#czerw {width:90px; height:90px; float:left; background-color:red; margin: 5px;position: relative;left: 0px;}

#blue {width:90px; height:90px; float:left; background-color:blue; margin: 5px;position: relative;left: 0px;}

#green {width:90px; height:90px; float:left; background-color:green; margin: 5px;position: relative;left: 0px;}

#przewijkalewo {width:20px; height:20px; position:absolute; left:2px; top:20px;}

#przewijkaprawo {width:20px; height:20px; position:absolute; right:2px; top:20px;}



</style>


<script type='text/javascript' src='http://dev.opiekunka.pl/wp-includes/js/jquery/jquery.js?ver=1.12.4'></script>

<html>


<div class="przewijkacal">
	
<input type="button" id="przewijkalewo">
	
<input type="button" id="przewijkaprawo">



<div class="przewijkaokno">
<div id="przewijkazaw" class="przewijkazaw">
  
<div id="czerw" class="inner-slide"> </div>
  
<div id="blue" class="inner-slide"></div>
  
<div id="green" class="inner-slide"></div>
 
 </div>

  </div>
  </div>



</html>





<script type="text/javascript">

$ = jQuery;


	var animating = false,
    slideWidth = $('.inner-slide').width(),
   
$wrapper = $('.przewijkaokno'),
    $box = $('.przewijkaokno');
    slideIndex = 2,
    slideLen = $('.inner-slide').length,

    build = function() {
    	console.log('BUILDING');
        $firstClone = $('.inner-slide').eq(0).clone();
        $secondClone = $('.inner-slide').eq(1).clone();
        $preLastClone = $('.inner-slide').eq(slideLen - 2).clone();
        $lastClone = $('.inner-slide').eq(slideLen - 1).clone();
        $box.find('.przewijkazaw').append($firstClone, $secondClone).prepend($preLastClone, $lastClone);
        $wrapper.animate({
            scrollLeft: '+=' + slideWidth * slideIndex + 'px'
        }, 0);
    },
    slide = function(dir, speed) {
    	console.log(dir);
        if(!animating) {
            animating = true;
            dir == 'przewijkaprawo' ? slideIndex++ : slideIndex--;
            slideIndex == slideLen - 1 ? slideIndex == 0 : '';

            console.log('slideIndex'+slideIndex);
            
            if(slideIndex == 0 && dir == 'przewijkalewo') {
            	console.log('goingleft?');
                //if the slide is at the beginning and going left
                
                slideIndex = slideLen + 1;                
                $wrapper.animate({
                    scrollLeft: slideIndex * slideWidth + 'px'
                }, 0, function() {
                    animating = false;    
                });
                slideIndex--;
                
            } else if(slideIndex == slideLen + 2 && dir == 'przewijkaprawo') {
                //if the slide is at the end and going right
                
                slideIndex = 1;                
                $wrapper.animate({
                    scrollLeft: slideIndex * slideWidth + 'px'
                }, 0, function() {
                    animating = false;    
                });
                slideIndex++;
                
            }
            $wrapper.animate({
                scrollLeft: slideIndex * slideWidth + 'px'
            }, speed, function() {
                animating = false;    
            });
        }
    };

    $(function() {
    	console.log('ready');
    build();
    $('#przewijkalewo, #przewijkaprawo').on('click', function() {
        slide($(this).attr('id'), 600)
    });
});

  function rusz (ile) {
       	var e = document.getElementById("przewijkazaw"),
       	currentPos = (parseInt(document.getElementById('przewijkazaw').style.left, 10) || 0);

       	e.style.left = currentPos + ile + 'px';

}

</script>





<script>
var f = 10;
var $ = jQuery;

function poka(id){
  console.log(id);
  $("div.element").hide();
  $("#"+id).show();
}</script>



<input type='button' onclick="poka('id1');">
<input type='button' onclick="poka('id2');">

<div class="div1">
  <div id="id1" class="element" style="display:none" onclick="pokaz()">cos</div>
  <div id="id2" class="element" onclick="pokaz()">cos2</div>
  <div id="id3" class="element" style="display:none">cos3</div>
</div>