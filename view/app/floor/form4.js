let d_array=[],current_elem;

//setSize($("#floor")[0],vw(80),vh(80));

$('#new').click(function(){
	new_elem=$("<span class='record large'>"+(d_array.length+1)+"</span>");
	d_array.push(new_elem);
	current_elem=new_elem;
	new_elem.click(record_deterioration);
	$('#d_tags').append(new_elem);
	//new_elem.draggable();
})
function record_deterioration(){
	console.log('record');
	$carousel.on('staticClick.flickity',function(event,pointer,cellElement,cellIndex){
		//ajax
	});
}
