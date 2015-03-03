function hitAndLeaveTurn(value){
    $( "#hittedChecker" ).html( "<input type='hidden'  name='form["+value+"]' value='none' />" );
}
function hitAndChangeTurn(value, turnValue){
    $( "#hittedChecker" ).html( "<input type='hidden'  name='form["+value+"]' value='none' />" );
    $( "#changedTurn" ).html( "<input type='hidden'  name='form[turn]' value='"+turnValue+"' />" );
}
function changeTurn(lastValue){
    $( "#changedTurn" ).html( "<input type='hidden'  name='form[turn]' value='"+lastValue+"' />" );
}