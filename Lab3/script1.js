inputValue="";
outputValue="";

const numbers=["zero","one","two","three","four","five","six","seven","eight","nine"];

function add(value){
	if(inputValue==="0"){
		inputValue=value;
	} else {
		inputValue=inputValue+value;
	}
	
	if(value==="+" || value==="-"){
		outputValue=outputValue+(value==="+"?"+":"-");
	} else {
		outputValue=outputValue+value;
		calculate();
	}
	document.getElementById("inp").value=outputValue;
}

function calculate(){
	var outVal="";
	var result=eval(inputValue).toString();
	for(var i of result){
		if(i=="+" || i=="-") outVal+=(i==="-"?"minus":"plus");
		else outVal+=numbers[parseInt(i)] + " ";
	}
	document.getElementById("out").value=outVal;
}