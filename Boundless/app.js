angular.module('HelloUserApp', [])
.run(['$anchorScroll', function($anchorScroll) {
  $anchorScroll.yOffset = 500;
}])
.controller('HelloUserController', function($scope, $window, $location, $rootScope, $anchorScroll) {
	


	$scope.gotoBottom = function() {
		$anchorScroll.yOffset = 100;
		$anchorScroll.xOffset = 100;
      // set the location.hash to the id of
      // the element you wish to scroll to.
      $location.hash('bottom');

      // call $anchorScroll()
      $anchorScroll();
    };


	var curYPos = 0,
    curXPos = 0,
    curDown = false;
    curlLeft = false;

	window.addEventListener('mousemove', function(e){ 
  		if(curDown === true){
    		window.scrollTo(document.body.scrollLeft + (curXPos - e.pageX), document.body.scrollTop + (curYPos - e.pageY));
  		}
	});

	window.addEventListener('mousedown', function(e){ curDown = true; curYPos = e.pageY; curXPos = e.pageX; });
	window.addEventListener('mouseup', function(e){ curDown = false; });
	window.addEventListener('mouseleft', function(e){ curLeft = true; curYPos = e.pageY; curXPos = e.pageX; });
	window.addEventListener('mouseright', function(e){ curLeft = false; });
});