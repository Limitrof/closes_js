<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
</head>
<body>
<script>
//создаем функцию которая самовызывается, создавая свой СКОУП НЕДОСТУПНЫЙ не откуда, кроме ВНУТРЕННЕЙ функции 
var closeFun=(function (){//в переменную closeFun помещена только анонимная функция, которая может прибавлять к переменной globalVar единичку, ничего другого с closeFun сделать нельзя
	var globalVar=0;//переменная инициализируется только ОДИН единственный раз
	console.log(globalVar);//значение переменной выодится один единственный раз в период присвоения данной функции переменной closeFun
	console.log(this);// будет выведено единожды при инициализации
	return function (){
		globalVar+=1;
		console.log('inner space of self-invoking '+globalVar);
	}
})();
function justFunctionBestForContext(){
	var globalVar=100;
	console.log(globalVar);//значение переменной выодится каждый раз при вызове функции
	console.log(this);//содержимое будет выводится при каждом вызове
	console.log(globalVar);
	console.log(this.globalVar);
	 function showIT(){
		globalVar+=1;
		console.log(this.globalVar+'inner space of self-invoking '+globalVar);
		return 'hi!';
	}
};

function atherWayFunction(){
	var globalVar=0;
	function myCounter(){
		globalVar+=1;
		console.log(this.globalVar+'inner space '+globalVar);
	}
	return myCounter;
} 
		
var oneWay=atherWayFunction();
var anatherWay=atherWayFunction();
console.log(oneWay());	

var globalVar="blobal";

$(document).ready(function()	{	
	$(".classForThat").on("click",function(){oneWay();});
	$(".classForanather").on("click",anatherWay);
	$(".classForThis").on("click",closeFun);
	$(".classForanatherContext").on("click",justFunctionBestForContext);
	$(".classForanatherContextBindWindow").on("click",justFunctionBestForContext.bind(window));
	$(".classForanatherFunctionWithClose").on("click",function(){justFunctionBestForContext.showIT();});
});
</script>
<button id="b1" class="classForThis" >click me 1</button>
<button id="b2" class="classForThis" >click me 2</button>
<button id="b3" class="classForThat" >click me 3</button>
<button id="b4" class="classForanather" >Альтернативный синтаксис - поисваиваем переменной anatherWay функцию atherWayFunction()</button>
<button id="b5" class="classForanatherContext" >click me 5 контекст замкнут на внутреннем пространстве имен функции</button>
<button id="b6" class="classForanatherContextBindWindow" >По нажатию будет вызвана функция justFunctionBestForContext в контексте WINDOW</button>
<button id="b7" class="classForanatherFunctionWithClose" >По нажатию будет вызвана вложенная функция</button>
</body>
</html>