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
		outputValue=outputValue+(value==="+"?"plus ":"minus ");
	} else {
		outputValue=outputValue+numbers[parseInt(value)]+" ";
		calculate();
	}
	document.getElementById("inp").value=outputValue;
}

function calculate(){
	var outVal="";
	var result=eval(inputValue).toString();
	for(var i of result){
		outVal+=i;
	}
	document.getElementById("out").value=outVal;
}